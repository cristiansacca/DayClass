<?php
include "../../databaseConection.php";
header("Content-type: image/jpeg");
$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;

//$consulta1 = $con->query("SELECT imagenJustificativo FROM `justificativo` WHERE id = '1'");
/*$resultado =  $consulta1->fetch_assoc();
$image = $resultado["imagenJustificativo"];

header('Content-Type: image/jpeg');
echo $image;*/



$result=$con->query("SELECT * FROM `justificativo` WHERE id=2");


$datos = mysql_fetch_array($result);

 
# Mostramos la imagen

echo $datos['imagenJustificativo'];
?>