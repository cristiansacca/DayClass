<?php
//Se inicia o restaura la sesión
session_start();

include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
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
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('Y-m-d');
        $currentDateTime = date('Y-m-d H:i:s');
        
        
        
        //Tipo asistencia AUSENTE
        $consulta1 = $con->query("SELECT * FROM tipoasistencia WHERE nombreTipoAsistencia = 'AUSENTE'")->fetch_assoc();

        //Todos los alumnos actualmente inscriptos, con estado inscripto en el dia de hoy
        $consulta2 = $con->query("SELECT asistencia.id AS asistID, usuario.id, apellidoUsuario, nombreUsuario, legajoUsuario FROM usuario, alumnocursoactual, curso, cursoestadoalumno, alumnocursoestado, asistencia WHERE usuario.id = asistencia.alumno_id AND usuario.fechaBajaAlumno IS NULL AND curso.id = asistencia.curso_id AND usuario.id = alumnocursoactual.alumno_id AND alumnocursoactual.curso_id = curso.id AND curso.id = '$id_curso' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDate' AND alumnocursoactual.fechaDesdeAlumCurAc<= '$currentDate' AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoestado.fechaInicioEstado <= '$currentDate' AND alumnocursoestado.fechaFinEstado > '$currentDate' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'INSCRIPTO'");

        while($resultado2 = $consulta2->fetch_assoc()){
            
            $con->query("INSERT INTO asistenciadia (tipoAsistencia_id, asistencia_id, fechaHoraAsisDia) VALUES ('".$consulta1['id']."', '".$resultado2['asistID']."','$currentDateTime')");
        }


        $insert = $con->query("INSERT INTO codigoasitencia (fechaHoraInicioCodigo, fechaHoraFinCodigo, numCodigo, curso_id)
        VALUES ('$fechaActual', '$stamp', '$codigo', '$id_curso')");

        if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
           
            echo "llega todo bien";
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
?>