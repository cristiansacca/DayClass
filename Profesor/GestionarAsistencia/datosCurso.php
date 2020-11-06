<?php 
include "../../databaseConection.php";

$id_curso = $_POST['id_curso'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$curso = $con->query("SELECT * FROM curso WHERE id = '$id_curso'")->fetch_assoc();

$datos = array(
    'id'=> $curso['id'],
    'nombreCurso'=> $curso['nombreCurso'],
    'fechaDesdeCursado' => $curso['fechaDesdeCursado'],
    'fechaHastaCursado' => $curso['fechaHastaCursado'],
    'fechaActual' => $currentDate
);

$myJSON = json_encode($datos);

echo $myJSON;

?>