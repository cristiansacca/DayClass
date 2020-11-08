<?php
include "../../databaseConection.php";

$curso_id = $_POST["id_curso"];
$alumno_id = $_POST["id_alumno"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL, 'Spanish');
$currentDateTime = date('Y-m-d');

$tipoPresente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'PRESENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoAusente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoJustificado = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();

$fichaAsistencia = $con->query("SELECT id FROM asistencia WHERE curso_id = '$curso_id' AND alumno_id = '$alumno_id' AND 
fechaDesdeFichaAsis <= '$currentDateTime' AND fechaHastaFichaAsis >= '$currentDateTime'")->fetch_assoc();
$consulta1 = $con->query("SELECT * FROM asistenciadia WHERE asistencia_id = '".$fichaAsistencia['id']."' ORDER BY fechaHoraAsisDia DESC");
$asistencias = array();

while($resultado1 = $consulta1->fetch_assoc()) {
    switch ($resultado1['tipoAsistencia_id']) {
        case $tipoPresente['id']:
            $tipoAsistencia = $tipoPresente['nombreTipoAsistencia'];
            break;
        case $tipoAusente['id']:
            $tipoAsistencia = $tipoAusente['nombreTipoAsistencia'];
            break;
        case $tipoJustificado['id']:
            $tipoAsistencia = $tipoJustificado['nombreTipoAsistencia'];
            break;
        default:
            $tipoAsistencia = '¡Error!';
            break;
    }

    $asistencias[] = array(
        'fecha'=> strftime("%d de %B de %Y", strtotime($resultado1['fechaHoraAsisDia'])),
        'tipoAsistencia'=> $tipoAsistencia
    );
}

$myJSON = json_encode($asistencias);

echo $myJSON;

?>