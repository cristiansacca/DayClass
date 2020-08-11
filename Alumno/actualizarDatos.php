<?php
    include "../databaseConection.php";

    $legajoTraido = $_POST["inputLegajo"];

    $pasNueva = $_POST["inputPassNew"];
    $email = $_POST["inputEmailNew"];

    $consulta1 = $con->query("SELECT id FROM alumno WHERE legajoAlumno = '$legajoTraido'");
    $resultado1 = $consulta1->fetch_assoc(); 
    $id_usuario = $resultado1['id'];
    
    if($pasNueva == ""){
    $consultaAlumno = $con->query("SELECT legajoAlumno FROM alumno WHERE emailAlum = '$email'");
    
    if(mysqli_num_rows($consultaAlumno) == 0){
        /*echo "entra a mail alumno de PASS VACIA";*/
        $mailDocente = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
        $mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");
        
        if(mysqli_num_rows($mailDocente) == 0 && mysqli_num_rows($mailAdmin) == 0){
            /*echo "entra a mail docente y admin de PASS VACIA, Actauliza mail";*/
            $actualizacion = $con->query("UPDATE alumno SET emailAlum = '$email' WHERE id='$id_usuario'");
            header("Location:/DayClass/Alumno/editar_perfil.php?resultado=1");
        }else{
           header("Location:/DayClass/Alumno/editar_perfil.php?resultado=2"); 
            /*echo "////entra a mail docente y admin de PASS VACIA, EXISTE MAIL IGUAL EN DOCENTE O ADMIN";*/
        }
        
    }else{
        $resultado2 = $consultaAlumno->fetch_assoc(); 
        $legajoConsulta = $resultado2['legajoAlumno'];
        if($legajoTraido == $legajoConsulta ){
           /*echo "////ENTRA A MISMA VERSION DE SU MAIL"; */
            header("Location:/DayClass/Alumno/editar_perfil.php");
        }else{
            header("Location:/DayClass/Alumno/editar_perfil.php?resultado=2"); 
            //echo "////entra a mail ALUMNO de PASS VACIA, EXISTE MAIL IGUAL EN OTRO ALUMNO";
        }
    }
    
    
    
}else{
    $newPass_cifrada = password_hash($pasNueva, PASSWORD_DEFAULT);
    $consultaAlumno = $con->query("SELECT legajoAlumno FROM alumno WHERE emailAlum = '$email'");
    
    if(mysqli_num_rows($consultaAlumno) == 0){
         $mailDocente = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
        $mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");
        
        if(mysqli_num_rows($mailDocente) == 0 && mysqli_num_rows($mailAdmin) == 0){
            $actualizacion = $con->query("UPDATE alumno SET emailAlum = '$email', contraseniaAlum = '$newPass_cifrada' WHERE id='$id_usuario'");
            header("Location:/DayClass/Alumno/editar_perfil.php?resultado=1");
        }else{
            header("Location:/DayClass/Alumno/editar_perfil.php?resultado=2"); 
        }
        
    }else{
        $resultado2 = $consultaAlumno->fetch_assoc(); 
        $legajoConsulta = $resultado2['legajoAlumno'];
        if($legajoTraido == $legajoConsulta ){
            $actualizacion = $con->query("UPDATE alumno SET contraseniaAlum = '$newPass_cifrada' WHERE id='$id_usuario'");
            header("Location:/DayClass/Alumno/editar_perfil.php?resultado=1");
        }else{
            header("Location:/DayClass/Alumno/editar_perfil.php?resultado=2"); 
        }
    }
}

?>




