<?php
include "../databaseConection.php";

$asunto = $_POST["inputAsunto"];
$mensaje= $_POST["textMensaje"];
$fechaHoraNotif = date('Y-m-d H:i:s');
/*
$consulta1 = $con->query('SELECT id FROM `curso` WHERE nombreCurso = ""');
$resultado1 = $consulta1->fetch_assoc();
$id_curso = $resultado1['id'];

$consulta1 = $con->query('SELECT id FROM `profesor` WHERE legajoProf = ');
$resultado1 = $consulta1->fetch_assoc();
$id_profesor = $resultado1['id'];
*/
    
$con->query('INSERT INTO `notificacionprofe`(`asunto`,`fechaHoraNotif`,`mensaje`) VALUES ("'.$asunto.'","'.$fechaHoraNotif.'", "'.$mensaje.'");');

echo "<script> window.location = 'pizarra.php' </script>";

	

	
?>
