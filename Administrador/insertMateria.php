<?php
include "../databaseConection.php";

$materia = $_POST["inputNombreMateria"];
$nivel = $_POST["inputNivel"];
$fechaHora= date('Y-m-d H:i:s');

$consulta = $con->query("SELECT id FROM `materia` WHERE nombreMateria = '$materia'");

if(mysqli_num_rows($consulta) == 0){
    
    $con->query('INSERT INTO `materia`(`nombreMateria`,`fechaAltaMateria`,`nivelMateria`) VALUES ("'.$materia.'","'.$fechaHora.'", "'.$nivel.'");');
    
    header("Location:/DayClass/Administrador/administrar-materia.php?resultado=1");
    
}else{
    header("Location:/DayClass/Administrador/administrar-materia.php?resultado=2");
}

?>