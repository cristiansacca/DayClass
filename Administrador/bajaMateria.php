<?php
include "../databaseConection.php";

date_default_timezone_set('America/Argentina/Mendoza');
	$id = $_GET['id'];
    $currentDateTime = date('Y-m-d H:i:s');

$string = "UPDATE `materia` SET `fechaBajaMateria`=' $currentDateTime' WHERE `id`= ".$id;

	$consulta = $con->query($string);


if($consulta){
  header("Location:/DayClass/Administrador/administrar-materia.php?resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/administrar-materia.php?resultado=4");

}

?>