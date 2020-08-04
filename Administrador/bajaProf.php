<?php
include "../databaseConection.php";

date_default_timezone_set('America/Argentina/Mendoza');
	$id = $_GET['id'];
    $currentDateTime = date('Y-m-d H:i:s');

$string = "UPDATE `profesor` SET `fechaBajaProf`=' $currentDateTime' WHERE `id`= ".$id;
//echo "$string";
	$consulta = $con->query($string);
//echo "$consulta";

if($consulta){
  header("Location:/DayClass/Administrador/config_profesores.php?resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/config_profesores.php?resultado=4");

}

?>