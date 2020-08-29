<?php
include "../../databaseConection.php";

$modalidad = $_POST['modalidad'];
$materia = $_POST['materia'];
$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'];

$obj->asistencias = 126;
$obj->inasistencias = 15;

$myJSON = json_encode($obj);

echo $myJSON;

?>