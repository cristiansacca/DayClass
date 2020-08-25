<?php
include "../databaseConection.php";

$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$nombre = $_POST["inputName"];
$apellido = $_POST["inputSurname"];

$pass = $_POST["inputPassword"];
$email = $_POST["inputEmail"];
$fchNac = $_POST["inputFechaNac"];
$rol = $_POST["inputRol"];


$pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);

$rolMin = strtolower($rol);


if($rolMin == "alumno"){
    $insertAlumno = $con->query("UPDATE `alumno` SET `contraseniaAlum`= '$pass_cifrada',`emailAlum`= '$email',`fechaNacAlumno`='$fchNac',`permiso_id`= '1' WHERE legajoAlumno = '$legajo' AND dniAlum = '$dni'");
}else{
   $insertProfesor = $con->query( "UPDATE `profesor` SET `contraseniaProf`= '$pass_cifrada',`emailProf`= '$email',`fechaNacProf`='$fchNac',`permiso_id`= '2' WHERE legajoProf = '$legajo' AND dniProf = '$dni'");
}

header("location: /DayClass/Index.php?resultado=1");

?>
