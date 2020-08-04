<?php
include "../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

date_default_timezone_set('UTC');

$asunto = $_POST["inputAsunto"];
$mensaje= $_POST["textMensaje"];
$fechaHoraNotif = date('Y-m-d H:i:s');
$id_curso = $_POST["id_curso"];
    
$insert = $con->query("INSERT INTO notificacionprofe (asunto, mensaje, fechaHoraNotif, profesor_id, curso_id)
 VALUES ('$asunto', '$mensaje', '$fechaHoraNotif', '".$_SESSION['profesor']['id']."', '$id_curso')");

if($insert){
    header("location: /DayClass/Profesor/pizarra.php?id_curso=$id_curso&&resultado=1");
} else {
    header("location: /DayClass/Profesor/pizarra.php?id_curso=$id_curso&&resultado=0");
}
	
?>
