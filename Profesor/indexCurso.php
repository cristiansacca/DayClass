<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
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

if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
} else {
    header("location:/DayClass/Profesor/index.php");
}


$id_prof = $_SESSION['profesor']["id"];
$id_curso = $_GET["id_curso"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$consulta1 = $con->query("SELECT profesor.id, profesor.legajoProf, profesor.apellidoProf, profesor.nombreProf, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo FROM cargoprofesor, curso, profesor, cargoprofesorestado, estadocargoprofesor, cargo WHERE profesor.id = '$id_prof' AND cargoprofesor.profesor_id = profesor.id AND cargoprofesor.curso_id = curso.id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");

$resultadoProf = $consulta1->fetch_assoc();
$estadoCargo = $resultadoProf['nombreEstadoCargoProfe'];

$hab = false;
//si el docente no tiene estado activo en ese materia en esa fecha, se desabilitaran los botones de asistencia 
if ($estadoCargo == "Activo") {
    $hab = true;
}


$consultaDiasHorasCurso = $con->query("SELECT cursodia.dayName, horariocurso.horaInicioCurso, horariocurso.horaFinCurso FROM horariocurso, cursodia, curso WHERE curso.id ='$id_curso' AND horariocurso.curso_id = curso.id AND horariocurso.cursoDia_id = cursodia.id ");

$tieneDiaHora = false;
$diaHoraBien = false;
$diaBien = false;
$horaBien = false;
$diaSinClases = false;

if (!($consultaDiasHorasCurso) == 0) {
    $tieneDiaHora = true;
    $curretDay = date('l', strtotime($currentDateTime));
    $currentTime = date('H:i:s');
    while ($rtdoDiasHoras = $consultaDiasHorasCurso->fetch_assoc()) {
        $dayName = $rtdoDiasHoras['dayName'];

        if ($dayName == $curretDay) {
            $diaBien = true;
            $horaInicio = $rtdoDiasHoras['horaInicioCurso'];
            $horaFin = $rtdoDiasHoras['horaFinCurso'];

            if ($currentTime >= $horaInicio && $currentTime <= $horaFin) {
                $horaBien = true;


                if ($horaBien && $diaBien) {
                    
                    $diaHoraBien = true;
                    
                    $consultaDiasHorasCurso = $con->query("SELECT * FROM `diassinclases` WHERE `fechaDiaSinClases` LIKE '$currentDateTime%'");
                    
                    if(($consultaDiasHorasCurso->num_rows) != 0){
                        $diaSinClases = true;
                    }
                    

                    break;
                }
            }
        }
    }
}

$hayFechasCursado = false;
$hayAlumnos = false;

$consulta2 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
$cursoFechas = $consulta2->fetch_assoc();

$fechaD = $cursoFechas["fechaDesdeCursado"];
$fechaH = $cursoFechas["fechaHastaCursado"];

$fechaDesdeCursado = date_create($cursoFechas["fechaDesdeCursado"]);
$fechaHastaCursado = date_create($cursoFechas["fechaHastaCursado"]);

$fechaDesdeCursadoF = date_format($fechaDesdeCursado, "d/m/Y");
$fechaHastaCursadoF = date_format($fechaHastaCursado, "d/m/Y");

if (($fechaD != null && $fechaH != null) && ($fechaH >= $currentDateTime)) {
    $hayFechasCursado = true;

    $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaD' AND `fechaHastaAlumCurAc` = '$fechaH'  AND `curso_id` = '$id_curso' ");

    if (mysqli_num_rows($consultaAlumnos) != 0) {
        $hayAlumnos = true;
    }
}

$cursadoFuturo = true;

if (($fechaD > $currentDateTime)) {
    $cursadoFuturo = false;
}

?>

<script src="profesor.js"></script>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1><?php echo $curso["nombreCurso"] ?></h1>

        <?php
        if (!$hayFechasCursado) {
            echo "<div class='alert alert-danger' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no se han definido las fechas de inicio y fin del cursado.</h5>
                </div>";
        }
        if (($fechaD != null && $fechaH != null) && ($fechaH >= $currentDateTime)) {
            echo "<h6 class='font-weight-normal'><b>Inicio del cursado:</b> $fechaDesdeCursadoF </h6>";
            echo "<h6 class='font-weight-normal'><b>Finalización del cursado:</b> $fechaHastaCursadoF </h6>";
        }
        ?>

        <?php
        if (!$hab) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Su estado el día de hoy es $estadoCargo, no puede tomar asistencia.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>";
        }

        if (!$tieneDiaHora) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay horario definido para este curso. No puede tomar asistencia.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>";
        } else {
            if (!$diaHoraBien) {

                if ($diaBien && !$horaBien) {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No es el horario de cursado. No puede tomar asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }

                if (!$diaBien && !$horaBien) {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No es el día ni horario de cursado. No puede tomar asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }
                
                
            } else {
                if (!$diaBien) {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Este curso no se dicta este día, no puede tomar asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }
                 if ($diaSinClases) {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Este día esta registrado como sin clases, no se puede tomar asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }
            }
        }
        
       

        if (!$hayAlumnos) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no hay alumnos inscriptos para este período.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>";
        }

        if (($fechaD > $currentDateTime)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>El cursado todavía no empieza.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>";
        }

        ?>
        <a class="btn btn-info" href="/DayClass/Profesor/index.php"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <a <?php

            if (!$hayAlumnos) {
                echo 'class="btn btn-success disabled" ';
            } else {
                echo 'class="btn btn-success" ';
                echo "href='inscriptos.php?id_curso=$id_curso'";
            }
            ?>><i class="fa fa-list-alt mr-1"></i>Ver inscriptos</a>

        <button class="btn btn-warning" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-clock-o mr-1"></i>Horarios</button>
    </div>

    <?php
    if (isset($_GET['resultado'])) {
        switch ($_GET['resultado']) {
            case '1':
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Se guardaron los datos de asistencia correctamente.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;

            case '2':
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al guardar los datos de asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
            case '3':
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ya se tomó asistencia el día de hoy en este curso.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
        }
    }
    ?>

    <!-- Page Features -->
    <div class="row text-center">

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/reportes.png" alt="" oncontextmenu="return false">
                <div class="card-body">
                    <h5 class="card-title">Reportes y estadísticas</h5>
                    <p class="card-text">Genere reportes y estadísticas de asistencia de los alumnos del curso.</p>
                </div>

                <div class="card-footer">
                    <a <?php
                        if ($hab && $hayFechasCursado && $hayAlumnos) {
                            echo 'class="btn btn-primary"';
                            echo "href='/DayClass/Profesor/Reportes/reporte_curso.php?id_curso=$id_curso' ";
                        } else {
                            echo 'class="btn btn-primary disabled"';
                        }
                        ?>><i class="fas fa-file-invoice mr-1"></i>Reportes</a>
                    <a <?php
                        if ($hab && $hayFechasCursado && $hayAlumnos) {
                            echo 'class="btn btn-success"';
                            echo "href='/DayClass/Profesor/Estadisticas/estadistica_curso.php?id_curso=$id_curso' ";
                        } else {
                            echo 'class="btn btn-success disabled"';
                        }
                        ?>><i class="fas fa-chart-pie mr-1"></i>Estadísticas</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/Pizzarra-de-novedades.png" alt="pizarra-novedades" oncontextmenu="return false">
                <div class="card-body">
                    <h5 class="card-title">Pizarra de novedades</h5>
                    <p class="card-text">Publica novedades para los alumnos del curso.</p>
                </div>
                <div class="card-footer">
                    <a <?php
                        if ($hab && $hayFechasCursado && $hayAlumnos) {
                            echo 'class="btn btn-primary"';
                            echo "href='/DayClass/Profesor/PizarraNovedades/pizarra.php?id_curso=$id_curso'";
                        } else {
                            echo 'class="btn btn-primary disabled"';
                        }
                        ?>><i class="fa fa-newspaper mr-1"></i>Ingresar</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/asistencia.png" alt="" oncontextmenu="return false">
                <div class="card-body">
                    <h5 class="card-title">Asistencias</h5>
                    <p class="card-text">Concurrencia de alumnos al curso.</p>
                </div>
                <div class="card-footer">
                    <a <?php
                        if ($hab && $diaHoraBien && $tieneDiaHora && $hayFechasCursado && $hayAlumnos && $cursadoFuturo && !$diaSinClases) {
                            echo 'class="btn btn-primary"';
                            echo "href='/DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso'";
                        } else {
                            echo 'class="btn btn-primary disabled"';
                        }
                        ?>><i class="fas fa-clock mr-1"></i>Autoasistencia</a>
                    <a <?php
                        if ($hab && $diaHoraBien && $tieneDiaHora && $hayFechasCursado && $hayAlumnos && $cursadoFuturo && !$diaSinClases) {
                            echo 'class="btn btn-success"';
                            echo "href='/DayClass/Profesor/Asistencia/tradicional.php?id_curso=$id_curso'";
                        } else {
                            echo 'class="btn btn-success disabled"';
                        }
                        ?>><i class="fas fa-tasks mr-1"></i>Tradicional</a>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- Modal de horarios curso -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Horarios de cursado</h3>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table text-center table-bordered bg-light table-striped">

                        <?php
                        include "../databaseConection.php";

                        $id_curso = $_GET["id_curso"];

                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                        $currentDateTime = date('Y-m-d');

                        $consulta3 = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");

                        $contador = 0;


                        if (($consulta3->num_rows) == 0) {
                            echo "<div class='alert alert-warning' role='alert'>
                                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no se han definido horarios para este curso.</h5>
                                    </div>";
                        } else {

                            echo "<thead>
                                            <th>Día</th>
                                            <th>Hora desde</th>
                                            <th>Hora hasta</th>
                                        </thead>
                                       <tbody> ";
                            while ($horarioCurso = $consulta3->fetch_assoc()) {

                                $dia = $horarioCurso["nombreDia"];
                                $horaDesde = $horarioCurso["horaInicioCurso"];
                                $horaHasta = $horarioCurso["horaFinCurso"];
                                echo "<tr>
                                        <td>" . $dia . "</td>
                                        <td>" . strftime("%H:%M", strtotime($horaDesde)) . "</td>
                                        <td>" . strftime("%H:%M", strtotime($horaHasta)) . "</td>
                                    </tr>";

                                $contador++;
                            }

                            echo " </tbody>";
                        }

                        ?>

                    </table>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/TemaDia/temaDelDia.php?id_curso=" . $id_curso . "><i id=icono ></i>Tema del día</a>';"; ?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['profesor']['nombreProf'] . " " . $_SESSION['profesor']['apellidoProf'] . "'" ?>
</script>
<?php
include "../footer.html";
?>