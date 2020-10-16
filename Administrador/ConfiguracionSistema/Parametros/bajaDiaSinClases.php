<?php
include "../../../databaseConection.php";

$id = $_GET['id'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');


try {
    $update = $con->query("UPDATE diassinclases SET fechaBajaDiaSinClases = '$currentDateTime' WHERE id = '$id'");

    if($update){
        header("Location: /DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=6");
    } else{
        header("Location: /DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=7");
    }

} catch (Exception $e) {
    header("Location: /DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=7");
}

?>