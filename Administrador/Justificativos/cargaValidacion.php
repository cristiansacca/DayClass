<?php
include "../../databaseConection.php";

$id_justificativo = $_POST['id_justificativo'];
$comentario = $_POST['comentario'];
$validacion = $_POST['validacion'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');
$tipoJustificado = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();

$consulta1 = $con->query("SELECT * FROM justificativoasistenciadia WHERE justificativo_id = '$id_justificativo'");

if($validacion == 1) {
    $update = $con->query("UPDATE `justificativo` SET `aprobado`= 1,`fechaRevision`= '$currentDateTime',
    `comentarioJustificativo`= '$comentario' WHERE id = '$id_justificativo'");
}elseif($validacion == 0) {
    $update = $con->query("UPDATE `justificativo` SET `aprobado`= 0,`fechaRevision`= '$currentDateTime',
    `comentarioJustificativo`= '$comentario' WHERE id = '$id_justificativo'");
}

if($update){
    if($validacion == 1){
        while($justAsistDia = $consulta1->fetch_assoc()){
            $con->query("UPDATE asistenciadia SET tipoAsistencia_id = '".$tipoJustificado['id']."' WHERE id = '".$justAsistDia['id']."'");
        }
    }
    echo 1;
} else {
    echo 0;
}

?>