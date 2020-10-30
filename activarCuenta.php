<?php
include "databaseConection.php";

$mailCifrado = $_GET['mail'];
$passCifrada = $_GET['pass'];
$dni = $_GET['di'];

$usuario = $con->query("SELECT * FROM usuario WHERE dniUsuario = '$dni'")->fetch_assoc();

$id = $usuario["id"];
$mail = $usuario['emailUsuario'];

if(password_verify($mail, $mailCifrado)){
    //cuentaHabilitada
    $update = $con->query("UPDATE usuario SET cuentaHabilitada = 1 WHERE id= '$id'");
    if($update){
        header("Location: /DayClass/index.php?resultado=4");
    } else {
        header("Location: /DayClass/index.php?resultado=5");
    }
} else {
    header("Location: /DayClass/index.php?resultado=5");
}

?>