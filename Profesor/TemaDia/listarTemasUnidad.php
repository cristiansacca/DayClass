<?php
include "../../databaseConection.php";

$id_programa = $_POST['id_programa'];
$nro_unidad = $_POST['nro_unidad'];

$consulta1 = $con->query("SELECT * FROM `temasmateria` WHERE unidadTema = $nro_unidad AND programaMateria_id = $id_programa ORDER BY id");
$temas = array();

if($consulta1){
    while($resultado1 = $consulta1->fetch_assoc()) {
        $temas[] = array(
            'id'=> $resultado1['id'],
            'nombreTema'=> $resultado1['nombreTema']
        );
    }
    
    $myJSON = json_encode($temas);
    
    echo $myJSON;   
} else {
    echo json_encode([]);  
} 

?>