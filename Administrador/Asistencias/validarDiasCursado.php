<?php
include "../../databaseConection.php";

$fecha = $_POST['fecha'];
$id_curso = $_POST['id_curso'];

$diasCursado = $con->query("SELECT dayName 
FROM cursodia, curso, horariocurso 
WHERE curso.id = '$id_curso' AND horariocurso.curso_id = curso.id AND horariocurso.cursoDia_id = cursodia.id");
$resultado = 0;

while($dia = $diasCursado->fetch_assoc()) {
    if($dia['dayName'] == date('l', strtotime($fecha))){
        $resultado = 1;
    }
}

$array = array(
    'resultado'=> $resultado
);

$myJSON = json_encode($array);

echo $myJSON;

?>