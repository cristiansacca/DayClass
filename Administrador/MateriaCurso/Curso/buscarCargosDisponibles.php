<?php
include "../../../databaseConection.php";

$id_prof = $_POST['id_prof'];
$id_curso = $_POST['id_curso'];

$consulta1 = $con->query("SELECT * FROM `cargo` WHERE cargo.nombreCargo != (SELECT cargo.nombreCargo FROM curso, cargo, profesor, cargoprofesor WHERE profesor.id = '$id_prof' AND curso.id = '$id_curso' AND curso.id = cargoprofesor.curso_id AND profesor.id = cargoprofesor.profesor_id AND cargoprofesor.cargo_id = cargo.id)");
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