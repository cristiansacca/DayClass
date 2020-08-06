<?php
include "../../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

date_default_timezone_set('America/Argentina/Buenos_Aires');

$codigo = $_POST['codigoAsis'];
$tiempo = $_POST['tiempo'];
$id_curso = $_POST['id_curso'];
$fechaActual = date('Y-m-d H:i:s');

$fechaAuxiliar  = strtotime ( "".$tiempo." minutes" , strtotime ( $fechaActual ) ) ;  
$duracion   = date ( 'Y-m-d H:i:s' , $fechaAuxiliar );

$insert = $con->query("INSERT INTO codigoasistencia (fechaHoraInicioCodigo, fechaHoraFinCodigo, numCodigo, curso_id)
VALUES ('$fechaActual', '$duracion', '$codigo', '$id_curso')");

if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
    header("location: /DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso&&codigo=$codigo");
} else {
    header("location: /DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso&&codigo=");
}

?>