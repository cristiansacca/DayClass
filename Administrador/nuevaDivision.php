<?php
include "../databaseConection.php";

$nombreDivision = $_POST["nombreDivision"];
$modalidad = $_POST["comboModalidad"];
$id_materia = $_POST["materiaId"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$conDivision = $con->query("SELECT * FROM division WHERE nombreDivision = '$nombreDivision' AND fechaBajaDivision IS NULL");

if(($conDivision->num_rows)==0){
    $insert = $con->query("INSERT INTO division (nombreDivision, fechaAltaDivision, modalidad_id) VALUES ('$nombreDivision', '$currentDateTime', '$modalidad')");

    if($insert){
        header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=8");
    } else {
        header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=9");
    }
} else {
    header("location: /DayClass/Administrador/admcurso.php?id=$id_materia&&resultado=7");
}

?>