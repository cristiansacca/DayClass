<?php
include "../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate= date('Y-m-d');

$dni = $_POST["dni"];


//verificar que el usuario ingresado sea alumno 
$selectUsuario = $con->query("SELECT id_permiso FROM usuario WHERE dniUsuario = '$dni'");

$existe = false;
$usuario = $selectUsuario->fetch_assoc();
$id_permiso = $usuario["id_permiso"];

if ($id_permiso != "" || $id_permiso != NULL) {
    $existe = "true";
}

$myJSON = json_encode($existe);
    
echo $myJSON;  

?>