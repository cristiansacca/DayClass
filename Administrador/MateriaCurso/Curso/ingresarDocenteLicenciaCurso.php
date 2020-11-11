<?php
include "../../../databaseConection.php";

$id_curso= $_POST["cursoId"];
$id_docente = $_POST["impIDprof"];
$fchDesdeLicencia = $_POST["fechaDesde"];
$fchHastaLicencia = $_POST["fechaHasta"];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

 $consulta2 = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_docente' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe = 'Activo'");

$resultado2 = $consulta2->fetch_assoc();
$idCargoProfEstado = $resultado2["id"];
$idCargoProf = $resultado2["cargoProfesor_id"];

              
$consultaEstadoDocente2 = $con->query("INSERT INTO `cargoprofesorestado`(`fechaDesdeCargoProfesorEstado`, `fechaHastaCargoProfesorEstado`, `estadoCargoProfesor_id`, `cargoProfesor_id`) VALUES ('$fchDesdeLicencia','$fchHastaLicencia','2','$idCargoProf')"); 



if($consultaEstadoDocente2){
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/licenciasDocente.php?id_curso=$id_curso&&id_prof=$id_docente&&resultado=1");
}else{
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/licenciasDocente.php?id_curso=$id_curso&&id_prof=$id_docente&&resultado=2");
}
            

            	
?>