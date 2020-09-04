<?php
include "../../../databaseConection.php";

$minutosCodigo = $_POST["minutosCodigo"];

$conTiempoAnt = $con->query("SELECT * FROM `tiempolimitecodigo`");

if(($conTiempoAnt ->num_rows)==0){
    $insert = $con->query("INSERT INTO `tiempolimitecodigo`(`minutosLimite`) VALUES ('$minutosCodigo')");

    if($insert){
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=8");
    } else {
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=5");
    }
} else {
    $limiteAnt = $conTiempoAnt->fetch_assoc();
    $idAnt = $limiteAnt["id"];
    $update = $con->query("UPDATE `tiempolimitecodigo` SET `minutosLimite`= '$minutosCodigo'  WHERE id = '$idAnt'");
    
    if($update){
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=8");
    } else {
        header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=5");
    }
    
}

?>