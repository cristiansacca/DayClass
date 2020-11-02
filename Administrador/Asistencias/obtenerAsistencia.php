<?php 
include "../../databaseConection.php";

$id_curso = $_POST['id_curso'];
$fecha = $_POST['fecha'];
$fecha1 = $fecha.' 00:00:00';
$fecha2 = $fecha.' 23:59:59';

$consultaAsistencias = $con->query("SELECT alumno.apellidoAlum, alumno.nombreAlum, alumno.legajoAlumno, asistenciadia.tipoAsistencia_id, tipoasistencia.nombreTipoAsistencia AS estado 
FROM `asistenciadia`, `alumno`, `asistencia`, `tipoasistencia` 
WHERE asistencia.curso_id = '$id_curso' 
    AND asistencia.alumno_id = alumno.id 
    AND asistenciadia.fechaHoraAsisDia >= '$fecha1' 
    AND asistenciadia.fechaHoraAsisDia <= '$fecha2' 
    AND asistenciadia.asistencia_id = asistencia.id
    AND asistenciadia.tipoAsistencia_id = tipoasistencia.id
    ORDER BY alumno.apellidoAlum ASC");

$asistencias = array();
while($resultado1 = $consultaAsistencias->fetch_assoc()) {
    $asistencias[] = array(
        'legajo'=> $resultado1['legajoAlumno'],
        'apellido'=> $resultado1['apellidoAlum'],
        'nombre' => $resultado1['nombreAlum'],
        'tipoAsistencia' => $resultado1['tipoAsistencia_id'],
        'estado' => $resultado1['estado']
    );
}

$myJSON = json_encode($asistencias);

echo $myJSON;

?>