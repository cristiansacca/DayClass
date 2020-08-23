<?php
include "../databaseConection.php";

$nombreModalidad = $_POST["nombreModalidad"];
$id_materia = $_POST["materiaId"];

$conModalidad = $con->query("SELECT * FROM modalidad WHERE nombre = '$nombreModalidad'");

if(($conModalidad->num_rows)==0){
    $insert = $con->query("INSERT INTO modalidad (nombre) VALUES ('$nombreModalidad')");

    if($insert){
        header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=5");
    } else {
        header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=6");
    }
} else {
    header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=7");
}

?>