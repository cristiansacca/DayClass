<?php
include "../../../databaseConection.php";

$nombre = $_POST["inputName"];
$apellido= $_POST["inputSurname"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$currentDateTime = date('Y-m-d H:i:s');

$consultaAlumL = $con->query("SELECT id FROM `usuario` WHERE legajoUsuario = '$legajo'");
$consultaAlumD = $con->query("SELECT id FROM `usuario` WHERE dniUsuario = '$dni'");


if(($consultaAlumL->num_rows) == 0 && ($consultaAlumD->num_rows) == 0){
    $resultado2 = $con->query('INSERT INTO `usuario`(`nombreUsuario`,`apellidoUsuario`, `dniUsuario`, `fechaAltaUsuario`, `legajoUsuario`) VALUES ("'.$nombre.'","'.$apellido.'", "'.$dni.'","'.$currentDateTime.'","'.$legajo.'")');
    
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Usuario/configUsuario.php?resultado=1");
    
}else{
   header("Location:/DayClass/Administrador/ConfiguracionSistema/Usuario/configUsuario.php?resultado=2");
}

?>