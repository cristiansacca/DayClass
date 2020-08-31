<?php
include "../../databaseConection.php";

$id_materia = $_POST['id_materia'];
$consulta1 = $con->query("SELECT id, nombreCurso FROM curso WHERE materia_id = '$id_materia'");
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