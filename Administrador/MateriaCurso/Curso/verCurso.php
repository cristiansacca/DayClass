<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
include "../../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
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
$_SESSION['tiempo'] = time();

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<link rel="stylesheet" href="../../../styleCards.css">
<script src="fnValidarDiasCurso.js"></script>

<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <p class="card-text">Administrador</p>
        <?php
        $id_curso = $_GET["id_curso"];

        $consulta1 = $con->query("SELECT curso.materia_id, curso.nombreCurso, materia.nombreMateria, division.nombreDivision, modalidad.nombre AS nombreModalidad FROM `curso`, materia, division, modalidad WHERE curso.id = '$id_curso' AND curso.materia_id = materia.id AND curso.division_id = division.id AND division.modalidad_id = modalidad.id");
        $curso = $consulta1->fetch_assoc();
        $nombreCurso = $curso["nombreCurso"];
        $nombreMateria = $curso["nombreMateria"];
        $nombreDivision = $curso["nombreDivision"];
        $nombreModalidad = $curso["nombreModalidad"];
        $id_materia = $curso["materia_id"];

        echo "<h1>$nombreCurso</h1>";
        echo "<h3 class='font-weight-normal'>$nombreModalidad</h3>";

        ?>


        <a class="btn btn-info" <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=$id_materia'"; ?>><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
        <a class="btn btn-warning" data-toggle="modal" data-target="#modifFechasCurso"><i class="fa fa-calendar mr-2"></i>Fechas de cursado</a>
        <a href="" class="btn btn-success" data-toggle="modal" data-target="#modifHorariosCurso"><i class="fa fa-clock-o mr-1"></i>Horarios de cursado</a>
        <a class="btn btn-light" <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/verTemasDadosCurso.php?id_curso=$id_curso'"; ?>><i class="fa fa-bookmark mr-2"></i>Temas dados</a>


    </div>
    <!-- Page Features -->

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Modificación exitosa de horarios de cursado.</h5>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No se pudieron dar de baja los horarios anteriores, intente nuevamente.</h5>";
                break;

            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Modificación exitosa de las fechas de cursado.</h5>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrio un error en la actualización de las fechas de cursado, intente nuevamente.</h5>";
                break;
        }
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    ?>


    <h2>Fechas de cursado</h2>
    <div class="py-4 my-3 jumbotron" style="background-color:PowderBlue;">
        <?php

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d H:i:s');
        $currentDate = date('Y-m-d');

        $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
        $resultado = $consultaCurso->fetch_assoc();
        $fchDesde = $resultado["fechaDesdeCursado"];
        $fchHasta = $resultado["fechaHastaCursado"];
        $nombreCurso = $resultado["nombreCurso"];

        $rtdo = false;

        if (($fchDesde < $currentDateTime &&  $fchHasta < $currentDateTime) || ($fchDesde == "" &&  $fchHasta == "")) {
            echo "<div class='alert alert-danger' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Se deben ingresar las fechas de cursado para este año.</h5>
                        </div>";
        } else {

            echo "<div class='form-row'>";
            echo "<div class='form-group col-md-6'>
            <label for='inputInicio'>Inicio de cursado:</label>
            <input type='date' class='form-control' id='inputInicioCursado' name='inputInicioCursado' placeholder='Fecha Inicio Cursado' disabled value='$fchDesde'></div>";

            echo   "<div class='form-group col-md-6'>
            <label for='inputInicio'>Fin de cursado:</label>
            <input type='date' class='form-control' id='inputInicioCursado' name='inputInicioCursado' placeholder='Fecha Inicio Cursado' disabled value='$fchHasta'></div>";

            echo "</div>";
            $rtdo = true;
        }

        ?>
    </div>

    <div class="row my-4">
        <?php

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');

        $consulta3 = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");

        $contador = 0;


        if (($consulta3->num_rows) == 0) {
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no se han definido horaios para este curso</h5>
                </div>";
        } else {

            echo "<div class='col-lg-12'><h2>Horarios de cursado</h2></div>";
            while ($horarioCurso = $consulta3->fetch_assoc()) {
                if ($contador == 4) {
                    $contador = 0;
                }

                $dia = $horarioCurso["nombreDia"];
                $horaDesde = $horarioCurso["horaInicioCurso"];
                $horaHasta = $horarioCurso["horaFinCurso"];
                echo "<div class='col-lg-4 my-3' >
                <div class='card h-100 color$contador'>
                    <div class='card-body text-left'>
                        <h3 class='card-title'>$dia</h3>
                        <h5 class='font-weight-normal'>Desde: " . strftime("%H:%M", strtotime($horaDesde)) . "</h5>
                        <h5 class='font-weight-normal'>Hasta: " . strftime("%H:%M", strtotime($horaHasta)) . "</h5>
                    </div>
                </div>
            </div>";

                $contador++;
            }
        }
        ?>

    </div>

</div>

<!-- Modal modificar horarios de cursado -->
<div class="modal fade" id="modifHorariosCurso" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Modificar horarios curso</h5>
            </div>
            <form id="modificarHorariosCurso" name="modificarHorariosCurso" action="modifHorariosCursadoCurso.php" method="POST" enctype="multipart/form-data" role="form" onsubmit="return enviarFechasNuevas()">

                <div class="modal-body">

                    <div class="form-group">

                        <div id="mensajeError"></div>

                        <div class="table-responsive">
                            <table id="daysHoursTable" class="table">
                                <thead>
                                    <th>Día</th>
                                    <th>Hora desde</th>
                                    <th>Hora hasta</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <?php
                                    date_default_timezone_set('America/Argentina/Buenos_Aires');
                                    $currentDateTime = date('Y-m-d');
                            
                                    $consulta = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDiaSA, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");
                            
                                    $contador = 0;
                            
                                    while ($horarioCurso = $consulta->fetch_assoc()) {
                            
                                        $horaDesde = $horarioCurso["horaInicioCurso"];
                                        $horaHasta = $horarioCurso["horaFinCurso"];
                            
                                        echo "<tr>
                                        <td> <input class='checkDia' type='checkbox' id='" . $horarioCurso["nombreDiaSA"] . "' onclick='habilitarTimePCF(this.id)'><label class='ml-2' name='dia[]'>" . $horarioCurso["nombreDia"] . "</label></td>
                                        <td><input type='time'  id='" . $horarioCurso["nombreDiaSA"] . "1' onchange='habilitar2do(this.id)' disabled value='$horaDesde'></td>
                                        <td><input type='time' id='" . $horarioCurso["nombreDiaSA"] . "2' onchange='validar(this.id)' disabled value='$horaHasta'> </td>
                                        <td><button type='button' class='btn btn-danger mb-1' onclick='deleteRow(this)'><i class='fa fa-trash mr-1'></i>Eliminar</button></td>
                                        </tr>";
                            
                                        $contador++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class='btn btn-success mb-1' onclick="addCourseDay()"> <i class="fa fa-plus mr-1"></i>Agregar día</button>
                        <input type="text" id="arregloDiasHorario" name="arregloDiasHorario" hidden>
                        <input type="text" name="cursoId" id="cursoId" <?php echo "value= '$id_curso'"; ?> hidden>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="window.location.href='/DayClass/Administrador/MateriaCurso/Curso/verCurso.php?id_curso=<?php echo "$id_curso"; ?>';"> Cancelar </button>
                    <button type="submit" class="btn btn-primary"> Guardar </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal modificar fechas de inicio y fin de cursado -->
<div class="modal fade" id="modifFechasCurso" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Modificar fechas de cursado</h5>
            </div>


            <form id="modificarHorariosCurso" name="modificarHorariosCurso" action="modifFechasCursadoCurso.php" method="POST" enctype="multipart/form-data" role="form">

                <div class="modal-body">

                    <div class="form-group">

                        <?php
                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                        $currentDateTime = date('Y-m-d H:i:s');
                        $currentDate = date('Y-m-d');

                        $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
                        $resultado = $consultaCurso->fetch_assoc();
                        $fchDesde = $resultado["fechaDesdeCursado"];
                        $fchHasta = $resultado["fechaHastaCursado"];
                        $nombreCurso = $resultado["nombreCurso"];


                        $selectAlumnosInscriptos = $con->query("SELECT * FROM `curso`, alumnocursoactual WHERE curso.id = '$id_curso' AND curso.id = alumnocursoactual.curso_id AND curso.fechaDesdeCursado = alumnocursoactual.fechaDesdeAlumCurAc AND curso.fechaHastaCursado = alumnocursoactual.fechaHastaAlumCurAc");

                        $rtdo = false;

                        if ((($selectAlumnosInscriptos->num_rows) == 0)) {
                            if ((($fchDesde < $currentDateTime &&  $fchHasta < $currentDateTime) || ($fchDesde == "" &&  $fchHasta == ""))) {
                                echo "<div class='alert alert-warning' role='alert'>
                                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Se deben ingresar las fechas de cursado para este año.</h5>
                                        </div>";
                            } else {
                                echo "<div class='alert alert-success' role='alert'>
                                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Se pueden mofificar las fechas de cursado existentes.</h5>
                                        </div>";
                            }
                        } else {
                            if ((($fchDesde < $currentDateTime &&  $fchHasta < $currentDateTime) || ($fchDesde == "" &&  $fchHasta == ""))) {
                                echo "<div class='alert alert-warning' role='alert'>
                                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Se deben ingresar las fechas de cursado para este año.</h5>
                                        </div>";
                            } else {
                                echo "<div class='alert alert-warning' role='alert'>
                                            <h6><i class='fa fa-exclamation-circle mr-2'></i>Las fechas de cursado no se pueden modificar, hay alumnos incriptos en el curso.</h6>
                                        </div>";
                                $rtdo = true;
                            }
                        }
                        ?>

                    </div>
                    <div class="fill_fields">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputInicio">Inicio de cursado:</label>
                                <input type="date" class="form-control" id="inputInicioCursado" name="inputInicioCursado" placeholder="Fecha Inicio Cursado"> <?php  if ($rtdo){ 
                                    echo " disabled ";
                                    echo " value='" . $fchDesde . "' ";
                                }else {
                                    echo " onchange='habilitarSegundaFecha()' required "}; 
                                    echo " min='" . date("Y") . "-01-01' " . "max='" . date("Y") . "-12-31'";?>
                                <h9 class="msg" id="msjValidacionFechaI"></h9>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputHasta">Fin de cursado:</label>
                                <input type="date" class="form-control" id="inputFinCursado" name="inputFinCursado" placeholder="Fecha Fin Cursado" disabled <?php
                                if ($rtdo) {                                                                                                                                 echo " value='" . $fchHasta . "' ";
                                echo " required ";
                                    echo " min='" . date("Y") . "-01-01' " . "max='" . date("Y") . "-12-31'";}  ?>>
                                <h9 class="msg" id="msjValidacionFechaH"></h9>
                            </div>
                        </div>


                        <input type="text" name="cursoId" id="cursoId" <?php echo "value= '" . $id_curso . "'"; ?> hidden>
                        <input type="text" name="todayDate" id="todayDate" <?php echo "value= '" . $currentDate . "' "; ?> hidden>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
                    <input type="submit" value="Guardar" class="btn btn-primary" <?php
                                                                                    if ($rtdo) {
                                                                                        echo "style='display:none'";
                                                                                    } ?>>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../../footer.html";
?>