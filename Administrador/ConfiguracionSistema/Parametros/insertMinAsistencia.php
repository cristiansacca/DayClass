<?php
include "../../../databaseConection.php";

$minAsistencia = $_POST["minAsistencia"];

$minAsistencia = $minAsistencia/100;

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$consultaPorcentajeVigente = $con->query("SELECT * FROM `paramminimoasistencia` WHERE `fechaAltaMinimoAsistencia` <= '$currentDate' AND `fechaBajaMinimoAsistencia` IS NULL");

if(mysqli_num_rows($consultaPorcentajeVigente) != 0){
    $porcentajeVigente = $consultaPorcentajeVigente->fetch_assoc();
    $id_porcentajeVigente = ($porcentajeVigente["id"]);
    $updatePorcentajeActual = $con->query("UPDATE `paramminimoasistencia` SET `fechaBajaMinimoAsistencia`='$currentDate' WHERE id = '$id_porcentajeVigente'");
}

$insertNuevoMinimo = $con->query("INSERT INTO `paramminimoasistencia`(`fechaAltaMinimoAsistencia`, `porcentajeAsistencia`) VALUES ('$currentDate','$minAsistencia')");

if($insertNuevoMinimo){
    header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=13");
} else {
    header("location: /DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php?resultado=14");
}
    


?>