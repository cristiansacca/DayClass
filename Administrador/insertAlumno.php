<?php
//include "../databaseConection.php";

$con = new mysqli("localhost","root","","dayclass");

$nombre = $_POST["inputName"];
$apellido= $_POST["inputSurname"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$currentDateTime = date('Y-m-d H:i:s');

$consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "ALUMNO"');
$resultado1 = $consulta1->fetch_assoc();
$id_permiso = $resultado1['id'];

$resultado2 = $con->query('INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`, `permiso_id`) VALUES ("'.$nombre.'","'.$apellido.'", "'.$dni.'","'.$currentDateTime.'","'.$legajo.'",'.$id_permiso.');');

//echo "<script> window.location = 'config_alumno.php' </script>";

if($resultado2){
    //Enviía por GET resultado=true para que se muestre el mensaje de exito en la otra página
    header("Location:/DayClass/Administrador/config_alumno.php?resultado=true");
} else {
    header("Location:/DayClass/Administrador/config_alumno.php?resultado=false");
}

//https://bootstrapious.com/p/how-to-build-a-working-bootstrap-contact-form
	
?>