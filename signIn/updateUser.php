<?php
include "../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$nombre = $_POST["inputName"];
$apellido = $_POST["inputSurname"];

$pass = $_POST["inputPassword"];
$email = $_POST["inputEmail"];
$fchNac = $_POST["inputFechaNac"];
$rol = $_POST["inputRol"];


$pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);
$mail_cifrado = password_hash($email, PASSWORD_DEFAULT);


$insertUsuario = $con->query("UPDATE `usuario` SET `contraseniaUsuario`= '$pass_cifrada',`emailUsuario`= '$email',`fechaNacUsuario`='$fchNac' WHERE legajoUsuario = '$legajo' AND dniUsuario = '$dni'");

if($insertUsuario){
    $cadenaMail = "Hola, $nombre $apellido.

Se ha dado de alta su cuenta en DayClass. 
Su usaurio es el siguiente: $email
Su contraseña es la siguiente: $pass
Puede cambiarla en cualquier momento accediendo a la sección de editar perfil.

Para activar su cuenta hace click en el siguiente link: http://localhost/DayClass/activarCuenta.php?mail=$mail_cifrado&&pass=$pass_cifrada&&di=$dni

Saludos.
Equipo de DayClass.";
    
$resultadoMail = enviarMail($email,$cadenaMail);

    if($resultadoMail){
        //exito en el registro, ya se puede iniciar sesion con los datos generados 
        header("location: /DayClass/Index.php?resultado=1");
    }else{
        //falla en el envio del mail
        header("location: /DayClass/signIn/sign_in.php?resultado=4");
    }
   
}else{
    //fallo en el registro
   header("location: /DayClass/signIn/sign_in.php?resultado=4");
}


function enviarMail($mail,$mensajeEnviar){
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDateTime = date('Y-m-d H:i:s');

    $mensaje = $mensajeEnviar;

    // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
    $mensaje = wordwrap($mensaje, 150, "\r\n");

    //direccion de mail destino, cambiar por el mail propio para porbar 
    $destino = "lea220197@gmail.com,$mail,dayclassdev@gmail.com";

    // Enviamos el email
    $rtdo = mail($destino, 'Alta de cuenta Administrador en DayClass', $mensaje);

    return $rtdo;
}




?>
