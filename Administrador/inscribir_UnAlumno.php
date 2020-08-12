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

$consultaAlumID = $con->query("SELECT id FROM `alumno` WHERE (dniAlum = $dni OR legajoAlumno = $legajo) AND fechaBajaAlumno IS NULL");

if(mysqli_num_rows($consultaAlumID) == 0){
    //alumno inexistente o alumno dado de baja 
    header("Location:/DayClass/Administrador/inscribirAlumnos.php?id=$id_curso&&resultado=2");
    //echo "el alumno no existe";
    
}else{
    echo "el alumno existe";
    $resultado3= $consultaAlumID->fetch_assoc();
    $id_alumno = $resultado3["id"];
    
    echo "$id_alumno";
    echo "$id_curso";
    
    
    $consultaAlumCursAct = $con->query("SELECT id FROM `alumnocursoactual` WHERE fechaDesdeAlumCurAc = '$fchDesde' AND fechaHastaAlumCurAc = '$fchHasta' AND alumno_id = '$id_alumno' AND curso_id = '$id_curso'");
    
    if(mysqli_num_rows($consultaAlumCursAct) == 0){
        //insert
        $resultadoInsertAlumCursAct = $con->query("INSERT INTO `alumnocursoactual`(`fechaDesdeAlumCurAc`, `fechaHastaAlumCurAc`, `alumno_id`, `curso_id`) VALUES ('$fchDesde','$fchHasta','$id_alumno','$id_curso')");
        
        $resultadoInsertAsist = $con->query("INSERT INTO `asistencia`( `alumno_id`, `curso_id`, `fechaHastaFichaAsis`) VALUES ('$id_alumno','$id_curso','$fchHasta')");
        
        echo "INSERT INTO `alumnocursoactual`(`fechaDesdeAlumCurAc`, `fechaHastaAlumCurAc`, `alumno_id`, `curso_id`) VALUES ('$fchDesde','$fchHasta','$id_alumno','$id_curso')";
        
        echo "INSERT INTO `asistencia`( `alumno_id`, `curso_id`, `fechaHastaFichaAsis`) VALUES ('$id_alumno','$id_curso','$fchHasta')";
        
        
        
        
        header("Location:/DayClass/Administrador/inscribirAlumnos.php?id=$id_curso&&resultado=1");
        
    }else{
        echo "else de ya existe";
        //alumno ya inscripto en esa materia
        header("Location:/DayClass/Administrador/inscribirAlumnos.php?id=$id_curso&&resultado=3");
    }
}

?>