<?php
include "../../databaseConection.php";

$id_permiso = $_POST["permisoId"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');


//consultar existencia del usuario (habilitado = fecha de baja null) en la BD de dayclass
$consultaUsuarioID = $con->query("SELECT * FROM `usuario` WHERE dniUsuario = '$dni' AND legajoUsuario = '$legajo' AND fechaBajaUsuario IS NULL");

if(($consultaUsuarioID->num_rows) == 0){
    //si la consulta es vacia, el usuario no existe o esta dado de baja, error 4 = usuario inexistente o dado de baja 
    header("location: /DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=5");
    
    
}else{
    $resultado3= $consultaUsuarioID->fetch_assoc();
    $id_usuario = $resultado3["id"];
    
    //verificar que el alumno no vaya a estar inscripto en el ese curso 
    $updatePermisoUsuario = $con->query("UPDATE `usuario` SET `id_permiso`='$id_permiso' WHERE usuario.id = '$id_usuario'");
    
    if($updatePermisoUsuario){
        //actualizacion correcta del Rol del usuario
        header("location: /DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=3");
        
    }else{
        //falla en la actualizacion del Rol del usuario 
       header("location: /DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=4");
    }
}

?>