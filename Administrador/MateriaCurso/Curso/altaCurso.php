<?php
include "../databaseConection.php";

$diasYhoras = $_POST["arregloDiasHorario"];

echo "aca esta dias y horas: $diasYhoras";

$id_materia= $_POST["materiaId"];
$division = $_POST["divisiones"];

$arrayLimpio = json_decode($diasYhoras, true);
$tamanioArreglo = count($arrayLimpio);

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

    $consDivision = $con -> query("SELECT * FROM `division` WHERE `id` = '$division'");
    $resultado5 = $consDivision->fetch_assoc();
    $divisionNombre = $resultado5["nombreDivision"];

    $consMateria = $con -> query("SELECT * FROM `materia` WHERE `id` = '$id_materia'");
    $resultado4 = $consMateria->fetch_assoc();
    $materiaNombre = $resultado4["nombreMateria"];

    $nombreCurso = $materiaNombre ." - ". $divisionNombre;

    echo "$nombreCurso";

    $insertCurso = $con -> query("INSERT INTO `curso`(`fechaDesdeCurActual`, `nombreCurso`, `division_id`, `materia_id`) VALUES ('$currentDateTime','$nombreCurso','$division','$id_materia')");
            
    $consultaCursoCreado = $con -> query("SELECT * FROM curso WHERE nombreCurso = '$nombreCurso'");
    $resultado6 = $consultaCursoCreado->fetch_assoc();
    $cursoCreadoId = $resultado6["id"];

    for($i = 0; $i < $tamanioArreglo; $i++ ){
        
        $dia = $arrayLimpio[$i][0];
        $horaDesde = $arrayLimpio[$i][1];
        $horaHasta = $arrayLimpio[$i][2];
        
        $consultaCursoDia = $con -> query("SELECT * FROM `cursodia` WHERE `nombreDia` = '".$dia."'");
        $resultado3 = $consultaCursoDia->fetch_assoc();
        $id_dia = $resultado3["id"];
        
        $inserHorarioCurso = $con->query("INSERT INTO `horariocurso`(`horaFinCurso`, `horaInicioCurso`, `curso_id`, `cursoDia_id`) VALUES ('$horaHasta','$horaDesde','$cursoCreadoId','$id_dia')");
            
    }
    
   header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=1");	
?>