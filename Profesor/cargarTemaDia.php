<?php
include "../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');

$id_tema = $_POST["nombreTema"];
$comentario = $_POST["comentario"];
$id_curso = $_POST["id_curso"];
$id_prof = $_POST["idProfesor"];
$fechaHoy = date('Y-m-d');

if(isset($comentario)){
    $insert = $con->query("INSERT INTO temadia (comentarioTema, fechaTemaDia, curso_id, temasMateria_id, profesor_id) VALUES ('$comentario', '$fechaHoy', '$id_curso', '$id_tema','$id_prof')");
} else {
    $insert = $con->query("INSERT INTO temadia (fechaTemaDia, curso_id, temasMateria_id, profesor_id) VALUES ('$fechaHoy', '$id_curso', '$id_tema','$id_prof')");
}

if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
    header("location: /DayClass/Profesor/tema-del-dia.php?id_curso=$id_curso&&resultado=1");
} else {
    header("location: /DayClass/Profesor/tema-del-dia.php?id_curso=$id_curso&&resultado=0");
}

?>