<?php
include "../../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate= date('Y-m-d');

$id_prof = $_POST["impIDprof"];
$id_curso = $_POST["cursoId"];
$fchDesde = $_POST["fchDesde"];
$fchHasta = $_POST["fchHasta"];


//verificar que el usuario ingresado sea alumno 
$selectLicenciaFechaDesde = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDate' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL AND fechaDesdeCargoProfesorEstado <='$fchDesde' AND fechaHastaCargoProfesorEstado >='$fchDesde' AND `estadoCargoProfesor_id` = 2 ");

$existe = null;

if(($selectLicenciaFechaDesde->num_rows)!=0) {
   $selectLicenciaFechaHasta = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDate' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL AND fechaDesdeCargoProfesorEstado <='$fchHasta' AND fechaHastaCargoProfesorEstado >='$fchHasta' AND `estadoCargoProfesor_id` = 2 "); 
    
    if(($selectLicenciaFechaHasta->num_rows)!=0){
        $existe = "AMBAS";
    }else{
       $existe = "DESDE"; 
    }
    
     
}else{
    $selectLicenciaFechaHasta = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDate' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL AND fechaDesdeCargoProfesorEstado <='$fchHasta' AND fechaHastaCargoProfesorEstado >='$fchHasta' AND `estadoCargoProfesor_id` = 2 "); 
    
    if(($selectLicenciaFechaHasta->num_rows)!=0){
        $existe = "HASTA";
    }else{
       $existe = "NINGUNA"; 
    }
    
}

$myJSON = json_encode($existe);
    
echo $myJSON;  

?>
