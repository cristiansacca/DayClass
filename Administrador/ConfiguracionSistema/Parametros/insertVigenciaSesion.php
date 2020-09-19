<?php
include "../../../databaseConection.php";

$minutosCodigo = $_POST["minutosVigencia"];

$conTiempoAnt = $con->query("SELECT * FROM `vigenciasesion`");

if(($conTiempoAnt ->num_rows)==0){
    $insert = $con->query("INSERT INTO `vigenciasesion`(`duracionSesion`) VALUES ('$minutosCodigo')");

    if($insert){
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=15");
    } else {
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=16");
    }
} else {
    $limiteAnt = $conTiempoAnt->fetch_assoc();
    $idAnt = $limiteAnt["id"];
    $update = $con->query("UPDATE `vigenciasesion` SET `duracionSesion`= '$minutosCodigo'  WHERE id = '$idAnt'");
    
    if($update){
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=15");
    } else {
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=16");
    }
    
}

?>