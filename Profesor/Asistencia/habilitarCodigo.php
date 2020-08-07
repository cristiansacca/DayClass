<?php
include "../../header.html";
include "../../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}
try {
    
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $codigoConEspacio = $_POST['codigoAsis'];
    $tiempo = $_POST['tiempo'];
    $id_curso = $_POST['id_curso'];
    $fechaActual = date('Y-m-d H:i:s');

    //Quita los espacios en blanco del código generado
    $codigo = preg_replace('[\s+]','', $codigoConEspacio);

    //Suma la duración del código a la fecha actual
    $time = new DateTime();
    $time->add(new DateInterval('PT' . $tiempo . 'M'));
    $stamp = $time->format('Y-m-d H:i:s');

    $insert = $con->query("INSERT INTO codigoasitencia (fechaHoraInicioCodigo, fechaHoraFinCodigo, numCodigo, curso_id)
    VALUES ('$fechaActual', '$stamp', '$codigo', '$id_curso')");

} catch(Exception $e) {

    echo $e->getMessage();

}


if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
    header("location: /DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso&&codigo=$codigoConEspacios");
} else {
    header("location: /DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso&&codigo=");
}

include "../../footer.html";
?>