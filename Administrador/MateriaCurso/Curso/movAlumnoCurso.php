<?php
include "../../../databaseConection.php";
    
$id_curso = $_GET['cursoId'];
$id_alumno = $_GET['alumnoId'];
$id_mov = $_GET['movId'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

if($id_mov == 1){
    //traerse el estado de ese alumno en ese curso al dia de hoy
    $selectAlumnoCursoEstado = $con->query("SELECT cursoestadoalumno.nombreEstado, alumnocursoestado.id AS idAlumnoCursoEstado, alumnocursoestado.alumnoCursoActual_id, alumnocursoestado.fechaFinEstado, alumnocursoestado.fechaInicioEstado FROM alumnocursoactual, alumno, curso, alumnocursoestado, cursoestadoalumno WHERE alumno.id = '$id_alumno' AND curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDateTime' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND (alumnocursoactual.fechaDesdeAlumCurAc <= alumnocursoestado.fechaInicioEstado) AND (alumnocursoactual.fechaHastaAlumCurAc >= alumnocursoestado.fechaFinEstado) AND alumnocursoestado.fechaInicioEstado <= '$currentDateTime' AND alumnocursoestado.fechaFinEstado > '$currentDateTime' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'INSCRIPTO'");

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

                if($insertAlumnoCursoEstado){
                    //se dio de baja al alumno en el curso 
                    header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=5");

                }else{
                    //error 
                    header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
                }
        }else{
                //error 
                header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
        }

    }else{
        //error 
        header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
    }
}else{
    //traerse el estado de ese alumno en ese curso al dia de hoy
    $selectAlumnoCursoEstado = $con->query("SELECT cursoestadoalumno.nombreEstado, alumnocursoestado.id AS idAlumnoCursoEstado, alumnocursoestado.alumnoCursoActual_id, alumnocursoestado.fechaFinEstado, alumnocursoestado.fechaInicioEstado FROM alumnocursoactual, alumno, curso, alumnocursoestado, cursoestadoalumno WHERE alumno.id = '$id_alumno' AND curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDateTime' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND (alumnocursoactual.fechaDesdeAlumCurAc <= alumnocursoestado.fechaInicioEstado) AND (alumnocursoactual.fechaHastaAlumCurAc >= alumnocursoestado.fechaFinEstado) AND alumnocursoestado.fechaInicioEstado <= '$currentDateTime' AND alumnocursoestado.fechaFinEstado > '$currentDateTime' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'LIBRE'");

    if(!($selectAlumnoCursoEstado->num_rows) == 0){
        $alumnoCursoEstado = $selectAlumnoCursoEstado->fetch_assoc();
        $id_alumnoCursoEstado = $alumnoCursoEstado["idAlumnoCursoEstado"];
        $fechaFinAlumnoCursoEstado = $alumnoCursoEstado["fechaFinEstado"];
        $id_alumnoCursoActual = $alumnoCursoEstado["alumnoCursoActual_id"];

        //actulizar la fecha hasta del estado libre hasta hoy 
        $updateAlumnoCursoEstado = $con->query("UPDATE `alumnocursoestado` SET `fechaFinEstado`='$currentDateTime' WHERE `id` = $id_alumnoCursoEstado");

        if($updateAlumnoCursoEstado){
            //crear una instancia nueva de estado, relacionada a estado = Inscripto, a partir de hoy y hasta el fin del cursado
            $insertAlumnoCursoEstado = $con->query("INSERT INTO `alumnocursoestado`(`fechaFinEstado`, `fechaInicioEstado`, `alumnoCursoActual_id`, `cursoEstadoAlumno_id`) VALUES ('$fechaFinAlumnoCursoEstado','$currentDateTime','$id_alumnoCursoActual','1')");

                if($insertAlumnoCursoEstado){
                    //se reincorporo al alumno en el curso 
                    header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=6");

                }else{
                    //error 
                    header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=7");
                }
        }else{
                //error 
                header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=7");
        }

    }else{
        //error 
        header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=7");
    }
}
?>