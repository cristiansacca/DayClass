<?php
include "../../../databaseConection.php";

$id = $_POST['txtId'];
$fecha = $_POST['txtFecha'];
$comentario = $_POST['txtComentario'];
$idMotivo = $_POST['cboMotivo'];

try {
    $update = $con->query("UPDATE diassinclases SET fechaDiaSinClases = '$fecha', comentarioDiaSinClases = '$comentario', id_motivo = '$idMotivo' WHERE id = '$id'");

    if($update){
        header("Location: /DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=4");
    } else{
        header("Location: /DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=5");
    }

} catch (Exception $e) {
    header("Location: /DayClass/Administrador/ConfiguracionSistema/Parametros/feriadosDiaSinClase.php?resultado=5");
}

?>