<?php
include "../../../databaseConection.php";

$idDiaSinClase = $_POST['id'];

$dsClases = $con->query("SELECT * FROM diassinclases WHERE id = '$idDiaSinClase'")->fetch_assoc();
$motivo = $con->query("SELECT * FROM motivodiasinclases WHERE id = '".$dsClases['id_motivo']."'")->fetch_assoc();

$obj = array(
    'fecha' => $dsClases['fechaDiaSinClases'],
    'comentario' => $dsClases['comentarioDiaSinClases'],
    'motivo' => $motivo['id']
);

$myJSON = json_encode($obj);

echo $myJSON;

?>