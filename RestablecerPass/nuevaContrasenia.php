<?php
include "../databaseConection.php";

$legajo = $_POST["inputLegajo"];

$dni = $_POST["inputDNI"];

$mail = $_POST["inputEmail"];

$pass = passAleatoria();
$Pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);

$consultaAlum = $con->query("SELECT * FROM `usuario` WHERE legajoUsuario = '$legajo' AND dniUsuario = '$dni' AND emailUsuario = '$mail'");

if (mysqli_num_rows($consultaAlum) == 0) {
    //no existe esa combinacion 
    //enviar a pagina anterior con mensaje de error
    header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=2");
        
} else {
    //es alumno  
    $resultado1 = $consultaAlum->fetch_assoc();
    $nombre = $resultado1['nombreUsuario'];
    $apellido = $resultado1['apellidoUsuario'];
    $id = $resultado1['id'];
    
    $mail= 'dayclassdev@gmail.com,lea220197@gmail.com,'.$mail;

    $nombreCompleto = "$nombre $apellido";
    $rtdoMail = sendEmail($nombreCompleto, $mail, $pass);

    if ($rtdoMail) {
        $consultaAlum = $con->query("UPDATE `usuario` SET `contraseniaUsuario`='$Pass_cifrada' WHERE id = '$id'");
        header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=1");
    } else {
        header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=3");
    }
}


function sendEmail($nombreC, $eMail, $pass){
    //No tabular el texto, porque toma los espacios.
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d H:i:s');
    $fechaAlumnoLibre = date_create($currentDate);
    $fechaAlumnoLibre =  date_format($fechaAlumnoLibre, "d/m/Y H:i:s");
    
    $mensaje =  "                                                                                                         $fechaAlumnoLibre
Hola, $nombreC.

El día $fechaAlumnoLibre, se ha restablecido su contraseña en DayClass.
Su nueva contraseña es la siguiente: $pass
Podrá cambiarla una vez que haya iniciado sesión en la sección de editar perfil
    
Saludos.
Equipo de DayClass.";

    // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
    $mensaje = wordwrap($mensaje, 150, "\r\n");

    //direccion de mail destino, cambiar por el mail propio para porbar 
    //$destino = "lea220197@gmail.com,$eMail,dayclassdev@gmail.com";
    $destino = "$eMail";

    // Enviamos el email
    $rtdo = mail($destino, 'Restablecimiento de contraseña', $mensaje);

    return $rtdo;
}

function passAleatoria(){
    $nros = rand(1000,9999);
    $pass = "Dayclass".$nros;
    return $pass;
}
	


?>
