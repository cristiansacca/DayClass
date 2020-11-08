<?php
include "../../databaseConection.php";

$nombreNuevo = $_POST["inputNombreRol"];
$id_permiso = $_POST["idPermiso"];
$nombrePermiso = strtoupper($nombreNuevo);

$selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = '$nombrePermiso' AND fechaHastaPer IS NULL");

if(($selectPermiso->num_rows) == 0){
    
$updatePermiso = $con->query("UPDATE `permiso` SET `nombrePermiso`= '$nombrePermiso' WHERE permiso.id = '$id_permiso'");

    if($updatePermiso){
         header("Location:/DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=8");

    }else{
        header("Location:/DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=9");
    }
}else{
    header("Location:/DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=10");
}

?>