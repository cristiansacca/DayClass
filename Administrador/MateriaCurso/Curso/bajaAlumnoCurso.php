<?php
include "../../../databaseConection.php";

    
$id_curso = $_GET['cursoId'];
$id_alumno = $_GET['alumnoId'];



date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

//traerse el estado de ese alumno en ese curso al dia de hoy
$selectAlumnoCursoEstado = $con->query("SELECT cursoestadoalumno.nombreEstado, alumnocursoestado.id AS idAlumnoCursoEstado, alumnocursoestado.alumnoCursoActual_id, alumnocursoestado.fechaFinEstado, alumnocursoestado.fechaInicioEstado FROM alumnocursoactual, alumno, curso, alumnocursoestado, cursoestadoalumno WHERE alumno.id = '$id_alumno' AND curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDateTime' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND alumnocursoactual.fechaDesdeAlumCurAc = alumnocursoestado.fechaInicioEstado AND alumnocursoactual.fechaHastaAlumCurAc = alumnocursoestado.fechaFinEstado AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'INSCRIPTO'");

if(!($selectAlumnoCursoEstado->num_rows) == 0){
    $alumnoCursoEstado = $selectAlumnoCursoEstado->fetch_assoc();
    $id_alumnoCursoEstado = $alumnoCursoEstado["idAlumnoCursoEstado"];
    $fechaFinAlumnoCursoEstado = $alumnoCursoEstado["fechaFinEstado"];
    $id_alumnoCursoActual = $alumnoCursoEstado["alumnoCursoActual_id"];

    //actulizar la fecha hasta del estado inscripto hasta hoy 
    $updateAlumnoCursoEstado = $con->query("UPDATE `alumnocursoestado` SET `fechaFinEstado`='$currentDateTime' WHERE `id` = $id_alumnoCursoEstado");

    if($updateAlumnoCursoEstado){
        //crear una instancia nueva de estado, relacionada a estado = libre, a partir de hoy y hasta el fin del cursado
        $insertAlumnoCursoEstado = $con->query("INSERT INTO `alumnocursoestado`(`fechaFinEstado`, `fechaInicioEstado`, `alumnoCursoActual_id`, `cursoEstadoAlumno_id`) VALUES ('$fechaFinAlumnoCursoEstado','$currentDateTime','$id_alumnoCursoActual','2')");

        if($consulta){
          header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=3");

    }else{
        header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=4");
    }
}else{
    //error 
}

}else{
    //error 
}







?>