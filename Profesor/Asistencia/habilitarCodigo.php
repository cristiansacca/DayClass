<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}
try {
    
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $codigoConEspacio = $_POST['codigoAsis'];
    $tiempo = $_POST['tiempo'];
    $id_curso = $_POST['id_curso'];
    $fechaActual = date('Y-m-d H:i:s');

    //Quita los espacios en blanco del código generado
    $codigo = preg_replace('[\s+]','', $codigoConEspacio);

    //Suma la duración del código a la fecha actual
    $time = new DateTime();
    $time->add(new DateInterval('PT' . $tiempo . 'M'));
    $stamp = $time->format('Y-m-d H:i:s');

    //Verifica si hay un codigo anterior vigente
    $condigoAnterior = $con->query("SELECT * FROM codigoasitencia WHERE id = (SELECT MAX(id) FROM codigoasitencia WHERE curso_id =  '$id_curso')")->fetch_assoc();
    
    $fechaCodigoAnterior;
    
    if($condigoAnterior == ""){
        $fechaCodigoAnterior = "";
    }else{
        $fechaCodigoAnterior = date_create($condigoAnterior['fechaHoraInicioCodigo']);
        $fechaCodigoAnterior = date_format($fechaCodigoAnterior, 'Y-m-d');
    }
    
    $hoy = date_create($fechaActual);
    $hoy = date_format($hoy, 'Y-m-d');

    //echo $fechaCodigoAnterior;
    //echo $hoy;

    if($fechaCodigoAnterior !== $hoy || $fechaCodigoAnterior == "") {
        
        //Tipo asistencia AUSENTE
        $consulta1 = $con->query("SELECT * FROM tipoasistencia WHERE nombreTipoAsistencia = 'AUSENTE'")->fetch_assoc();

        //Todos los alumnos actualmente inscriptos
        $consulta2 = $con->query("SELECT * FROM asistencia WHERE curso_id = '$id_curso' AND fechaHastaFichaAsis IS NULL");

        while($resultado2 = $consulta2->fetch_assoc()){
            $con->query("INSERT INTO asistenciadia (tipoAsistencia_id, asistencia_id) VALUES ('".$consulta1['id']."', '".$resultado2['id']."')");
        }


        $insert = $con->query("INSERT INTO codigoasitencia (fechaHoraInicioCodigo, fechaHoraFinCodigo, numCodigo, curso_id)
        VALUES ('$fechaActual', '$stamp', '$codigo', '$id_curso')");

        if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
            header("location: /DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso&&codigo=$codigoConEspacio");
        } else {
            header("location: /DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso&&error=1");
        }
    } else {
        header("location: /DayClass/Profesor/Asistencia/habilitar_autoasistencia.php?id_curso=$id_curso&&error=2");   
    }

} catch(Exception $e) {

    echo $e->getMessage();

}

include "../../footer.html";
?>