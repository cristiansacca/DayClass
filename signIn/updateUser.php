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


//verificar que el mail no este registrado por ningun otro tipo de usuario 
$mailAlumno = $con->query("SELECT id FROM alumno WHERE emailAlum = '$email'");
$mailDocente = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
$mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");


if (($mailAlumno->num_rows) == 0 && ($mailDocente->num_rows) == 0 && ($mailAdmin->num_rows) == 0) {
//si el mail no esta asociado a ninguna otra cuenta, se procede a cifrar la contraseña y completar los datos del usuario   
    $pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);

    $rolMin = strtolower($rol);

if($rolMin == "alumno"){
    $insertAlumno = $con->query("UPDATE `alumno` SET `contraseniaAlum`= '$pass_cifrada',`emailAlum`= '$email',`fechaNacAlumno`='$fchNac',`permiso_id`= '1' WHERE legajoAlumno = '$legajo' AND dniAlum = '$dni'");
}else{
   $insertProfesor = $con->query( "UPDATE `profesor` SET `contraseniaProf`= '$pass_cifrada',`emailProf`= '$email',`fechaNacProf`='$fchNac',`permiso_id`= '2' WHERE legajoProf = '$legajo' AND dniProf = '$dni'");
}
 //exito en el registro, ya se puede iniciar sesion con los datos generados 
header("location: /DayClass/Index.php?resultado=1");
    
    
}else{
    //si el mail ya esta registrado por otro usuario vuelve al inicio del registro
   header("location: /DayClass/signIn/sign_in.php?resultado=4");
}






?>
