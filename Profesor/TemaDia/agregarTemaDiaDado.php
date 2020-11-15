<?php
include "../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');

$id_tema = $_POST["nombreTemaAgregar"];
$comentario = $_POST["comentarioAgregar"];
$id_curso = $_POST["id_curso2"];
$id_prof = $_POST["idProfesor"];
$fechaTema = $_POST["fechaTema"];

echo $id_tema;


if(isset($id_tema)){

    if(isset($comentario)){
        $insert = $con->query("INSERT INTO temadia (comentarioTema, fechaTemaDia, curso_id, temasMateria_id, profesor_id) VALUES ('$comentario', '$fechaTema', '$id_curso', '$id_tema','$id_prof')");
    } else {
        $insert = $con->query("INSERT INTO temadia (fechaTemaDia, curso_id, temasMateria_id, profesor_id) VALUES ('$fechaTema', '$id_curso', '$id_tema','$id_prof')");
    }
}else{
    
   $id_tema = $_POST["idTemaEspecialCrear"]; 
    if(isset($comentario)){
        $insert = $con->query("INSERT INTO temadia (comentarioTema, fechaTemaDia, curso_id, temasMateria_id, profesor_id) VALUES ('$comentario', '$fechaTema', '$id_curso', '$id_tema','$id_prof')");
    } else {
        $insert = $con->query("INSERT INTO temadia (fechaTemaDia, curso_id, temasMateria_id, profesor_id) VALUES ('$fechaTema', '$id_curso', '$id_tema','$id_prof')");
    }
    
}

if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
    header("location: /DayClass/Profesor/TemaDia/verTemaDiaAnt.php?id_curso=$id_curso&&resultado=5");
} else {
    header("location: /DayClass/Profesor/TemaDia/verTemaDiaAnt.php?id_curso=$id_curso&&resultado=6");
}

?>