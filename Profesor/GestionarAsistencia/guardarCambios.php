<?php 
include "../../databaseConection.php";
$fecha = $_GET['fecha']." 00:00:00";
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

    $insert = $con->query("INSERT INTO asistenciadia (fechaHoraAsisDia, asistencia_id, tipoAsistencia_id) VALUES ('$fecha', '".$fichaAsistencia['id']."', '".$id_tipo."')");
    $contador = $insert ? $contador+1 : $contador;
}

$respuesta = array(
    'actualizados'=> $contador,
    'total'=> count($array)
);

$myJSON = json_encode($respuesta);

echo $myJSON;

?>