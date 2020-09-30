<?php
include "../../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');
$id = $_GET['id'];

$string = "UPDATE `profesor` SET `fechaBajaProf`= '$currentDateTime' WHERE `id`= $id";
//echo "$string";
	$consulta = $con->query($string);
//echo "$consulta";

if($consulta){
  header("Location:/DayClass/Administrador/ConfiguracionSistema/Profesores/configProf.php?resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Profesores/configProf.php?resultado=4");

}

?>