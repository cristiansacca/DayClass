<?php
include "../../databaseConection.php";

$id_tema = $_POST['id'];

$selectTemaAnt = $con->query("SELECT temasmateria.nombreTema, temasmateria.unidadTema, temadia.comentarioTema FROM `temadia`, temasmateria WHERE temadia.id = '$id_tema' AND temasmateria.id = temadia.temasMateria_id")->fetch_assoc();


$obj = array(
    'unidad' => $selectTemaAnt['unidadTema'],
    'tema' => $selectTemaAnt['nombreTema'],
    'comentario' => $selectTemaAnt['comentarioTema']
);

$myJSON = json_encode($obj);

echo $myJSON;

?>