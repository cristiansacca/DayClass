<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

$id_alumno = $_SESSION['alumno']["id"];
date_default_timezone_set('America/Argentina/Mendoza');
$currentDateTime = date('Y-m-d H:i:s');
$currentDate = date('Y-m-d');


$codigo = $_POST["inputCodigoIngresado"];


$consulta = $con->query("SELECT * FROM `codigoasitencia` WHERE `numCodigo` = '$codigo'");


if(($consulta->num_rows) == 0){
    //el codigo no existe
    header("Location:/DayClass/Alumno/index.php?resultado=2");
}else{
    $resultado1 = $consulta->fetch_assoc();
    $fchFinCodigo = $resultado1["fechaHoraFinCodigo"];
    
    //validar que todavia este a tiempo de ingresar el codigo
    if($fchFinCodigo >= $currentDateTime){
        $cursoCodigo = $resultado1["curso_id"];
        
        $consulta2 = $con -> query("SELECT * FROM alumnocursoactual WHERE curso_id = '".$cursoCodigo."' AND  alumno_id = '".$id_alumno."'");
        
        if(mysqli_num_rows($consulta2) == 0){
            //se ingreso el codigo de otra materia en otro curso
            header("Location:/DayClass/Alumno/index.php?resultado=4");
        }else{
            
            $consultaEstadoAlumno = $con->query("SELECT cursoestadoalumno.nombreEstado FROM alumno, curso, alumnocursoactual, alumnocursoestado, cursoestadoalumno WHERE alumno.id='$id_alumno' AND curso.id = '$cursoCodigo' AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDate' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDate' AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoestado.fechaInicioEstado <= '$currentDate' AND alumnocursoestado.fechaFinEstado > '$currentDate' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id");
            $estadoAlumno = $consultaEstadoAlumno->fetch_assoc();
            $nombreEstadoAlumno = $estadoAlumno["nombreEstado"];
            
            if($nombreEstadoAlumno == "LIBRE"){
                //el alumno esta libre en la materia no puede resgistrar asistencia
                header("Location:/DayClass/Alumno/index.php?resultado=6");
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
            
                $ultimoRegistro = $con -> query("SELECT * FROM asistenciadia WHERE id = (SELECT MAX(id) FROM asistenciadia WHERE tipoAsistencia_id = '".$ausenteId."' AND asistencia_id = '".$asistenciaAlumno."' AND fechaHoraAsisDia LIKE '$currentDate%')");
                $resultado6 = $ultimoRegistro->fetch_assoc();
                
                
                echo "SELECT * FROM asistenciadia WHERE id = (SELECT MAX(id) FROM asistenciadia WHERE tipoAsistencia_id = '".$ausenteId."' AND asistencia_id = '".$asistenciaAlumno."' AND fechaHoraAsisDia LIKE '$currentDate%')";
                
                $ultimoRegistroId = $resultado6["id"];
            
                $update = $con -> query("UPDATE `asistenciadia` SET `tipoAsistencia_id`= '".$presenteId."',`fechaHoraAsisDia`= '".$currentDateTime."' WHERE `id` = '".$ultimoRegistroId."'");
                
                echo "UPDATE `asistenciadia` SET `tipoAsistencia_id`= '".$presenteId."',`fechaHoraAsisDia`= '".$currentDateTime."' WHERE `id` = '".$ultimoRegistroId."'";
            
                if($update){
                    //registro de presente 
                    header("Location:/DayClass/Alumno/index.php?resultado=1");
                }else{
                    //echo problema al registrar le presente del alumno
                    header("Location:/DayClass/Alumno/index.php?resultado=5");
                } 
            }
            
        }

        
    }else{
        //codigo correcto pero ingresado fuera de tiempo
        header("Location:/DayClass/Alumno/index.php?resultado=3");
    }
}


?>