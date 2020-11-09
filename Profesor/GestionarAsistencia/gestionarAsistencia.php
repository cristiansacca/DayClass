<?php
//Se inicia o restaura la sesión


include "../../header.html";
include "../../databaseConection.php";

session_start();
//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 25")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if(!$funcionCorrecta){
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo'])&&isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
  
    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $_SESSION['limite'])
    {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();              
        //Redirigimos pagina.
        header("Location: /DayClass/index.php?resultado=3");
  
        exit();
    }
  }
  $_SESSION['tiempo'] = time();

//-----------------------------------------------------------------------------------------------------------------------------

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Asistencias</h1>
        <a href="/DayClass/Index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Datos de asistencia guardados correctamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al guardar los datos de asistencia.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Datos de asistencia actualizados correctamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 4:
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ningún dato fue actualizado.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
        }
    }

    ?>

    <div class="alert alert-info my-3" role="alert">
        <h5 class="font-weight-normal"><i class="fa fa-info-circle mr-2"></i>Seleccione una materia, un curso y una fecha para ver las asistencias.</h5>
    </div>
    <div class="mb-2">
        
            
                
                <?php
                
                $id_prof = $_SESSION['usuario']['id'];
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d');
                $consultaCargo = $con->query("SELECT * FROM cargoprofesor WHERE profesor_id= '$id_prof' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL");
        

                if(mysqli_num_rows($consultaCargo)>0){
                    echo "
                    <div class=' row mb-2'>
                        <div class='col-md-6 mb-2'>
                            <label for='curso'>Curso:</label>
                                <select name='curso' id='curso' class='custom-select'>
                                    <option value=''>Curso</option>";

                                        while ($cargos = $consultaCargo->fetch_assoc()) {

                                            $consultaCursos = $con->query("SELECT * FROM curso WHERE id='" . $cargos['curso_id'] . "' AND fechaHastaCurActul IS NULL");
                                            $resultadoCursos = $consultaCursos->fetch_assoc();
                                            $cargoProf = $con->query("SELECT * FROM cargo WHERE id='" . $cargos['cargo_id'] . "'")->fetch_assoc();

                                            echo "<option value='" . $resultadoCursos["id"]  . "'>" . $resultadoCursos["nombreCurso"] . "</option>";
                                        }

                    echo "</select> 
                        </div>
                            <div class='col-md-6 mb-2'>
                                <label for='fecha'>Fecha:</label>
                                    <input type='date' name='fecha' id='fecha' class='form-control' disabled>
                            </div> 
                         </div>";

                }else{
                     echo "<div class='alert alert-warning text-left' role='alert'  style='width: 100%;'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no lo han asignado a un curso.</h5>
                    </div>";
                }
                ?>
            
        </div>
        
        

    <div class="mb-4" id="sinAsistencias" hidden>
        <div class="alert alert-warning" role="alert">
            <h5><i class='fa fa-exclamation-circle mr-2'></i>No se registran asistencias para la fecha seleccionada.</h5>
        </div>
        <form action="cargarAsistencias.php" method="POST">
            <input type="number" name="idCursoCargar" id="idCursoCargar" hidden>
            <input type="date" name="fechaCargar" id="fechaCargar" hidden>
            <button type="submit" class="btn btn-primary"><i class="fa fa-tasks mr-1"></i>Cargar asistencia</button>
        </form>
    </div>

    <div id="tablaAsistencia" class="table-responsive" hidden>
        <form action="editarAsistencias.php" method="POST">
            <input type="number" name="idCursoEditar" id="idCursoEditar" hidden>
            <input type="date" name="fechaEditar" id="fechaEditar" hidden>
            <button type="submit" class="btn btn-success my-3"><i class="fa fa-edit mr-1"></i>Editar asistencias</button>
        </form>
        <table class="table table-secondary table-bordered" id="dataTableAsistencias">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Estado</th>
            </thead>
            <tbody id="tbodyAsistencia">

            </tbody>
        </table>
    </div>

    <button class="btn btn-warning mt-2 mr-2" id="btnLimpiarDT" hidden><i class="fa fa-eraser mr-1"></i>Limpiar DataTable</button>

    <div class="alert alert-danger" role="alert" id="diaCursado" hidden>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>La fecha seleccionada no corresponde para un día de cursado. No puede ver ni cargar asistencias.</h5>
    </div>

</div>

<script src="../profesor.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<script>
    document.getElementById("fecha").onchange = function() {
        var fecha = document.getElementById("fecha").value;
        var id_curso = document.getElementById("curso").value;
        var datos = {
            id_curso: id_curso,
            fecha: fecha
        }

        var x;
        $.ajax({
            url: 'validarDiasCursado.php',
            type: 'POST',
            data: datos,
            async: false,
            success: function(datosRecibidos) {
                //alert(datosRecibidos);
                json = JSON.parse(datosRecibidos);
                if(json.resultado == 1){
                    x = 1;
                } else {
                    x = 0;
                }
            }
        })

        if (x == 1) {
            $.ajax({
                url: 'obtenerAsistencia.php',
                type: 'POST',
                data: datos,
                success: function(datosRecibidos) {
                    //alert(datosRecibidos);
                    json = JSON.parse(datosRecibidos);
                    var contenido = "";
                    if (json.length != 0) {
                        for (let index = 0; index < json.length; index++) {
                            var color;
                            if (json[index].estado == "PRESENTE") {
                                color = 'text-success';
                            } else {
                                if (json[index].estado == "AUSENTE") {
                                    color = 'text-danger';
                                } else {
                                    color = 'text-warning';
                                }
                            }
                            contenido += "<tr>";
                            contenido += "<td>" + json[index].legajo + "</td>";
                            contenido += "<td>" + json[index].apellido + "</td>";
                            contenido += "<td>" + json[index].nombre + "</td>";
                            contenido += "<td class='" + color + "'><b>" + json[index].estado + "</b></td>";
                            contenido += "</tr>";
                        }
                        document.getElementById("btnLimpiarDT").click();
                        document.getElementById("tbodyAsistencia").innerHTML = contenido;
                        document.getElementById("sinAsistencias").hidden = true;
                        document.getElementById("tablaAsistencia").hidden = false;
                        document.getElementById("diaCursado").hidden = true;
                        document.getElementById("idCursoEditar").value = id_curso;
                        document.getElementById("fechaEditar").value = fecha;
                        paginarTabla();

                    } else {
                        document.getElementById("tbodyAsistencia").innerHTML = contenido;
                        document.getElementById("tablaAsistencia").hidden = true;
                        document.getElementById("sinAsistencias").hidden = false;
                        document.getElementById("diaCursado").hidden = true;
                        document.getElementById("idCursoCargar").value = id_curso;
                        document.getElementById("fechaCargar").value = fecha;
                    }

                }
            })
        } else {
            document.getElementById("tablaAsistencia").hidden = true;
            document.getElementById("sinAsistencias").hidden = true;
            document.getElementById("diaCursado").hidden = false;
        }
    }

    document.getElementById("curso").onchange = function() {
        var id_curso = document.getElementById("curso").value;
        document.getElementById("tablaAsistencia").hidden = true;
        document.getElementById("sinAsistencias").hidden = true;
        document.getElementById("diaCursado").hidden = true;
        $("#fecha").val("");
        var datos = {
            id_curso: id_curso
        }
        if (id_curso != "") {
            $.ajax({
                url: 'datosCurso.php',
                type: 'POST',
                data: datos,
                success: function(datosRecibidos) {
                    //alert(datosRecibidos);
                    json = JSON.parse(datosRecibidos);
                    var fechaDesde = json.fechaDesdeCursado;
                    var fechaHasta = json.fechaHastaCursado;
                    var fechaActual = json.fechaActual;
                    if (fechaDesde != null && fechaHasta != null) {
                        document.getElementById("fecha").min = fechaDesde;
                        if (fechaHasta < fechaActual) {
                            document.getElementById("fecha").max = fechaHasta;
                        } else {
                            document.getElementById("fecha").max = fechaActual;
                        }
                        $("#fecha").removeAttr("disabled");
                    }
                }
            })
        } else {
            $("#fecha").attr("disabled", "disabled");
        }
    }
    
    function paginarTabla(){
        eval("debugger;");
        var table;
        table = $("#dataTableAsistencias").DataTable({
            "ordering": false,
            "language": {
                processing:     "Procesando...",
                lengthMenu: "Mostrar _MENU_ por página",
                zeroRecords: "No hay coincidencias",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No se encontraron datos",
                infoFiltered: "(Filtrada de _MAX_ filas)",
                loadingRecords: "Cargando...",
                infoPostFix:    "",
                search: "Buscar:",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Último"
                },
                aria: {
                    sortAscending:  ": Ordenar de manera ascendente",
                    sortDescending: ": Ordenar de manera descendente"
                }
            }
        });
        document.getElementById("btnLimpiarDT").onclick = function(){
            table.destroy();
        }
    }
</script>

<?php
include "../../footer.html";
?>