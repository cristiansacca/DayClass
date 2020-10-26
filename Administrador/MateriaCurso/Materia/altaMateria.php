<?php
include "../../../databaseConection.php";

$materia = $_POST["inputNombreMateria"];
$nivel = $_POST["inputNivel"];
$cargaHoraria = $_POST["inputCargaHoraria"];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaHora= date('Y-m-d H:i:s');

$consulta = $con->query("SELECT id FROM `materia` WHERE nombreMateria = '$materia' AND nivelMateria = '$nivel' AND materia.fechaBajaMateria IS NULL");

if(($consulta->num_rows) == 0){
    
    $con->query("INSERT INTO `materia`(`nombreMateria`,`fechaAltaMateria`,`nivelMateria`,`cargaHorariaMateria` ) VALUES ('$materia','$fechaHora','$nivel','$cargaHoraria');");
    
    header("Location:/DayClass/Administrador/MateriaCurso/Materia/admMateria.php?resultado=1");
    
}else{
    header("Location:/DayClass/Administrador/MateriaCurso/Materia/admMateria.php?resultado=2");
}

?>