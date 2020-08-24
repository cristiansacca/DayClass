<?php
include "../databaseConection.php";

$nombreModalidad = $_POST["nombreModalidad"];
$id_materia = $_POST["materiaId"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$conModalidad = $con->query("SELECT * FROM modalidad WHERE nombre = '$nombreModalidad' AND fechaBajaModalidad IS NULL");

if(($conModalidad->num_rows)==0){
    $insert = $con->query("INSERT INTO modalidad (nombre, fechaAltaModalidad) VALUES ('$nombreModalidad', '$currentDateTime')");

    if($insert){
        header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=5");
    } else {
        header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=6");
    }
} else {
    header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=7");
}

?>