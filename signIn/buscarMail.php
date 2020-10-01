<?php
include "../databaseConection.php";

$email = $_POST["eMail"];


//verificar que el mail no este registrado por ningun otro tipo de usuario 
$mailAlumno = $con->query("SELECT id FROM alumno WHERE emailAlum = '$email'");
$mailDocente = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
$mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");

$existe = false;

if (($mailAlumno->num_rows) == 0 && ($mailDocente->num_rows) == 0 && ($mailAdmin->num_rows) == 0) {
    $existe = false;
}

$myJSON = json_encode($existe);
    
echo $myJSON;  

?>
