<?php
include "../../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$id = $_GET['id'];
$currentDateTime = date('Y-m-d H:i:s');

$string = "UPDATE `usuario` SET `fechaBajaUsuario`= '$currentDateTime' WHERE `id`= '$id'";
$consulta = $con->query($string);


if($consulta){
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Usuario/configUsuario.php?resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Usuario/configUsuario.php?resultado=4");

}

?>