<?php
include "../databaseConection.php";

$materia = $_POST["inputNombreMateria"];
$nivel = $_POST["inputNivel"];
$fechaHora= date('Y-m-d H:i:s');

    
$con->query('INSERT INTO `materia`(`nombreMateria`,`fechaAltaMateria`,`nivelMateria`) VALUES ("'.$materia.'","'.$fechaHora.'", "'.$nivel.'");');

header("Location:/DayClass/Administrador/administrar-materia.php");


	

	
?>