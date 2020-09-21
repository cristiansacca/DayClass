<?php
include "../../databaseConection.php";

$curso = $_POST['curso'];
$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'].' 23:59:59';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$tipoPresente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'PRESENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoAusente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoJustificado = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$cantidadPresentes = 0;
$cantidadAusentes = 0;
$cantidadJustificados = 0;

$cursos = $con->query("SELECT * FROM curso WHERE id = '$curso'")->fetch_assoc();
$nombreCurso = $cursos['nombreCurso'];

$consulta2 = $con->query("SELECT * FROM asistencia WHERE fechaHastaFichaAsis >= '$fechaDesde' AND curso_id = '".$cursos['id']."'");
while($fichaAsistencia = $consulta2->fetch_assoc()){
    $presentes = $con->query("SELECT * FROM asistenciadia WHERE fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'
    AND asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoPresente['id']."'");

    $cantidadPresentes = $cantidadPresentes + ($presentes->num_rows);

    $ausentes = $con->query("SELECT * FROM asistenciadia WHERE fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'
    AND asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoAusente['id']."'");

    $cantidadAusentes = $cantidadAusentes + ($ausentes->num_rows);

    $justificados = $con->query("SELECT * FROM asistenciadia WHERE fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'
    AND asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoJustificado['id']."'");

    $cantidadJustificados = $cantidadJustificados + ($justificados->num_rows);
}


setlocale(LC_ALL, 'Spanish');//Formato de fechas en español strftime("%A %d %B %Y %H:%M:%S", strtotime(fecha));
$fechaDesdeFormateada = strftime("%d/%m/%Y", strtotime($fechaDesde));
$fechaHastaFormateada = strftime("%d/%m/%Y", strtotime($fechaHasta));
$fechaFormateada = strftime("%d/%m/%Y - %H:%M", strtotime($currentDateTime));

$obj = array(
    'asistencias' => $cantidadPresentes,
    'inasistencias' => $cantidadAusentes,
    'justificados' => $cantidadJustificados,
    'periodo' => $fechaDesdeFormateada.' - '. $fechaHastaFormateada,
    'fechaHora' => $fechaFormateada,
    'nombreCurso' => $nombreCurso
);

$myJSON = json_encode($obj);

echo $myJSON;

?>