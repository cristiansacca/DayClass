<?php
include "../../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');
$id_licencia = $_GET['id'];

$selectDatosLicencia = $con->query("SELECT curso_id, profesor_id FROM cargoprofesor, cargoprofesorestado WHERE cargoprofesorestado.id = '$id_licencia' AND cargoprofesorestado.cargoprofesor_id = cargoprofesor.id");
$datosLicencia = $selectDatosLicencia->fetch_assoc();
$id_docente = $datosLicencia["profesor_id"];
$id_curso =$datosLicencia["curso_id"];

$string = "DELETE FROM `cargoprofesorestado`  WHERE `id`= ".$id_licencia;
echo "$string";

$consulta = $con->query($string);

if($consulta){
    
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/licenciasDocente.php?id_curso=$id_curso&&id_prof=$id_docente&&resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/licenciasDocente.php?id_curso=$id_curso&&id_prof=$id_docente&&resultado=4");

}

?>