<?php
include "../databaseConection.php";

$id_curso= $_POST["cursoId"];
$cargo = $_POST["selectcargo"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$consulta1 = $con->query("SELECT * FROM `curso` WHERE id = '$id_curso'");
$resultado1 = $consulta1->fetch_assoc();


$consultaAlumID = $con->query("SELECT id FROM `profesor` WHERE (dniProf = $dni AND legajoProf = $legajo) AND fechaBajaProf IS NULL");

if(mysqli_num_rows($consultaAlumID) == 0){
    //si la cosnulta es vacia, el docente no existe o esta dado de baja, error 2 = docente inexistente o dado de baja 
    header("Location:/DayClass/Administrador/inscribirAlumnos.php?id=$id_curso&&resultado=2");
    
    
}else{
    $resultado3= $consultaAlumID->fetch_assoc();
    $id_profesor = $resultado3["id"];
    
    //verificar que el alumno no vaya a estar inscripto en el ese curso 
    $consultaCargoProfesor = $con->query("SELECT id FROM `cargoprofesor` WHERE fechaDesdeCargo < '$currentDateTime' AND fechaHastaCargo ID NULL AND profesor_id = '$id_profesor' AND curso_id = '$id_curso'");
    
    if(mysqli_num_rows($consultaCargoProfesor) == 0){
        //si la consulta es vacia, ese profesror no esta registrado en ese curso 
        
        //se crea la instancia de cargoprofesor de ese curso 
        $resultadoInsertAlumCursAct = $con->query("INSERT INTO `cargoprofesor`(`fechaDesdeCrago`, `profesor_id`, `curso_id`, cargo_id) VALUES ('$currentDateTime','$id_profesor','$id_curso','$cargo')");
        
        
         $consultaDocenteCreado = $con -> query("SELECT * FROM cargoprofesor WHERE id_curso = ''");
        $resultado6 = $consultaDocenteCreado->fetch_assoc();
        $docenteCreadoId = $resultado6["id"];
        //se crea la instancia de planilla de asistencia que llevara la cuenta de las asistencias de los alumnos 
        $resultadoInsertAsist = $con->query("INSERT INTO `asistencia`( `alumno_id`, `curso_id`, `fechaHastaFichaAsis`) VALUES ('$id_alumno','$id_curso','$fchHasta')");
        
        //volver a la pagina que llamo, exito 1 = inscripcion exitosa 
        header("Location:/DayClass/Administrador/inscribirAlumnos.php?id=$id_curso&&resultado=1");
        
    }else{
        //error 3 = alumno ya inscripto en esa materia, en ese ciclo lectivo
        header("Location:/DayClass/Administrador/inscribirAlumnos.php?id=$id_curso&&resultado=3");
    }
}



	
?>