<?php
include "../databaseConection.php";

$email = $_POST["eMail"];


//verificar que el mail no este registrado por ningun otro tipo de usuario 
$mailUsuario = $con->query("SELECT id FROM usuario WHERE emailUsuario = '$email' cuentaHabilitada = 1");


$existe = false;

if (($mailUsuario->num_rows)==0) {
    $existe = true;
}

$myJSON = json_encode($existe);
    
echo $myJSON;  

?>
