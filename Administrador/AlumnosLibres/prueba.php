<?php
include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$selectParamMinimoAsistencia = $con->query("SELECT * FROM `paramminimoasistencia` WHERE paramminimoasistencia.fechaAltaMinimoAsistencia <= '$currentDate' AND paramminimoasistencia.fechaBajaMinimoAsistencia IS NULL")->fetch_assoc();

if($selectParamMinimoAsistencia != null){
    $porcentajeMinAsistencia = $selectParamMinimoAsistencia["porcentajeAsistencia"];
    
    $selectCursosVigentes = $con->query("SELECT * FROM `curso` WHERE curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado > '$currentDate'");
    
    
    if(mysqli_num_rows($selectCursosVigentes) != 0){
        while($selectCursosVigentes2 = $selectCursosVigentes->fetch_assoc()){
            $id_curso = $selectCursosVigentes2["id"];
            $totalDiasCursado = calcularDiasCursado($id_curso);
            
            echo "$id_curso";
            echo "$totalDiasCursado"; 
        }
        
    }else{
        //no hay cursos vigentes
         echo "<div class='alert alert-warning' role='alert'>
                <h5>No hay Cursos con fechas de cursado vigentes</h5>
        </div>";
    }
    
}else{
    //no hay porcentaje de minimo de asistencia
    echo "<div class='alert alert-warning' role='alert'>
                <h5>No hay porcentaje de minimo de asistencias definido</h5>
        </div>";
}



function calcularDiasCursado($idCurso){
    include "../../databaseConection.php";
    
    //contar la cantidad de clases que se tiene por semana
    $selectCantClasesPorSemana = $con->query("SELECT COUNT(id) AS cantDias FROM `horariocurso` WHERE horariocurso.curso_id = '$idCurso'")->fetch_assoc();
    
    //si hay dias de la semana definidos para ese curso 
    if($selectCantClasesPorSemana != null){
        
        //leer la cantidad de clases que hay en una semana 
        $clasesPorSemana = $selectCantClasesPorSemana["cantDias"];
        
        //traer las fechas de cursado del curso en cuestion 
        $selectFechasCursadoCurso = $con->query("SELECT curso.fechaDesdeCursado, curso.fechaHastaCursado FROM `curso` WHERE curso.id = '$idCurso'")->fetch_assoc();
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