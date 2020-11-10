<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";


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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 4")->fetch_assoc(); // <-- Cambia
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
$id_curso = $_GET["id_curso"];

$consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
$curso = $consulta1->fetch_assoc();
$fechaDesdeCursado = $curso["fechaDesdeCursado"];


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Tema dados anteriormente</h1>
        <h4><?php echo " " . $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Profesor/TemaDia/temaDelDia.php?id_curso=$id_curso'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <a <?php echo "href='/DayClass/Profesor/TemaDia/verDatosReportesTemas.php?id_curso=$id_curso'"; ?> class="btn btn-success"><i class="fa fa-file-text-o mr-1"></i>Reporte</a>
        <button class='btn btn-warning'  data-toggle='modal' data-target='#agregarTemaDado'><i class='fa fa-edit mr-1'></i>Agregar Tema</button>

    </div>
    
     <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Modificación exitosa del tema dado.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al modificar el tema. Intente nuevamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Baja exitosa del tema dado.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja del tema dado. Intente nuevamente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 5:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Tema agregado exitosamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 6:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en registrar el tema. Intente nuevamente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
        }
    }

    ?>

    <div class="table-responsive">
        <table class="table text-center table-striped table-bordered table-light" id="dataTable">
            <?php

            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDate = date('Y-m-d H:i:s');
            $consulta1 = $con->query("SELECT temadia.id, temadia.profesor_id, temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema, temasmateria.unidadTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia DESC");

            if (($consulta1->num_rows) == 0) {
                echo "<div class='alert alert-warning' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no se han cargado temas en este curso.</h5>
                    </div>";
            } else {
                echo "<thead>
                                    <th>Fecha</th>
                                    <th>Unidad</th>
                                    <th>Tema</th>
                                    <th>Comentario</th>
                                    <th>Docente</th> 
                                    <th></th> 
                                </thead>
                                <tbody> ";

                while ($resultado1 = $consulta1->fetch_assoc()) {
                    
                    $id_tema = $resultado1['id'];
                    $profTema = $resultado1['profesor_id'];
                    $datosProf = $con->query("SELECT * FROM `usuario` WHERE usuario.id = '$profTema'")->fetch_assoc();

                    $nombreProf = $datosProf["nombreUsuario"];
                    $apellidoProf = $datosProf["apellidoUsuario"];

                    $date = date_create($resultado1['fechaTemaDia']);
                    $fecha = date_format($date, "d/m/Y");

                    echo "<tr>
                                    <td>" . $fecha . "</td>
                                    <td>" . $resultado1['unidadTema'] . "</td>
                                    <td>" . $resultado1['nombreTema'] . "</td>
                                    <td>" . $resultado1['comentarioTema'] . "</td>
                                    <td>" . $nombreProf . " " . $apellidoProf . "</td>
                                    <td> <a href='/DayClass/Profesor/TemaDia/borrarTema.php?id_tema=$id_tema&&id_curso=$id_curso' class='btn btn-danger mb-1' ><i class='fas fa-trash mr-1'></i>Eliminar</a>
                                    <button class='btn btn-primary mb-1' onclick='cargarDatos($id_tema)' data-toggle='modal' data-target='#editarTemaDado'><i class='fa fa-edit mr-1'></i>Editar</button>
                                    </td>
                                    
                                </tr>";
                }
                echo " </tbody>";
            }
            ?>
        </table>
    </div>
</div>


<!-- Modal editar -->
<div class="modal fade" id="editarTemaDado" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title">Editar tema dado</h5>
            </div>
                
                
            <form action="modificarTemaDia.php" method="POST" class=" form-group">
                    
                <input type="text" name="id_curso"  hidden>
    
                <div class="modal-body">
                    <h6>Datos existentes</h6>
                    
                    
                   <div class="my-2">
                       
                       <div>
                       <label>Unidad:</label>
                        <input type="text" readonly id="unidadTemaAnt" class="form-control">
                        </div>
                       
                       <div>
                       <label>Tema:</label>
                        <input type="text" readonly id="temaAnt" class="form-control">
                       </div>
                       
                       <h6>Datos nuevos</h6>
                        <select id="unidadTema" name="unidadTema" class="custom-select mb-2" required>
                            <option value="" selected>Unidad</option>
                            <?php

                            $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
                            $curso = $consulta1->fetch_assoc();

                            date_default_timezone_set('America/Argentina/Buenos_Aires');
                            $currentDate = date('Y-m-d');

                            $consultaMateria = $con->query("SELECT * FROM materia WHERE id = '" . $curso["materia_id"] . "'");
                            $materia = $consultaMateria->fetch_assoc();
                            $materia_id = $materia["id"];

                            $consultaPrograma = $con->query("SELECT * FROM programamateria WHERE materia_id = '$materia_id' AND programamateria.fechaDesdePrograma <= '$currentDate' AND programamateria.fechaHastaPrograma IS NULL");
                            $programa = $consultaPrograma->fetch_assoc();
                            $programa_id = $programa["id"];

                            $consultaTemas = $con->query("SELECT DISTINCT temasmateria.unidadTema FROM temasmateria WHERE programaMateria_id = '$programa_id' ORDER BY temasmateria.unidadTema");

                            while ($temas = $consultaTemas->fetch_assoc()) {
                                echo "<option value='" . $temas["unidadTema"] . "'>" . $temas["unidadTema"] . "</option>";
                            }

                            ?>
                        </select>
                       
                       

                        <select id="nombreTema" name="nombreTema" class="custom-select" required disabled>
                            <option value="" selected>Tema</option>

                        </select>
                       
                       <div class="my-2">
                            <textarea name="comentario" id="comentario" cols="60" rows="5" style="resize: none;" class="form-control form-inline" placeholder="Escriba un comentario (Opcional). Máximo 40 carácteres" maxlength="80"></textarea>
                       </div>
                       
                       <input type="text" name="id_curso" id="id_curso" <?php echo "value='$id_curso'" ?> hidden>
                       <input type="text" name="idPrograma" id="idPrograma" <?php echo "value='$programa_id'" ?> hidden>
                       <input type="text" name="idTema" id="idTema" hidden>
                </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal cargar tema de otro dia -->
<div class="modal fade" id="agregarTemaDado" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title">Agregar tema</h5>
            </div>
                
                
            <form action="agregarTemaDiaDado.php" method="POST" class=" form-group">
                    
                <div class="modal-body">
                    
                    <div class="mb-4" id="noEsFechaCurso" hidden>
                        <div class="alert alert-danger" role="alert">
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No es un día que se curse, seleccione otro.</h5>
                        </div>
                    </div>
                    
                   <div class="my-2">
                       
                       <div class="form-inline">
                       <label>Fecha:</label>
                        <input type="date" id="fechaTema" name="fechaTema" class="form-control mb-2" <?php echo "max='$currentDate'"; echo "min=$fechaDesdeCursado" ?>>
                        </div>
                       
                        <select id="unidadTemaAgregar" name="unidadTemaAgregar" class="custom-select mb-2" disabled required>
                            <option value="" selected>Unidad</option>
                            <?php

                            $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
                            $curso = $consulta1->fetch_assoc();

                            date_default_timezone_set('America/Argentina/Buenos_Aires');
                            $currentDate = date('Y-m-d');

                            $consultaMateria = $con->query("SELECT * FROM materia WHERE id = '" . $curso["materia_id"] . "'");
                            $materia = $consultaMateria->fetch_assoc();
                            $materia_id = $materia["id"];

                            $consultaPrograma = $con->query("SELECT * FROM programamateria WHERE materia_id = '$materia_id' AND programamateria.fechaDesdePrograma <= '$currentDate' AND programamateria.fechaHastaPrograma IS NULL");
                            $programa = $consultaPrograma->fetch_assoc();
                            $programa_id = $programa["id"];

                            $consultaTemas = $con->query("SELECT DISTINCT temasmateria.unidadTema FROM temasmateria WHERE programaMateria_id = '$programa_id' ORDER BY temasmateria.unidadTema");

                            while ($temas = $consultaTemas->fetch_assoc()) {
                                echo "<option value='" . $temas["unidadTema"] . "'>" . $temas["unidadTema"] . "</option>";
                            }

                            ?>
                        </select>
                       
                       

                        <select id="nombreTemaAgregar" name="nombreTemaAgregar" class="custom-select" required disabled>
                            <option value="" selected>Tema</option>

                        </select>
                       
                       <div class="my-2">
                            <textarea name="comentarioAgregar" id="comentarioAgregar" cols="60" rows="5" style="resize: none;" class="form-control form-inline" placeholder="Escriba un comentario (Opcional). Máximo 40 carácteres" maxlength="80"></textarea>
                       </div>
                       
                       <input type="text" name="id_curso2" id="id_curso2" <?php echo "value='$id_curso'" ?> hidden>
                       <input type="text" name="idPrograma" id="idPrograma" <?php echo "value='$programa_id'" ?> hidden>
                       <input type="text" name="idTema" id="idTema" hidden>
                       <input type="text" name="idProfesor" id="idProfesor" <?php echo "value='".$_SESSION['usuario']["id"]."'" ?> hidden>
                       
                       
                </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../profesor.js"></script>
<script src="fnTemaDia.js"></script>
<script src="fnTemaDiaAgregar.js"></script>
<script src="paginadoDataTable.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<script>
    function cargarDatos(id){
        
        document.getElementById("idTema").value = id;
        
        $.ajax({
            url: 'buscarTemaAnt.php',
            type: 'POST',
            data: {id: id},
            success: function(datosRecibidos) {
                json = JSON.parse(datosRecibidos);
                document.getElementById("unidadTemaAnt").value = json.unidad;
                document.getElementById("temaAnt").value = json.tema;    
                document.getElementById("comentario").value = json.comentario;
            }
        })
        
    }
    
    document.getElementById("fechaTema").onchange = function() {
        eval("debugger;");
        var fecha = document.getElementById("fechaTema").value;
        var id_curso = document.getElementById("id_curso2").value;
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
                    document.getElementById("noEsFechaCurso").hidden = true;
                    document.getElementById("unidadTemaAgregar").disabled = false;
                } else {
                    x = 0;
                    document.getElementById("noEsFechaCurso").hidden = false;
                    document.getElementById("unidadTemaAgregar").disabled = true;
                }
            }
        })
    }

</script>


<script src="fnTemaDia.js"></script>
<?php
include "../../footer.html";
?>