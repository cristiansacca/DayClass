<?php
include "../../../databaseConection.php";

$fechaFeriadoDiaSinClases = $_POST["inputFechaSinClases"];
$motivoFeriadoDiaSinClases = $_POST["comboMotivo"];
$comentarioFeriadoDiaSinClases = $_POST["inputComentarioFDiaSinClases"];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$conFeriadoDiaSinClases = $con->query("SELECT * FROM `diassinclases` WHERE `comentarioDiaSinClases` = '$comentarioFeriadoDiaSinClases' AND `id_motivo` = '$motivoFeriadoDiaSinClases' AND `fechaBajaDiaSinClases` IS NULL ");

if(($conFeriadoDiaSinClases->num_rows)==0){
    $insert = $con->query("INSERT INTO `diassinclases`(`fechaDiaSinClases`, `id_motivo`, `comentarioDiaSinClases`, `fechaAltaDiaSinClases`) VALUES ('$fechaFeriadoDiaSinClases','$motivoFeriadoDiaSinClases','$comentarioFeriadoDiaSinClases','$currentDateTime')");

    if($insert){
        header("location:/DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=1");
    } else {
        header("location:/DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=2");
    }
} else {
    header("location:/DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=3");
}

?>