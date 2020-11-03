<?php
//Se inicia o restaura la sesión
//session_start();

include "../../header.html";
include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo']) && isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if ($vida_session > $_SESSION['limite']) {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();
        //Redirigimos pagina.
        header("Location: /DayClass/index.php?resultado=3");

        exit();
    }
}
$_SESSION['tiempo'] = time();*/

?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Asistencias</h1>
        <a href="/DayClass/Administrador/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
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

    <div class="my-3">
        <h4 class="font-weight-normal">Seleccione una materia, un curso y una fecha para ver las asistencias.</h4>
    </div>
    <div class="row mb-2">
        <div class="col-md-4 mb-2">
            <label for="materia">Materia:</label>
            <select name="materia" id="materia" class="custom-select">
                <option value="">Materias</option>
                <?php
                $consultaMateria = $con->query("SELECT * FROM materia WHERE fechaBajaMateria IS NULL ORDER BY nombreMateria, nivelMateria ASC");

                while ($materia = $consultaMateria->fetch_assoc()) {
                    echo "<option value='" . $materia['id'] . "'>" . $materia['nombreMateria'] . " (Nivel " . $materia['nivelMateria'] . ")</option>";
                }

                ?>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <label for="curso">Curso:</label>
            <select name="curso" id="curso" class="custom-select" disabled>
                <option value="">Cursos</option>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="form-control" disabled>
        </div>
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
        <table class="table table-secondary table-bordered">
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

    <div class="alert alert-danger" role="alert" id="diaCursado" hidden>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>La fecha seleccionada no corresponde para un día de cursado. No puede ver ni cargar asistencias.</h5>
    </div>

</div>

<script src="../administrador.js"></script>
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
                        document.getElementById("tbodyAsistencia").innerHTML = contenido;
                        document.getElementById("sinAsistencias").hidden = true;
                        document.getElementById("tablaAsistencia").hidden = false;
                        document.getElementById("diaCursado").hidden = true;
                        document.getElementById("idCursoEditar").value = id_curso;
                        document.getElementById("fechaEditar").value = fecha;

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

    document.getElementById("materia").onchange = function() {
        $("#fecha").attr("disabled", "disabled");
        $("#curso").attr("disabled", "disabled");
        document.getElementById("tablaAsistencia").hidden = true;
        document.getElementById("tbodyAsistencia").innerHTML = "";
        var id_materia = document.getElementById("materia").value;
        var datos = {
            id_materia: id_materia
        }

        $.ajax({
            url: '/DayClass/Administrador/Estadisticas/listarCursos.php',
            type: 'POST',
            data: datos,
            success: function(datosRecibidos) {
                //alert(datosRecibidos);
                json = JSON.parse(datosRecibidos);
                var contenido;
                if (json.length != 0) {
                    contenido = "<option value='' selected>Seleccione</option>";
                    for (let index = 0; index < json.length; index++) {
                        contenido += "<option value='" + json[index].id + "'>" + json[index].nombreCurso + "</option>";
                        document.getElementById("curso").innerHTML = contenido;
                        $("#curso").removeAttr("disabled");
                    }
                } else {
                    contenido = "<option value='' selected>No hay cursos</option>";
                    document.getElementById("curso").innerHTML = contenido;
                    $("#curso").attr("disabled", "disabled");
                }

            }
        })
    }

    document.getElementById("curso").onchange = function() {
        var id_curso = document.getElementById("curso").value;
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
</script>

<?php
include "../../footer.html";
?>