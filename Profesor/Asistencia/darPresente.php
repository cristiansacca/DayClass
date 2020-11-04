<?php
include "../../header.html";
include "../../databaseConection.php";

if(isset($_POST['arregloDatos'])){
    
    $id_curso = $_POST['idCursoEnviar'];
    
    $array = $_POST['arregloDatos'];
    
    $arrayLimpio = json_decode($array, true);
    
    $tamanioArreglo = count($arrayLimpio);
    
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDateTime = date('Y-m-d H:i:s');
            
    $consPresente = $con -> query("SELECT id FROM `tipoasistencia` WHERE `nombreTipoAsistencia` = 'PRESENTE'");
    $resultado5 = $consPresente->fetch_assoc();
    $presenteId = $resultado5["id"];
            
    $consAusente = $con -> query("SELECT id FROM `tipoasistencia` WHERE `nombreTipoAsistencia` = 'AUSENTE'");
    $resultado6 =  $consAusente->fetch_assoc();
    $ausenteId = $resultado6["id"];
            
    
    for($i = 0; $i < $tamanioArreglo; $i++ ){
        
        $legajo = $arrayLimpio[$i][0];
        $estado = $arrayLimpio[$i][3];
        
        $consultaIdAlumno = $con -> query("SELECT id FROM usuario WHERE legajoUsuario = '".$legajo."'");
        $resultado3 = $consultaIdAlumno->fetch_assoc();
        $id_alumno = $resultado3["id"];
        
        $consultaAsistencia = $con -> query("SELECT * FROM asistencia WHERE curso_id = '".$id_curso."' AND  alumno_id = '".$id_alumno."'");
        $resultado4 = $consultaAsistencia->fetch_assoc();
        $asistenciaAlumno = $resultado4["id"];
        
        if($estado == "Presente" ){
            $estadoSetAlumno = $presenteId;
        }else{
            $estadoSetAlumno = $ausenteId;
        }
        
        $con->query("INSERT INTO asistenciadia (tipoAsistencia_id, asistencia_id, fechaHoraAsisDia) VALUES ('".$estadoSetAlumno."', '".$asistenciaAlumno."','".$currentDateTime."')");
            
    }
    
    header("location: /DayClass/Usuario/inicioSesion.php?resultado=0");
} else {
    header("location: /DayClass/Usuario/inicioSesion.php?error=3");
}

include "../../footer.html";
?>