<?php
include "../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$id_tema = $_GET['id_tema'];
$id_curso = $_GET['id_curso'];

$currentDateTime = date('Y-m-d H:i:s');

$string = "DELETE FROM `temadia` WHERE `id`= '$id_tema'";
//echo "$string";
	$consulta = $con->query($string);
//echo "$consulta";

if($consulta){
  header("Location:/DayClass/Profesor/TemaDia/verTemaDiaAnt.php?id_curso=$id_curso&&resultado=3");
  
}else{
    header("Location:/DayClass/Profesor/TemaDia/verTemaDiaAnt.php?id_curso=$id_curso&&resultado=4");

}

?>