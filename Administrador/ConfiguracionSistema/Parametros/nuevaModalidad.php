<?php
include "../../databaseConection.php";

$nombreModalidad = $_POST["nombreModalidad"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$conModalidad = $con->query("SELECT * FROM modalidad WHERE nombre = '$nombreModalidad' AND fechaBajaModalidad IS NULL");

if(($conModalidad->num_rows)==0){
    $insert = $con->query("INSERT INTO modalidad (nombre, fechaAltaModalidad) VALUES ('$nombreModalidad', '$currentDateTime')");

    if($insert){
        header("location: /DayClass/Administrador/Parametros/config_parametros.php?resultado=1");
    } else {
        header("location: /DayClass/Administrador/Parametros/config_parametros.php?resultado=2");
    }
} else {
    header("location: /DayClass/Administrador/Parametros/config_parametros.php?resultado=3");
}

?>