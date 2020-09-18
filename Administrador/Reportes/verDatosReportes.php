<?php


$materia = $_POST["materia"];
$curso = "Todos los cursos"; 
$alumno = "Todos los alumnos";

if($materia == "Todas"){
    
}else{
    $curso= $_POST["curso"];
    
    
    if($curso != "Todos"){
        $alumno = $_POST["alumno"];
    }
    



    
}

echo "$materia - ";
echo "$curso - ";
echo "$alumno - ";





?>