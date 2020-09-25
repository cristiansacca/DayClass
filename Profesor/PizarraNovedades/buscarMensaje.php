<?php
include "../../databaseConection.php";

$id = $_POST['idPublicacion'];
$publicacion = $con->query("SELECT * FROM notificacionProfe WHERE id = '$id'")->fetch_assoc();

$obj = array(
    'asunto' => $publicacion['asunto'],
    'mensaje' => $publicacion['mensaje']
);

$myJSON = json_encode($obj);

echo $myJSON;

?>