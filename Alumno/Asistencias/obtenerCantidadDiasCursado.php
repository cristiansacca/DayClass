<?php
include "../../databaseConection.php";

$curso_id = $_POST['id_curso'];
$alumno_id = $_POST['id_alumno'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$consulta1 = $con->query("SELECT * FROM paramminimoasistencia WHERE fechaBajaMinimoAsistencia IS NULL");
$tipoPresente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'PRESENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoAusente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoJustificado = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();

if(($consulta1->num_rows) != 0){
    $porcentajeMinimoAsistencias = ($consulta1->fetch_assoc())['porcentajeAsistencia'];
} else {
    $porcentajeMinimoAsistencias = 0;
}

$fichaAsistencia = $con->query("SELECT * FROM asistencia WHERE curso_id = '$curso_id' AND alumno_id = '$alumno_id' AND 
fechaDesdeFichaAsis <= '$currentDateTime' AND fechaHastaFichaAsis >= '$currentDateTime'")->fetch_assoc();

$ausentes = $con->query("SELECT id FROM asistenciadia WHERE asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoAusente['id']."'");
$cantidadAusentes = ($ausentes->num_rows) !== 0 ? ($ausentes->num_rows) : 0;

$datos = array(
    'diasCursado'=> calcularDiasCursado($curso_id),
    'ausentes' => $cantidadAusentes,
    'minimoAsistencias'=> $porcentajeMinimoAsistencias
);

$myJSON = json_encode($datos);

echo $myJSON;

function calcularDiasCursado($curso_id){
    include "../../databaseConection.php";
    
    //contar la cantidad de clases que se tiene por semana
    $selectCantClasesPorSemana = $con->query("SELECT COUNT(id) AS cantDias FROM `horariocurso` WHERE horariocurso.curso_id = '$curso_id'")->fetch_assoc();
    
    //si hay dias de la semana definidos para ese curso 
    if($selectCantClasesPorSemana != null){
        
        //leer la cantidad de clases que hay en una semana 
        $clasesPorSemana = $selectCantClasesPorSemana["cantDias"];
        
        //traer las fechas de cursado del curso en cuestion 
        $selectFechasCursadoCurso = $con->query("SELECT curso.fechaDesdeCursado, curso.fechaHastaCursado FROM `curso` WHERE curso.id = '$curso_id'")->fetch_assoc();
        $fechaDesdeCursado = $selectFechasCursadoCurso["fechaDesdeCursado"];
        $fechaHastaCursado = $selectFechasCursadoCurso["fechaHastaCursado"];
        
        //sacar la cantidad de semanas de cursado que hay entre las fechas de cursado
        $semanasCursado = (strtotime($fechaHastaCursado) - strtotime($fechaDesdeCursado) ) / (60 * 60 * 24 * 7);
        
        //redondear el numero de semanas, a un numero "redondo"
        $cantSemanasCursado = round($semanasCursado);
        
        //sacar los dias de cursado, multiplicando las semanas de cursado por la cantidad de clases semanales
        $cantDiasCursado = $cantSemanasCursado * $clasesPorSemana;
        
        //se quita una cantidad de dias por los dias que no hay clases y por la aproximacion de semanas
        $diasEfectivosCursado = $cantDiasCursado - 5;
        
        return $diasEfectivosCursado;
        
        
    }else{
        //el curso no tiene definido horarios 
        return null;
    }
     
}
?>