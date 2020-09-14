<?php
include "../../../databaseConection.php";

$id_prof = $_POST['id_prof'];
$id_curso = $_POST['id_curso'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$consulta1 = $con->query("SELECT * FROM `cargo` WHERE cargo.nombreCargo != (SELECT cargo.nombreCargo FROM curso, cargo, profesor, cargoprofesor WHERE profesor.id = '$id_prof' AND curso.id = '$id_curso' AND curso.id = cargoprofesor.curso_id AND profesor.id = cargoprofesor.profesor_id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.fechaDesdeCargo <= '$currentDate' AND cargoprofesor.fechaHastaCargo IS NULL )");
$cargos = array();

while($resultado1 = $consulta1->fetch_assoc()) {
    $cargos[] = array(
        'id'=> $resultado1['id'],
        'nombreCargo'=> $resultado1['nombreCargo']
    );
}

$myJSON = json_encode($cargos);

echo $myJSON;

?>