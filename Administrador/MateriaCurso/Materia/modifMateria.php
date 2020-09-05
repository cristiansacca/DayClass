<?php
include "../../../databaseConection.php";

$materia = $_POST["inputNombreMateria"];
$nivel = $_POST["inputNivel"];
$cargaHoraria = $_POST["inputCargaHoraria"];
$id_materia = $_POST["idMateria"];

$updateMateria = $con->query("UPDATE `materia` SET `nivelMateria`= '$nivel',`nombreMateria`='$materia',`cargaHorariaMateria`= '$cargaHoraria' WHERE materia.id = $id_materia");


if($updateMateria){
     header("location: /DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$id_materia&&resultado=4");
    
}else{
    header("Location:/DayClass/Administrador/MateriaCurso/Materia/admMateria.php?resultado=5");
}

?>