<?php
$materia = $_POST["materia"];
$curso = $_POST["curso"];
$fechaDesdeReporte = $_POST["fchDesde"];
$fechaHastaReporte = $_POST["fchHasta"];

$resultado = null;

include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$currentDateTime = date('Y-m-d H:i:s');
$currentYear = date('Y');

$fechaHastaReporte = $fechaHastaReporte . " 23:59:59";

$selectTemasDia = $con->query("SELECT temadia.fechaTemaDia, temasmateria.nombreTema, usuario.nombreUsuario, usuario.apellidoUsuario, temadia.comentarioTema FROM `temadia`, curso, temasmateria, usuario WHERE curso.id = '$curso' AND temadia.curso_id = curso.id AND temadia.fechaTemaDia >= '$fechaDesdeReporte' AND temadia.fechaTemaDia <= '$fechaHastaReporte' AND temadia.temasMateria_id = temasmateria.id AND temadia.profesor_id = usuario.id ORDER BY temadia.fechaTemaDia ASC");

//cambiar formato fechas 
$fechaDesdeReporte = date_create($fechaDesdeReporte);
$fechaDesdeReporte = date_format($fechaDesdeReporte, "d/m/Y");
$fechaHastaReporte = date_create($fechaHastaReporte);
$fechaHastaReporte = date_format($fechaHastaReporte, "d/m/Y");

//Datos curso
$selectCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL");
$curso = $selectCurso->fetch_assoc();
$nombreCurso = utf8_decode($curso["nombreCurso"]);



if (($selectTemasDia->num_rows) == 0) {
   $resultado = false; 
} else {
    $resultado = true; 
}

$myJSON = json_encode($resultado);

echo $myJSON;



?>