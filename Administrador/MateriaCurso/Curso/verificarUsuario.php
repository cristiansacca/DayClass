<?php
include "../../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate= date('Y-m-d');

$legajo = $_POST["legajo"];
$curso = $_POST["curso"];

//verificar que el usuario ingresado sea alumno 
$selectUsuario = $con->query("SELECT * FROM usuario WHERE legajoUsuario = '$legajo'");

$existe = null;

if (($selectUsuario->num_rows)!=0) {
    
    $usuario = $selectUsuario->fetch_assoc();
    $id_usuario = $usuario["id"];
    
    $selectAlumnoCursoActual = $con->query("SELECT * FROM alumnocursoactual, alumnocursoestado,cursoestadoalumno WHERE alumnocursoactual.alumno_id = '$id_usuario' AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDate' AND alumnocursoactual.fechaHastaAlumCurAc >= '$currentDate' AND alumnocursoactual.curso_id = '$curso' AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoestado.fechaInicioEstado <= '$currentDate' AND alumnocursoestado.fechaFinEstado >= '$currentDate' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado <> 'LIBRE'");
    
    if(($selectAlumnoCursoActual->num_rows) == 0){
        
        $selectCargoDocente = $con->query("SELECT * FROM `cargoprofesor` WHERE cargoprofesor.profesor_id = '$id_usuario' AND cargoprofesor.fechaDesdeCargo <= '$currentDate' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.curso_id = '$curso'");
        
        if(($selectCargoDocente->num_rows) == 0){
            $existe = "noAsociado";
        }else{
            $existe = "siAsociado";
        }  
    }else{
        $existe = "siAsociado";
    }
     
}else{
    $existe = "noExiste";
}

$myJSON = json_encode($existe);
    
echo $myJSON;  

?>
