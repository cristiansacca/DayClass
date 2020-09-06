<?php
include "../../../databaseConection.php";


date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');


$nombreCargo = $_POST["inputNombreCargo"];

$conCargo = $con->query("SELECT * FROM cargo WHERE nombreCargo = '$nombreCargo' AND fechaFinCargo IS NULL");

if(($conCargo->num_rows)==0){
    $insert = $con->query("INSERT INTO cargo (nombreCargo, fechaAltaCargo) VALUES ('$nombreCargo', '$currentDate')");

    if($insert){
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=10");
    } else {
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=11");
    }
} else {
    header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=12");
}

?>