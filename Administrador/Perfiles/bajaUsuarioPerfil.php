<?php
include "../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$id = $_GET['id'];
$permiso = $_GET['permiso'];
$currentDateTime = date('Y-m-d H:i:s');

$string = "UPDATE `usuario` SET `id_permiso`= NULL WHERE `id`= '$id'";
//echo "$string";
	$consulta = $con->query($string);
//echo "$consulta";

if($consulta){
  header("Location:/DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$permiso&&resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$permiso&&resultado=4");

}

?>