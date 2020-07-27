<?php
//include "../databaseConection.php";

$con = new mysqli("localhost","root","","dayclass");

$nombre = $_POST["inputName"];
$apellido= $_POST["inputSurname"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$currentDateTime = date('Y-m-d H:i:s');
    
$con->query('INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`) VALUES ("'.$nombre.'","'.$apellido.'", "'.$dni.'","'.$currentDateTime.'","'.$legajo.'");');

echo "<script> window.location = 'config_alumno.php' </script>";
//https://bootstrapious.com/p/how-to-build-a-working-bootstrap-contact-form
	
?>