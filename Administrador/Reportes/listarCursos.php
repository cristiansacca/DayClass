<?php
include "../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$id_materia = $_POST['id_materia'];
$consulta1 = $con->query("SELECT id, nombreCurso FROM curso WHERE materia_id = '$id_materia' AND fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado > '$currentDate'");
$cursos = array();

while($resultado1 = $consulta1->fetch_assoc()) {
    $cursos[] = array(
        'id'=> $resultado1['id'],
        'nombreCurso'=> $resultado1['nombreCurso']
    );
}

$myJSON = json_encode($cursos);

echo $myJSON;

?>