<?php
include "../../../databaseConection.php";

$diasYhoras = $_POST["arregloDiasHorario"];

echo "aca esta dias y horas: $diasYhoras";

$id_curso= $_POST["cursoId"];


$arrayLimpio = json_decode($diasYhoras, true);
$tamanioArreglo = count($arrayLimpio);

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$deleteOldCourseDays = $con->query("DELETE FROM `horariocurso` WHERE horariocurso.curso_id = $id_curso");

    if($deleteOldCourseDays){
    
        for($i = 0; $i < $tamanioArreglo; $i++ ){

            $dia = $arrayLimpio[$i][0];
            $horaDesde = $arrayLimpio[$i][1];
            $horaHasta = $arrayLimpio[$i][2];

            $consultaCursoDia = $con -> query("SELECT * FROM `cursodia` WHERE `nombreDiaSA` = '".$dia."'");
            $resultado3 = $consultaCursoDia->fetch_assoc();
            $id_dia = $resultado3["id"];

            $inserHorarioCurso = $con->query("INSERT INTO `horariocurso`(`horaFinCurso`, `horaInicioCurso`, `curso_id`, `cursoDia_id`) VALUES ('$horaHasta','$horaDesde','$id_curso','$id_dia')");

        }
        
        header("location: /DayClass/Administrador/MateriaCurso/Curso/verCurso.php?id_curso=$id_curso&&resultado=1");	
        
    }else{
        header("location: /DayClass/Administrador/MateriaCurso/Curso/verCurso.php?id_curso=$id_curso&&resultado=2");	
    }
    
   
?>