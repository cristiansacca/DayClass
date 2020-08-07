<?php
include "../header.html";
include "../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

$id_alumno = $_SESSION['alumno']["id"];
date_default_timezone_set('America/Argentina/Mendoza');
$currentDateTime = date('Y-m-d H:i:s');

$codigo = $_POST["inputCodigoIngresado"];


$consulta = $con->query("SELECT * FROM `codigoasitencia` WHERE `numCodigo` = '$codigo'");


if(($consulta->num_rows) == 0){
    echo "error";
}else{
    $resultado1 = $consulta->fetch_assoc();
    $fchFinCodigo = $resultado1["fechaHoraFinCodigo"];
    
    if($fchFinCodigo >= $currentDateTime){
        $cursoCodigo = $resultado1["curso_id"];
        $consulta2 = $con -> query("SELECT * FROM alumnocursoactual WHERE curso_id = '".$cursoCodigo."' AND  alumno_id = '".$id_alumno."'");
        
        if(mysqli_num_rows($consulta2) == 0){
            echo "codigo de un curso no inscripto bestia";
        }else{
            $consulta3 = $con -> query("SELECT * FROM asistencia WHERE curso_id = '".$cursoCodigo."' AND  alumno_id = '".$id_alumno."'");
            $resultado3 = $consulta3->fetch_assoc();
            $asistenciaAlumno = $resultado3["id"];
            
            $consulta4 = $con -> query("INSERT INTO `asistenciadia`(`fechaHoraAsisDia`, `asistencia_id`, `tipoAsistencia_id`) VALUES ('$currentDateTime','$asistenciaAlumno', '1')");
            
            if($consulta4){
                echo "tdo correcto";
            }else{
                echo "falla en el insert";
            }
            
        }

        
    }else{
        echo "se paso el tiempo JODETE";
    }
}


?>