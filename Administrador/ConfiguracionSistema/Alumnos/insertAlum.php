<?php
include "../../../databaseConection.php";

$nombre = $_POST["inputName"];
$apellido= $_POST["inputSurname"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$currentDateTime = date('Y-m-d H:i:s');

$consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "ALUMNO"');
$resultado1 = $consulta1->fetch_assoc();
$id_permiso = $resultado1['id'];

$consultaAlumL = $con->query("SELECT id FROM `alumno` WHERE legajoAlum = '$legajo'");
$consultaAlumD = $con->query("SELECT id FROM `alumno` WHERE dniAlum = '$dni'");

$consultaProfL = $con->query("SELECT id FROM `profesor` WHERE legajoProf = '$legajo'");
$consultaProfD = $con->query("SELECT id FROM `profesor` WHERE dniProf = '$dni'");

$consultaAdminL = $con->query("SELECT id FROM `administrativo` WHERE legajoAdm = '$legajo'");
$consultaAdminD = $con->query("SELECT id FROM `administrativo` WHERE dniAdm = '$dni'");

if((($consultaAlumL->num_rows) == 0) && (($consultaAlumD->num_rows) == 0) && (($consultaProfL->num_rows) == 0) && (($consultaProfD->num_rows) == 0) && (($consultaAdminL->num_rows) == 0) && (($consultaAdminD->num_rows) == 0)){
    $resultado2 = $con->query('INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`, `permiso_id`) VALUES ("'.$nombre.'","'.$apellido.'", "'.$dni.'","'.$currentDateTime.'","'.$legajo.'",'.$id_permiso.');');
    
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=1");
    
}else{
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=2");
}

?>