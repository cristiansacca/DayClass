<?php
include "../databaseConection.php";

$nombre = $_POST["inputName"];
$apellido= $_POST["inputSurname"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$pass = $_POST["inputPassword4"];
$fchNac = $_POST["inputDate"];
$email = $_POST["inputEmail"];
$currentDateTime = date('Y-m-d H:i:s');
$Pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);

$consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "ADMINISTRADOR"');
$resultado1 = $consulta1->fetch_assoc();
$id_permiso = $resultado1['id'];


$consultaAlumL = $con->query('SELECT id FROM `alumno` WHERE legajoAlum =  "'.$legajo.'"');
$consultaAlumD = $con->query('SELECT id FROM `alumno` WHERE dniAlum = "'.$dni.'"');

$consultaProfL = $con->query('SELECT id FROM `profesor` WHERE legajoProf =  "'.$legajo.'"');
$consultaProfD = $con->query('SELECT id FROM `profesor` WHERE dniProf = "'.$dni.'"');


$consultaAdminL = $con->query('SELECT id FROM `administrativo` WHERE legajoAdm =  "'.$legajo.'"');
$consultaAdminD = $con->query('SELECT id FROM `administrativo` WHERE dniAdm = "'.$dni.'"');


if(mysqli_num_rows($consultaAlumL) == 0 && mysqli_num_rows($consultaAlumD) == 0 && mysqli_num_rows($consultaProfL) == 0 && mysqli_num_rows($consultaProfD) == 0 && mysqli_num_rows($consultaAdminL) == 0 && mysqli_num_rows($consultaAdminD) == 0){
    $resultado2 = $con->query('INSERT INTO `administrativo`(`nombreAdm`,`apellidoAdm`, `dniAdm`, `fechaAltaAdm`, `legajoAdm`, `permiso_id`,`fechaNacAdm`,`emailAdm`,`contraseniaAdm`) VALUES ("'.$nombre.'","'.$apellido.'","'.$dni.'","'.$currentDateTime.'","'.$legajo.'","'.$id_permiso.'","'.$fchNac.'","'.$email.'","'.$Pass_cifrada.'");');
    
    header("Location:/DayClass/Administrador/config_admin.php?resultado=1");
    
}else{
     header("Location:/DayClass/Administrador/config_admin.php?resultado=2");
}
	
?>