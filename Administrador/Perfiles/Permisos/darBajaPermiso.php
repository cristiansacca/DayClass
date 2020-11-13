<?php
include "../../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');
$idFuncion = $_POST['idFuncion'];

$baja = $con->query("UPDATE funcion SET fechaHastaFuncion = '$currentDateTime' WHERE id = '$idFuncion'");

if($baja){
    echo 'true';
} else {
    echo 'false';
}

?>
