<?php
//Se inicia o restaura la sesión
session_start();

include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

date_default_timezone_set('America/Argentina/Buenos_Aires');

$asunto = $_POST["inputAsunto"];
$mensaje= $_POST["textMensaje"];
$fechaHoraNotif = date('Y-m-d H:i:s');
$id_curso = $_POST["id_curso"];
    
$insert = $con->query("INSERT INTO notificacionprofe (asunto, mensaje, fechaHoraNotif, profesor_id, curso_id)
 VALUES ('$asunto', '$mensaje', '$fechaHoraNotif', '".$_SESSION['profesor']['id']."', '$id_curso')");

if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
    header("location: /DayClass/Profesor/PizarraNovedades/pizarra.php?id_curso=$id_curso&&resultado=1");
} else {
    header("location: /DayClass/Profesor/PizarraNovedades/pizarra.php?id_curso=$id_curso&&resultado=0");
}
	
?>
