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

if(isset($_GET["id_curso"])){
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

$hab =false;
//si el docente no tiene estado activo en ese materia en esa fecha, se desabilitaran los botones de asistencia 
if($estadoCargo == "Activo"){
    $hab = true;
}



?>

<script src="profesor.js"></script>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1><?php echo $curso["nombreCurso"] ?></h1>
        
        <?php 
                if(!$hab){
                echo "<div class='alert alert-danger' role='alert'>
                            <h5>Su estado el dia de hoy, es $estadoCargo no puede tomar Asistencia</h5>
                        </div>"; 
            }
        ?>
        <a class="btn btn-secondary" href="/DayClass/Profesor/index.php"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <a class="btn btn-info" <?php echo "href='inscriptos.php?id_curso=$id_curso'"; ?> ><i class="fa fa-list-alt mr-1"></i>Ver inscriptos</a>
    </div>

    <?php
        if(isset($_GET['resultado'])){
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
                    <a href="#" class="btn btn-primary">Crear</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/Pizzarra-de-novedades.png" alt="pizarra-novedades" oncontextmenu="return false">
                <div class="card-body">
                    <h4 class="card-title">Pizzarra de novedades</h4>
                    <p class="card-text">Publica novedades para los alumnos del curso</p>
                </div>
                <div class="card-footer">
                    <a <?php echo "href='pizarra.php?id_curso=$id_curso'"; ?> class="btn btn-primary">Ingresar</a>
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
                    <a 
                       <?php
                            if($hab){
                                echo 'class="btn btn-primary"'; 
                               echo "href='/DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso'"; 
                                
                            }else{
                                echo 'class="btn btn-primary disabled"';
                               
                            }
                        ?>>Autoasistencia</a>
                    <a <?php
                            if($hab){
                                echo 'class="btn btn-success"'; 
                               echo "href='/DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso'"; 
                                
                            }else{
                                echo 'class="btn btn-success disabled"';
                               
                            }
                        ?>  >Tradicional</a>
                    
                </div>
            </div>
        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/tema-del-dia.php?id_curso=".$id_curso."><i id=icono ></i>Tema del día</a>';"; ?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>

<?php
include "../footer.html";
?>