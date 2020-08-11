<?php
include "../../header.html";
include "../../databaseConection.php";

if(isset($_POST['arregloDatos'])){
    
    $id_curso = $_POST['idCursoEnviar'];
    
    $array = $_POST['arregloDatos'];
    
    $arrayLimpio = json_decode($array, true);
    
    $tamanioArreglo = count($arrayLimpio);
    
   echo"$tamanioArreglo";
    
    date_default_timezone_set('America/Argentina/Mendoza');
    $currentDateTime = date('Y-m-d H:i:s');
            
    $consPresente = $con -> query("SELECT id FROM `tipoasistencia` WHERE `nombreTipoAsistencia` = 'PRESENTE'");
    $resultado5 = $consPresente->fetch_assoc();
    $presenteId = $resultado5["id"];
            
    $consAusente = $con -> query("SELECT id FROM `tipoasistencia` WHERE `nombreTipoAsistencia` = 'AUSENTE'");
    $resultado6 =  $consAusente->fetch_assoc();
    $ausenteId = $resultado6["id"];
            
    
    for($i = 0; $i < $tamanioArreglo; $i++ ){
        
        echo "$i";
        $legajo = $arrayLimpio[$i][0];
        $estado = $arrayLimpio[$i][3];
        
        $consultaIdAlumno = $con -> query("SELECT id FROM alumno WHERE legajoAlumno = '".$legajo."'");
        $resultado3 = $consultaIdAlumno->fetch_assoc();
        $id_alumno = $resultado3["id"];
        
        $consultaAsistencia = $con -> query("SELECT * FROM asistencia WHERE curso_id = '".$id_curso."' AND  alumno_id = '".$id_alumno."'");
        $resultado4 = $consultaAsistencia->fetch_assoc();
        $asistenciaAlumno = $resultado4["id"];
        
        $estadoSetAlumno;
        
        if($estado == "Presente" ){
            $estadoSetAlumno = $presenteId;
        }else{
            $estadoSetAlumno = $ausenteId;
        }
        
        
        $con->query("INSERT INTO asistenciadia (tipoAsistencia_id, asistencia_id, fechaHoraAsisDia) VALUES ('".$estadoSetAlumno."', '".$asistenciaAlumno."','".$currentDateTime."')");
            
    }
    
    
}

include "../../footer.html";
?>