<?php 
include "../../databaseConection.php";
$fecha = $_GET['fecha'];
$fecha1 = $fecha." 00:00:00";
$fecha2 = $fecha." 23:59:59";
$id_curso = $_GET['curso'];
$datos = $_POST['json_string'];
$array = json_decode($datos, true);

$presente = $con->query("SELECT id FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'PRESENTE'")->fetch_assoc();
$ausente = $con->query("SELECT id FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE'")->fetch_assoc();
$justificado = $con->query("SELECT id FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO'")->fetch_assoc();

$contador = 0;
for ($i=0; $i < count($array); $i++) { 
    if($array[$i]['asistencia']=="PRESENTE"){
        $id_tipo = $presente['id'];
    } else {
        if($array[$i]['asistencia']=="AUSENTE"){
            $id_tipo = $ausente['id'];
        } else {
            $id_tipo = $justificado['id'];
        }
    }
    $fichaAsistencia = $con->query("SELECT id FROM asistencia WHERE curso_id = '$id_curso' AND alumno_id = '".$array[$i]['id']."'")->fetch_assoc();
    $asistenciaDia = $con->query("SELECT * FROM asistenciadia WHERE asistencia_id = '".$fichaAsistencia['id']."' AND fechaHoraAsisDia >= '$fecha1' AND fechaHoraAsisDia <= '$fecha2'")->fetch_assoc();

    if($id_tipo != $asistenciaDia['tipoAsistencia_id']){
        $update = $con->query("UPDATE asistenciadia SET tipoAsistencia_id = '$id_tipo' WHERE id = '".$asistenciaDia['id']."'");
        $contador = $update ? $contador+1 : $contador;
    }
    
}

$respuesta = array(
    'actualizados'=> $contador,
    'total'=> count($array)
);

$myJSON = json_encode($respuesta);

echo $myJSON;

?>