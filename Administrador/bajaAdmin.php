<?php
include "../databaseConection.php";


	$id = $_GET['id'];
    $currentDateTime = date('Y-m-d H:i:s');

$string = "UPDATE `administrativo` SET `fechaBajaAdm`=' $currentDateTime' WHERE `id`= ".$id;
echo "$string";
	$consulta = $con->query($string);
echo "$consulta";

if($consulta){
  header("Location:/DayClass/Administrador/config_admin.php?resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/config_admin.php?resultado=4");

}

?>