<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
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

?>

<link rel="stylesheet" href="../styleCards.css">



<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <?php
            include "../databaseConection.php";
            $id_curso = $_GET["id_curso"];

            $consulta1 = $con->query("SELECT curso.nombreCurso, materia.nombreMateria, division.nombreDivision, modalidad.nombre AS nombreModalidad FROM `curso`, materia, division, modalidad WHERE curso.id = '$id_curso' AND curso.materia_id = materia.id AND curso.division_id = division.id AND division.modalidad_id = modalidad.id");
            $curso = $consulta1->fetch_assoc();
            $nombreCurso = $curso["nombreCurso"];
            $nombreMateria = $curso["nombreMateria"];
            $nombreDivision = $curso["nombreDivision"];
            $nombreModalidad = $curso["nombreModalidad"];
            
            echo "<h3>$nombreMateria</h3>";
            echo "<h1>$nombreCurso</h1>";
            echo "<h3>$nombreDivision - $nombreModalidad</h3>";
            
        ?>
        
        
        <a class="btn btn-info" href="/DayClass/Alumno/index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Atras</a>
    </div>
    <!-- Page Features -->
    <h2>Docentes</h2>
    <div class="py-4 my-3 jumbotron" style="background-color:PowderBlue;">
        <?php
            include "../databaseConection.php";
            $id_curso = $_GET["id_curso"];
        
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDateTime = date('Y-m-d');

            $consulta2 = $con->query("SELECT profesor.id, profesor.emailProf, profesor.apellidoProf, profesor.nombreProf, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo FROM cargoprofesor, curso, profesor, cargoprofesorestado, estadocargoprofesor, cargo WHERE cargoprofesor.profesor_id = profesor.id AND cargoprofesor.curso_id = curso.id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe <> 'Baja' AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");

            if(($consulta2->num_rows) == 0){
            echo "<div class='alert alert-warning' role='alert'>
                    <h5>Todavia no hay docentes asigandos a este curso, pronto entarán disponibles</h5>
                </div>";
            }else{
                
                while ($docentesCurso = $consulta2->fetch_assoc()) {
                
                $nombreDocente = $docentesCurso["nombreProf"];
                $apellidoDocente = $docentesCurso["apellidoProf"];
                $cargoDocente = $docentesCurso["nombreCargo"];
                $mailDocente = $docentesCurso["emailProf"];
                
                echo "<h4>$cargoDocente: <h5 style='display:inline'>$apellidoDocente, $nombreDocente - $mailDocente</h5></h4>";
                    
                
                }
            }
        ?>
    </div>
    
    <div class="row my-5">
       <?php
        include "../databaseConection.php";
        
        $id_curso = $_GET["id_curso"];
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');
        
        $consulta3 = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");
        
        $contador = 0;
        
       
        if(($consulta3->num_rows) == 0){
            echo "<div class='alert alert-warning' role='alert'>
                    <h5>Todavia no se han definido horaios para este curso</h5>
                </div>";
        }else{
            
            echo "<div class='col-lg-12'><h2>Horarios de cursado</h2></div>";
            while ($horarioCurso = $consulta3->fetch_assoc()) {
            if($contador == 4){
                $contador = 0;
            }
            
            $dia = $horarioCurso["nombreDia"];
            $horaDesde = $horarioCurso["horaInicioCurso"];
            $horaHasta = $horarioCurso["horaFinCurso"];
            echo "<div class='col-lg-2 col-md-12 mb-4' >
                <div class='card h-100 color$contador'>
                    <div class='card-body text-left'>
                        <h3 class='card-title'>$dia</h3>
                        <h5>Hora desde: $horaDesde</h5>
                        <h5>Hora hasta: $horaHasta</h5>
                    </div>
                </div>
            </div>" ;
            
            $contador ++;
       
            }
        }
        
        
    
        
    ?> 
        
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="alumno.js"></script>

<?php
include "modal-autoasistencia.php";
?>

<?php
include "../footer.html";
?>