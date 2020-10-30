<?php
include "../../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$id = $_GET['id'];
$currentDateTime = date('Y-m-d H:i:s');

$string = "UPDATE `usuario` SET `fechaBajaUsuario`= NULL WHERE `id`= '$id'";
//echo "$string";
	$consulta = $con->query($string);
//echo "$consulta";

if($consulta){
  header("Location:/DayClass/Administrador/ConfiguracionSistema/Usuario/configUsuario.php?resultado=7");
  
}else{
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Usuario/configUsuario.php?resultado=8");

}

?>