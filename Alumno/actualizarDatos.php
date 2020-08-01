<?php

include "../databaseConection.php";

$dni = $_POST["inputDNI"];
$legajo = $_POST["inputLegajo"];

$pasNueva = $_POST["inputPassNew"];
$email = $_POST["inputEmailNew"];

$newPass_cifrada = password_hash($password, PASSWORD_DEFAULT);

$mailAlumno = $con->query("SELECT legajoAlumno FROM alumno WHERE emailAlum = '$email'");
$mailDocente = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
$mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");


$consulta1 = $con->query("SELECT * FROM alumno WHERE dniAlum = '$dni' AND legajoAlumno = '$legajo'"); 
$resultado1 = $consulta1->fetch_assoc(); 
$id_usuario = $resultado1['id'];

if(mysqli_num_rows($mailAlumno) != 0){
    $resultado = $mailAlumno->fetch_assoc();
    $legajoAlum = $resultado['legajoAlumno'];
    
    if($legajo == $legajoAlum ){
        if(&& $pasNueva == ""){
            header("Location:/DayClass/Alumno/editar_perfil.php");
        }else{
            $actualizacion = $con->query("UPDATE alumno SET contraseniaAlum = '$pasNueva' WHERE id='$id_usuario'");
        }
        
    }else{
        header("Location:/DayClass/Alumno/editar_perfil.php?resultado=2"); 
    }

}else{
   if(mysqli_num_rows($mailDocente) == 0 && mysqli_num_rows($mailAdmin) == 0){
        if($pasNueva == ""){
            $actualizacion = $con->query("UPDATE alumno SET emailAlum = '$email' WHERE id='$id_usuario'");
        }else{
            $actualizacion = $con->query("UPDATE alumno SET emailAlum = '$email', contraseniaAlum = '$pasNueva' WHERE id='$id_usuario'");
        }
    
    header("Location:/DayClass/Alumno/editar_perfil.php?resultado=1");
      
}else{
      header("Location:/DayClass/Alumno/editar_perfil.php?resultado=2");  
   }

?>




