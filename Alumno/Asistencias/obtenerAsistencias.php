<?php
include "../../databaseConection.php";

$curso_id = $_POST["id_curso"];
$alumno_id = $_POST["id_alumno"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$tipoPresente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'PRESENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoAusente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoJustificado = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();

$fichaAsistencia = $con->query("SELECT * FROM asistencia WHERE curso_id = '$curso_id' AND alumno_id = '$alumno_id' AND 
fechaDesdeFichaAsis <= '$currentDateTime' AND fechaHastaFichaAsis >= '$currentDateTime'")->fetch_assoc();


$presentes = $con->query("SELECT * FROM asistenciadia WHERE asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoPresente['id']."'");

$cantidadPresentes = ($presentes->num_rows) !== 0 ? ($presentes->num_rows) : 0;

$ausentes = $con->query("SELECT * FROM asistenciadia WHERE asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoAusente['id']."'");

$cantidadAusentes = ($ausentes->num_rows) !== 0 ? ($ausentes->num_rows) : 0;

$justificados = $con->query("SELECT * FROM asistenciadia WHERE asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoJustificado['id']."'");

$cantidadJustificados = ($justificados->num_rows) !== 0 ? ($justificados->num_rows) : 0;

$obj = array(
    'asistencias' => $cantidadPresentes,
    'inasistencias' => $cantidadAusentes,
    'justificados' => $cantidadJustificados
);

$myJSON = json_encode($obj);

echo $myJSON;

?>