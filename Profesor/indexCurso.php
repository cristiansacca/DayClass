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
if(!($consultaDiasHorasCurso)==0){
    $tieneDiaHora = true;
    $curretDay = date('l', strtotime($currentDateTime));
    $currentTime = date('H:i:s');
    while ($rtdoDiasHoras = $consultaDiasHorasCurso->fetch_assoc()){
        $dayName = $rtdoDiasHoras['dayName'];
        
        if($dayName == $curretDay){
            $diaBien = true;
            $horaInicio = $rtdoDiasHoras['horaInicioCurso'];
            $horaFin = $rtdoDiasHoras['horaFinCurso'];
            
            if($currentTime >= $horaInicio && $currentTime <=$horaFin ){
                $horaBien = true; 
                
                
                if ($horaBien && $diaBien){
                    $diaHoraBien= true;
                    
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

$fechaDesdeCursadoF = date_format($fechaDesdeCursado,"d/m/Y");
$fechaHastaCursadoF = date_format($fechaHastaCursado,"d/m/Y");

if(($fechaD != null && $fechaH != null) && ($fechaH >= $currentDateTime)){
    $hayFechasCursado = true;
    
    $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaD' AND `fechaHastaAlumCurAc` = '$fechaH'  AND `curso_id` = '$id_curso' ");
    
    if(mysqli_num_rows($consultaAlumnos) != 0 ){
        $hayAlumnos = true;
    }
}

?>

<script src="profesor.js"></script>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1><?php echo $curso["nombreCurso"] ?></h1>
        
        <?php
        if(!$hayFechasCursado){              
            echo "<div class='alert alert-danger' role='alert'>
                    <h5>Todavia no se han definido las fechas de inicio y fin del cursado.</h5>
                </div>";
        }
            if(($fechaD != null && $fechaH != null) && ($fechaH >= $currentDateTime)){
                echo "<h6>Inicio del cursado: $fechaDesdeCursadoF </h6>";
                echo "<h6>Finalización del cursado: $fechaHastaCursadoF </h6>";
            }
        ?>

        <?php
        if (!$hab) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5>Su estado el dia de hoy es $estadoCargo, no puede tomar asistencia.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>";
        }
            
        if(!$tieneDiaHora){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5>No hay horario definido para este curso, no puede tomar asistencia.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>";
        }else{
           if(!$diaHoraBien){
                            
               if($diaBien && !$horaBien){
                   echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5>No es el horario de cursado, no puede tomar asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
               }
               
               if(!$diaBien && !$horaBien){
                   echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5>No es el día ni horario de cursado, no puede tomar asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>"; 
               }
               
            }else{
               if(!$diaBien){
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5>Este curso no se dicta este dia, no puede tomar asistencia.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }
               
           }  
        }
        
        if(!$hayAlumnos){
           echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <h5>Todavia no hay alumnos incriptos para este periodo.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>"; 
        }
        
        ?>
        <a class="btn btn-secondary" href="/DayClass/Profesor/index.php"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <a <?php 
           
           if(!$hayAlumnos){
             echo 'class="btn btn-info disabled" ';  
           }else{
               echo 'class="btn btn-info" ';
               echo "href='inscriptos.php?id_curso=$id_curso'";
           }
           ?>><i class="fa fa-list-alt mr-1"></i>Ver inscriptos</a>
    </div>

    <?php
    if (isset($_GET['resultado'])) {
        switch ($_GET['resultado']) {
            case '1':
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5>Se guardaron los datos de asistencia correctamente</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;

            case '2':
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5>Ocurió un error al guardar los datos de asistencia</h5>
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
                    <h4 class="card-title">Reportes y estadísticas</h4>
                    <p class="card-text">Genere reportes y estadisticas de asistencias</p>
                </div>

                <div class="card-footer">
                    <a
                       <?php 
                        if ($hab && $hayFechasCursado && $hayAlumnos) {
                            echo 'class="btn btn-primary"';
                            echo "href='#' ";
                        }else {
                            echo 'class="btn btn-primary disabled"';
                        } 
                        ?>>Crear</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/Pizzarra-de-novedades.png" alt="pizarra-novedades" oncontextmenu="return false">
                <div class="card-body">
                    <h4 class="card-title">Pizarra de novedades</h4>
                    <p class="card-text">Publica novedades para los alumnos del curso</p>
                </div>
                <div class="card-footer">
                    <a <?php 
                        if ($hab && $hayFechasCursado && $hayAlumnos) {
                            echo 'class="btn btn-primary"';
                            echo "href='pizarra.php?id_curso=$id_curso'";
                        } else {
                            echo 'class="btn btn-primary disabled"';
                        } 
                        ?>>Ingresar</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/asistencias.png" alt="" oncontextmenu="return false">
                <div class="card-body">
                    <h4 class="card-title">Asistencias</h4>
                    <p class="card-text">Concurrencia al aula de los alumnos </p>
                </div>
                <div class="card-footer">
                    <a <?php
                        if ($hab && $diaHoraBien && $tieneDiaHora && $hayFechasCursado && $hayAlumnos) {
                            echo 'class="btn btn-primary"';
                            echo "href='/DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso'";
                        } else {
                            echo 'class="btn btn-primary disabled"';
                        }
                        ?>>Autoasistencia</a>
                    <a <?php
                        if ($hab && $diaHoraBien && $tieneDiaHora && $hayFechasCursado && $hayAlumnos) {
                            echo 'class="btn btn-success"';
                            echo "href='/DayClass/Profesor/Asistencia/tradicional.php?id_curso=$id_curso'";
                        } else {
                            echo 'class="btn btn-success disabled"';
                        }
                        ?>>Tradicional</a>

                </div>
            </div>
        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php 
        
        if($hab && $diaHoraBien && $tieneDiaHora && $hayFechasCursado && $hayAlumnos){
            echo "'<a class=nav-link href=/DayClass/Profesor/tema-del-dia.php?id_curso=" . $id_curso . "><i id=icono ></i>Tema del día</a>';";

        }else{
            echo "'<a class=nav-link disabled><i id=icono ></i>Tema del día</a>';";

        }?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>
<?php
include "../footer.html";
?>