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

$curso = $con->query("SELECT * FROM curso WHERE id = '$id_curso'")->fetch_assoc();
    
$insert = $con->query("INSERT INTO notificacionprofe (asunto, mensaje, fechaHoraNotif, profesor_id, curso_id, fechaDesdeNotificacionProfe, fechaHastaNotificacionProfe)
 VALUES ('$asunto', '$mensaje', '$fechaHoraNotif', '".$_SESSION['usuario']['id']."', '$id_curso', '".$curso['fechaDesdeCursado']."', '".$curso['fechaHastaCursado']."')");

if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
    header("location: /DayClass/Profesor/PizarraNovedades/pizarra.php?id_curso=$id_curso&&resultado=1");
} else {
    header("location: /DayClass/Profesor/PizarraNovedades/pizarra.php?id_curso=$id_curso&&resultado=0");
}
	
?>
