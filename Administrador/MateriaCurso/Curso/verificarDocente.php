<?php
include "../../../databaseConection.php";

$legajo = $_POST["legajo"];

$selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = 'DOCENTE'");
$permiso = $selectPermiso->fetch_assoc();
$id_permiso = $permiso["id"];


//verificar que el usuario ingresado sea alumno 
$selectUsuario = $con->query("SELECT * FROM usuario WHERE legajoUsuario = '$legajo'");

$existe = null;

if (($selectUsuario->num_rows)!=0) {
    $usuario = $selectUsuario->fetch_assoc();
    $permisoUsuario = $usuario["id_permiso"];
    
    if($id_permiso == $permisoUsuario){
        
        $existe = "tienePermisoAlumno";
        
    }else{
        $existe = "noTienePermisoAlumno";
    }
    
 
}else{
    $existe = "noExiste";
}

$myJSON = json_encode($existe);
    
echo $myJSON;  

?>