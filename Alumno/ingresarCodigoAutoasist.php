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
    //el codigo no existe
    header("Location:/DayClass/Alumno/Index.php?resultado=2");
}else{
    $resultado1 = $consulta->fetch_assoc();
    $fchFinCodigo = $resultado1["fechaHoraFinCodigo"];
    
    //validar que todavia este a tiempo de ingresar el codigo
    if($fchFinCodigo >= $currentDateTime){
        $cursoCodigo = $resultado1["curso_id"];
        
        $consulta2 = $con -> query("SELECT * FROM alumnocursoactual WHERE curso_id = '".$cursoCodigo."' AND  alumno_id = '".$id_alumno."'");
        
        if(mysqli_num_rows($consulta2) == 0){
            //se ingreso el codigo de otra materia en otro curso
            header("Location:/DayClass/Alumno/Index.php?resultado=4");
        }else{
            $consulta3 = $con -> query("SELECT * FROM asistencia WHERE curso_id = '".$cursoCodigo."' AND  alumno_id = '".$id_alumno."'");
            $resultado3 = $consulta3->fetch_assoc();
            $asistenciaAlumno = $resultado3["id"];
            
            $consPresente = $con -> query("SELECT id FROM `tipoasistencia` WHERE `nombreTipoAsistencia` = 'PRESENTE'");
            $resultado4 = $consPresente->fetch_assoc();
            $presenteId = $resultado4["id"];
            
            $consAusente = $con -> query("SELECT id FROM `tipoasistencia` WHERE `nombreTipoAsistencia` = 'AUSENTE'");
            $resultado5 =  $consAusente->fetch_assoc();
            $ausenteId = $resultado5["id"];
            
            
            $ultimoRegistro = $con -> query("SELECT * FROM asistenciadia WHERE id = (SELECT MAX(id) FROM asistenciadia) AND tipoAsistencia_id = '".$ausenteId."'");
            $resultado6 = $ultimoRegistro->fetch_assoc();
            $ultimoRegistroId = $resultado6["id"];
            
            $update = $con -> query("UPDATE `asistenciadia` SET `tipoAsistencia_id`= '".$presenteId."',`fechaHoraAsisDia`= '".$currentDateTime."' WHERE `id` = '".$ultimoRegistroId."'");
            
            if($update){
                //registro de presente 
                header("Location:/DayClass/Alumno/Index.php?resultado=1");
            }else{
                //echo problema al registrar le presente del alumno
                header("Location:/DayClass/Alumno/Index.php?resultado=5");
            }
            
        }

        
    }else{
        //codigo correcto pero ingresado fuera de tiempo
        header("Location:/DayClass/Alumno/Index.php?resultado=3");
    }
}


?>