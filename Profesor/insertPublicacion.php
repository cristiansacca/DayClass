<?php
include "../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

$asunto = $_POST["inputAsunto"];
$mensaje= $_POST["textMensaje"];
$fechaHoraNotif = date('Y-m-d H:i:s');
$id_curso = $_POST["id_curso"];
    
$con->query("INSERT INTO notificacionprofe (asunto, fechaHoraNotif, mensaje, curso_id, profesor_id)
VALUES ('$asunto', '$mensaje', '$fechaHoraNotif', '$id_curso', '".$_SESSION['profesor']['id']."')");

header("location: /DayClass/Profesor/pizarra.php?id_curso=$id_curso&&resultado=1");

	

	
?>
