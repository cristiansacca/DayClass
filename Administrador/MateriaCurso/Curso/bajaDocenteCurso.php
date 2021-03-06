<?php
include "../../../databaseConection.php";

    
$id_curso = $_GET['cursoId'];
$id_prof = $_GET['docenteId'];


date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

    //traerse todos los docentes de ese curso 
    $selectDocentesCurso = $con->query("SELECT usuario.id, usuario.legajoUsuario, usuario.apellidoUsuario, usuario.nombreUsuario FROM cargoprofesor, curso, usuario WHERE cargoprofesor.profesor_id = usuario.id AND cargoprofesor.curso_id = curso.id  AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL");


    //si hay mas de un docente asociado al curso, se procede a dar la baja de otro docente
    if(($selectDocentesCurso->num_rows) > 1){
        
        $selectDocenteUltimoEstado = $con->query("SELECT cargoprofesor.id FROM cargoprofesor WHERE cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL")->fetch_assoc();
        
        $id_cargoDocente = $selectDocenteUltimoEstado["id"];
        
        //actulizar la fecha hasta del estado inscripto hasta hoy 
        $finalizarCargoDocente = $con->query("UPDATE `cargoprofesor` SET `fechaHastaCargo`='$currentDateTime' WHERE `id` = '$id_cargoDocente'");
        
        if($finalizarCargoDocente){
            header("Location:/DayClass/Administrador/MateriaCurso/Curso/docentesCurso.php?id=$id_curso&&resultado=8");

        }else{
            //error 
            header("Location:/DayClass/Administrador/MateriaCurso/Curso/docentesCurso.php?id=$id_curso&&resultado=4");
        }
        

    }else{
        //si solo hay un docente asociado al curso, no se lo da de baja  
        header("Location:/DayClass/Administrador/MateriaCurso/Curso/docentesCurso.php?id=$id_curso&&resultado=9");
    }

?>