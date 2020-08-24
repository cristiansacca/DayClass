<?php
include "../databaseConection.php";

$id_curso= $_POST["cursoId"];
$id_docente = $_POST["impIDprof"];
$fchDesdeLicencia = $_POST["fechaDesde"];
$fchHastaLicencia = $_POST["fechaHasta"];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$consulta1 = $con->query("SELECT * FROM `curso` WHERE id = '$id_curso'");
$resultado1 = $consulta1->fetch_assoc();


$consultaEstadoDocente1 = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_docente' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$fchDesdeLicencia' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$fchDesdeLicencia' AND cargoprofesorestado.fechaHastaCargoProfesorEstado >= '$fchHastaLicencia' AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe = 'Activo'");

$consultaEstadoDocente2 = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_docente' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$fchDesdeLicencia' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$fchDesdeLicencia' AND cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe = 'Activo'");

$estadoDocente = $consultaEstadoDocente->fetch_assoc();
$nombreEstadoDocente = $estadoDocente["nombreEstadoCargoProfe"];

if(){
    //Si el estado del docente para el inicio de la licencia es activo  
    
    
    
}else{
    
    
    if(){
        
        
    }else{
        
    }
}

//PARA MOSTRAR LAS FECHAS DE ACTIVIDAD Y LICENCIA DE UN DOCENTE
//SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '103' AND cargoprofesor.curso_id = '18' AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id ORDER BY cargoprofesorestado.fechaDesdeCargoProfesorEstado ASC


	
?>