<?php
include "../../databaseConection.php";

$id_tema = $_POST['id'];

$selectTemaAnt = $con->query("SELECT temasmateria.nombreTema, temasmateria.unidadTema, temadia.comentarioTema, temadia.fechaTemaDia FROM `temadia`, temasmateria WHERE temadia.id = '$id_tema' AND temasmateria.id = temadia.temasMateria_id")->fetch_assoc();

$currentDate = date($selectTemaAnt["fechaTemaDia"]);
$fechaAlumnoLibre = date_create($currentDate);
$fechaAlumnoLibre =  date_format($fechaAlumnoLibre, "d/m/Y");

$obj = array(
    'unidad' => $selectTemaAnt['unidadTema'],
    'tema' => $selectTemaAnt['nombreTema'],
    'comentario' => $selectTemaAnt['comentarioTema'],
    'fecha' => $fechaAlumnoLibre
);

$myJSON = json_encode($obj);

echo $myJSON;

?>