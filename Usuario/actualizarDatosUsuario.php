<?php
include "../databaseConection.php";

$legajoTraido = $_POST["inputLegajo"];

$pasNueva = $_POST["inputPassNew"];
$email = $_POST["inputEmailNew"];

$consulta1 = $con->query("SELECT id FROM usuario WHERE legajoUsuario = '$legajoTraido'");
$resultado1 = $consulta1->fetch_assoc();
$id_usuario = $resultado1['id'];

if ($pasNueva == "") {
    $consultaUsuario = $con->query("SELECT legajoUsuario FROM usuario WHERE emailUsuario = '$email'");

    if (mysqli_num_rows($consultaUsuario) == 0){
       $actualizacion = $con->query("UPDATE usuario SET emailUsuario = '$email' WHERE id='$id_usuario'");
            if ($actualizacion) {
                 header("Location:/DayClass/Usuario/editar_perfil.php?resultado=1");
            }else{
                header("Location:/DayClass/Usuario/editar_perfil.php?resultado=3");
            }
    }else{
        $resultado2 = $consultaUsuario->fetch_assoc();
        $legajoConsulta = $resultado2['legajoUsuario'];
            if ($legajoTraido == $legajoConsulta) {           
                header("Location:/DayClass/Usuario/editar_perfil.php");
            } else {
                header("Location:/DayClass/Usuario/editar_perfil.php?resultado=2");
            }
    }
}else{
    $newPass_cifrada = password_hash($pasNueva, PASSWORD_DEFAULT);
    $consultaAlumno = $con->query("SELECT legajoUsuario FROM usuario WHERE emailUsuario = '$email'");

    if (mysqli_num_rows($consultaAlumno) == 0) {
        
        $actualizacion = $con->query("UPDATE usuario SET emailUsuario = '$email', contraseniaUsuario = '$newPass_cifrada' WHERE id='$id_usuario'");
        
            if ($actualizacion) {
                header("Location:/DayClass/Usuario/editar_perfil.php?resultado=1");
            }else{
                header("Location:/DayClass/Usuario/editar_perfil.php?resultado=3");
            }

    }else{
        $resultado2 = $consultaAlumno->fetch_assoc();
        $legajoConsulta = $resultado2['legajoUsuario'];
        if ($legajoTraido == $legajoConsulta) {
            $actualizacion = $con->query("UPDATE usuario SET contraseniaUsuario = '$newPass_cifrada' WHERE id='$id_usuario'");
            
            if ($actualizacion) {
                header("Location:/DayClass/Usuario/editar_perfil.php?resultado=1");
            
            }else{
                header("Location:/DayClass/Usuario/editar_perfil.php?resultado=3");
            }

        }else{
            header("Location:/DayClass/Usuario/editar_perfil.php?resultado=2");
        }
    }
}
?>