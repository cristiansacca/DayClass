<?php
include "../../databaseConection.php";

$curso = $_POST['curso'];
$materia = $_POST['materia'];
$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$tipoPresente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'PRESENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoAusente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$cantidadPresentes = 0;
$cantidadAusentes = 0;
$consultaNombreMateria = $con->query("SELECT nombreMateria, nivelMateria FROM materia WHERE id = '$materia'")->fetch_assoc();

if($curso == 0){
    $nombreCurso = "Todos";
    $consulta1 = $con->query("SELECT * FROM curso WHERE materia_id = '$materia' AND fechaHastaCurActul IS NULL");
} else {
    $consultaNombreCurso = $con->query("SELECT nombreCurso FROM curso WHERE id = '$curso'")->fetch_assoc();
    $nombreCurso = $consultaNombreCurso['nombreCurso'];
    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$curso' AND materia_id = '$materia' AND fechaHastaCurActul IS NULL");
}

while($cursos = $consulta1->fetch_assoc()){
    $consulta2 = $con->query("SELECT * FROM asistencia WHERE fechaHastaFichaAsis >= '$fechaDesde' AND curso_id = '".$cursos['id']."'");
    while($fichaAsistencia = $consulta2->fetch_assoc()){
        $presentes = $con->query("SELECT * FROM asistenciadia WHERE fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'
        AND asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoPresente['id']."'");

        $cantidadPresentes = $cantidadPresentes + ($presentes->num_rows);

        $ausentes = $con->query("SELECT * FROM asistenciadia WHERE fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'
        AND asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoAusente['id']."'");

        $cantidadAusentes = $cantidadAusentes + ($ausentes->num_rows);
    }
}

setlocale(LC_ALL, 'Spanish');//Formato de fechas en español strftime("%A %d %B %Y %H:%M:%S", strtotime(fecha));
$fechaDesdeFormateada = strftime("%d/%m/%Y", strtotime($fechaDesde));
$fechaHastaFormateada = strftime("%d/%m/%Y", strtotime($fechaHasta));
$fechaFormateada = strftime("%d/%m/%Y - %H:%M", strtotime($currentDateTime));

$obj = array(
    'asistencias' => $cantidadPresentes,
    'inasistencias' => $cantidadAusentes,
    'periodo' => $fechaDesdeFormateada.' - '. $fechaHastaFormateada,
    'fechaHora' => $fechaFormateada,
    'nombreCurso' => $nombreCurso,
    'nombreMateria' => $consultaNombreMateria['nombreMateria'],
    'nivelMateria' => $consultaNombreMateria['nivelMateria']
);

$myJSON = json_encode($obj);

echo $myJSON;

?>