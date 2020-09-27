<?php
include "../../../databaseConection.php";



$id_curso = $_POST["cursoId"];
$fchDesdeCursado = $_POST["inputInicioCursado"];
$fchHastaCursado = $_POST["inputFinCursado"];


$currentDateTime = date('Y-m-d H:i:s');

$consulta1 = $con->query("UPDATE `curso` SET `fechaDesdeCursado`='$fchDesdeCursado',`fechaHastaCursado`='$fchHastaCursado' WHERE `id` = '$id_curso'");

if($consulta1){
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/verCurso.php?id_curso=$id_curso&&resultado=3");
}else{
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/verCurso.php?id_curso=$id_curso&&resultado=4");
}
?>