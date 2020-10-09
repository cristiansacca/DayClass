<?php
include "../../../databaseConection.php";

$nombreMotivo = $_POST["nombreMotivo"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$conMotivo = $con->query("SELECT * FROM motivodiasinclases WHERE nombreMotivoDiaSinClases = '$nombreMotivo' AND fechaHastaMotivoDiaSinClases IS NULL");

if(($conMotivo->num_rows)==0){
    $insert = $con->query("INSERT INTO `motivodiasinclases`(`nombreMotivoDiaSinClases`, `fechaDesdeMotivoDiaSinClases`) VALUES ('$nombreMotivo','$currentDateTime')");

    if($insert){
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=17");
    } else {
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=18");
    }
} else {
    header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=19");
}

?>