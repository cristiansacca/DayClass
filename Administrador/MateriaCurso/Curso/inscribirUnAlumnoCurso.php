<?php
include "../databaseConection.php";

$id_curso = $_POST["cursoId"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$consulta1 = $con->query("SELECT * FROM `curso` WHERE id = '$id_curso'");
$resultado1 = $consulta1->fetch_assoc();
$fchDesde = $resultado1['fechaDesdeCursado'];
$fchHasta = $resultado1['fechaHastaCursado'];

echo "$fchDesde";
//consultar existencia del alumno (habilitado = fecha de baja null) en la BD  de dayclass
$consultaAlumID = $con->query("SELECT id FROM `alumno` WHERE (dniAlum = $dni AND legajoAlumno = $legajo) AND fechaBajaAlumno IS NULL");

if(mysqli_num_rows($consultaAlumID) == 0){
    //si la cosnulta es vacia, el alumno no existe o esta dado de baja, error 2 = alumno inexistente o dado de baja 
    header("Location:/DayClass/Administrador/inscribirAlumnos.php?id=$id_curso&&resultado=2");
    
    
}else{
    $resultado3= $consultaAlumID->fetch_assoc();
    $id_alumno = $resultado3["id"];
    
    echo "$id_alumno";
    echo "$id_curso";
    
    //verificar que el alumno no vaya a estar inscripto en el ese curso 
    $consultaAlumCursAct = $con->query("SELECT id FROM `alumnocursoactual` WHERE fechaDesdeAlumCurAc = '$fchDesde' AND fechaHastaAlumCurAc = '$fchHasta' AND alumno_id = '$id_alumno' AND curso_id = '$id_curso'");
    
    if(mysqli_num_rows($consultaAlumCursAct) == 0){
        //si la consulta es vacia, no hay una inscripcion de ese alumno en ese curso en estas fechas actuales
        
        //se crea la instancia de inscripcion del alumno
        $resultadoInsertAlumCursAct = $con->query("INSERT INTO `alumnocursoactual`(`fechaDesdeAlumCurAc`, `fechaHastaAlumCurAc`, `alumno_id`, `curso_id`) VALUES ('$fchDesde','$fchHasta','$id_alumno','$id_curso')");
        
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