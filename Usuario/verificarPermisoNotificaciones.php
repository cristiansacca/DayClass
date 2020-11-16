<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../databaseConection.php"; // <-- Cambia

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 12")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

}

$respuesta = array(
    'resultado'=> $funcionCorrecta ? 1 : 0
);

$myJSON = json_encode($respuesta);

echo $myJSON;

//-----------------------------------------------------------------------------------------------------------------------------
  
?>