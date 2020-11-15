<?php
include "../../../databaseConection.php";

$idFuncion = $_POST['id'];

$datosFuncion = $con->query("SELECT * FROM funcion WHERE id = '$idFuncion'")->fetch_assoc();

$funcion = array(
    'nombreFuncion'=> $datosFuncion['nombreFuncion'],
    'codigoFuncion'=> $datosFuncion['codigoFuncion'],
    'refImagen'=> $datosFuncion['refImagen'],
    'refPagina'=> $datosFuncion['refPagina']
);

$myJSON = json_encode($funcion);

echo $myJSON;

?>