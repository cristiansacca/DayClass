<?php
include "../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');

$id_cargo = $_POST["cambioCargoDocente"];
$id_curso = $_POST["curso_idCC"];
$id_prof = $_POST["impIDprofCC"];
$fechaHoy = date('Y-m-d');

//bajar el cargo actual
$consultaCargoActual = $con->query("SELECT cargoprofesor.id FROM curso, cargo, profesor, cargoprofesor WHERE profesor.id = '$id_prof' AND curso.id = '$id_curso' AND curso.id = cargoprofesor.curso_id AND profesor.id = cargoprofesor.profesor_id AND cargoprofesor.cargo_id = cargo.id");
$cargoProfesor = $consultaCargoActual->fetch_assoc();
$id_cargoProfesor = $cargoProfesor["id"];

$cerrarCargoActual = $con->query("UPDATE `cargoprofesor` SET `fechaHastaCargo`='$fechaHoy' WHERE id = $id_cargoProfesor");



//crear el cargo nuevo
$crearCargoNuevo = $con->query("INSERT INTO `cargoprofesor`(`fechaDesdeCargo`, `cargo_id`, `curso_id`, `profesor_id`) VALUES ('$fechaHoy','$id_cargo','$id_curso','$id_prof')");



if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
    header("location: /DayClass/Administrador/MateriaCurso/Curso/ModifDocentesCurso.php?id=$id_curso&&resultado=");
} else {
    header("location: /DayClass/&&resultado=0");
}

?>