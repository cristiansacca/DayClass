<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

include "../../../databaseConection.php";

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$institucion = $con->query("SELECT * FROM institucion");

if(($institucion->num_rows) == 0){
    $update = $con->query("INSERT INTO `institucion` (`fechaAltaInstitucion`, `nombreInstitucion`, `telefonoInstitucion`,
     `correoInstitucion`, `direccionInstitucion`) VALUES ('$currentDateTime','$nombre', '$telefono', '$email', '$direccion')");
} else {
    $id = ($institucion->fetch_assoc())['id'];
    $update = $con->query("UPDATE institucion SET nombreInstitucion = '$nombre', telefonoInstitucion = '$telefono',
     correoInstitucion = '$email', direccionInstitucion = '$direccion' WHERE id = '$id'");
}

if($update){
    header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/institucion.php?resultado=1");
} else {
    header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/institucion.php?resultado=0");
}

include "../../../footer.html";
?>