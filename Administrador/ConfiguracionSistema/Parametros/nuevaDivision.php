<?php
include "../../../databaseConection.php";

$nombreDivision = $_POST["nombreDivision"];
$modalidad = $_POST["comboModalidad"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$conDivision = $con->query("SELECT * FROM division WHERE nombreDivision = '$nombreDivision' AND fechaBajaDivision IS NULL");

if(($conDivision->num_rows)==0){
    $insert = $con->query("INSERT INTO division (nombreDivision, fechaAltaDivision, modalidad_id) VALUES ('$nombreDivision', '$currentDateTime', '$modalidad')");

    if($insert){
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=4");
    } else {
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=5");
    }
} else {
    header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=6");
}

?>