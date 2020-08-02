<?php
    include "../databaseConection.php";

    $legajoTraido = $_POST["inputLegajo"];

    $pasNueva = $_POST["inputPassNew"];
    $email = $_POST["inputEmailNew"];

    $consulta1 = $con->query("SELECT id FROM administrativo WHERE legajoAdm = '$legajoTraido'");
    $resultado1 = $consulta1->fetch_assoc(); 
    $id_usuario = $resultado1['id'];
    
    if($pasNueva == ""){
    $consultaAdmin = $con->query("SELECT legajoAdm FROM administrativo WHERE emailAdm = '$email'");
    
    if(mysqli_num_rows($consultaAdmin) == 0){
        
        $mailAlumno = $con->query("SELECT id FROM alumno WHERE emailAlum = '$email'");
        $mailProf = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
        
        if(mysqli_num_rows($mailAlumno) == 0 && mysqli_num_rows($mailProf) == 0){
            
            $actualizacion = $con->query("UPDATE administrativo SET emailAdm = '$email' WHERE id='$id_usuario'");
           
            //echo "entra a actaulizar el mail";
            header("Location:/DayClass/Administrador/editar_perfil.php?resultado=1");
        }else{
           header("Location:/DayClass/Administrador/editar_perfil.php?resultado=2"); 
            
        }
        
    }else{
        $resultado2 =  $consultaAdmin->fetch_assoc(); 
        $legajoConsulta = $resultado2['legajoAdm'];
        if($legajoTraido == $legajoConsulta ){
           
            header("Location:/DayClass/Administrador/editar_perfil.php");
        }else{
            header("Location:/DayClass/Administrador/editar_perfil.php?resultado=2"); 
           
        }
    }
    
    
    
}else{
    $newPass_cifrada = password_hash($pasNueva, PASSWORD_DEFAULT);
    $consultaAdmin = $con->query("SELECT legajoAdm FROM administrativo WHERE emailAdm = '$email'");
    
    if(mysqli_num_rows($consultaAdmin) == 0){
        $mailAlumno = $con->query("SELECT id FROM alumno WHERE emailAlumno = '$email'");
        $mailProf = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
        
        if(mysqli_num_rows($mailAlumno) == 0 && mysqli_num_rows($mailAdmin) == 0){
            $actualizacion = $con->query("UPDATE administrativo SET emailAdm = '$email', contraseniaAdm = '$newPass_cifrada' WHERE id='$id_usuario'");
            header("Location:/DayClass/Administrador/editar_perfil.php?resultado=1");
        }else{
            header("Location:/DayClass/Administrador/editar_perfil.php?resultado=2"); 
        }
        
    }else{
        $resultado2 = $consultaAdmin->fetch_assoc(); 
        $legajoConsulta = $resultado2['legajoAdm'];
        if($legajoTraido == $legajoConsulta ){
            $actualizacion = $con->query("UPDATE administrativo SET contraseniaAdm = '$newPass_cifrada' WHERE id='$id_usuario'");
            header("Location:/DayClass/Administrador/editar_perfil.php?resultado=1");
        }else{
            header("Location:/DayClass/Administrador/editar_perfil.php?resultado=2"); 
        }
    }
}

?>
