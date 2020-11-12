<?php 
include "../../databaseConection.php";

$id_curso = $_POST['id_curso'];
$fecha = $_POST['fecha'];
$fecha1 = $fecha.' 00:00:00';
$fecha2 = $fecha.' 23:59:59';

$consultaAsistencias = $con->query("SELECT usuario.apellidoUsuario, usuario.nombreUsuario, usuario.legajoUsuario, asistenciadia.tipoAsistencia_id, tipoasistencia.nombreTipoAsistencia AS estado 
FROM `asistenciadia`, `usuario`, `asistencia`, `tipoasistencia` 
WHERE asistencia.curso_id = '$id_curso' 
    AND asistencia.alumno_id = usuario.id 
    AND asistenciadia.fechaHoraAsisDia >= '$fecha1' 
    AND asistenciadia.fechaHoraAsisDia <= '$fecha2' 
    AND asistenciadia.asistencia_id = asistencia.id
    AND asistenciadia.tipoAsistencia_id = tipoasistencia.id
    AND usuario.fechaBajaUsuario IS NULL
    ORDER BY usuario.apellidoUsuario ASC");

$asistencias = array();
while($resultado1 = $consultaAsistencias->fetch_assoc()) {
    $asistencias[] = array(
        'legajo'=> $resultado1['legajoUsuario'],
        'apellido'=> $resultado1['apellidoUsuario'],
        'nombre' => $resultado1['nombreUsuario'],
        'tipoAsistencia' => $resultado1['tipoAsistencia_id'],
        'estado' => $resultado1['estado']
    );
}

$myJSON = json_encode($asistencias);

echo $myJSON;

?>