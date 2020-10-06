<?php
include "../databaseConection.php";

$legajo = $_POST["inputLegajo"];

$dni = $_POST["inputDNI"];

$mail = $_POST["inputEmail"];

$pass = passAleatoria();
$Pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);

$consultaAlum = $con->query("SELECT * FROM `alumno` WHERE legajoAlumno = '$legajo' AND dniAlum = '$dni' AND emailAlum = '$mail'");


if (mysqli_num_rows($consultaAlum) == 0) {
    $consultaProf = $con->query("SELECT * FROM `profesor` WHERE legajoProf = '$legajo' AND dniProf = '$dni' AND emailProf = '$mail'");

    if (mysqli_num_rows($consultaProf) == 0) {

        $consultaAdmin = $con->query("SELECT * FROM `administrativo` WHERE legajoAdm = '$legajo' AND dniAdm = '$dni' AND emailAdm = '$mail'");

        if (mysqli_num_rows($consultaAdmin) == 0) {
            //no existe esa combinacion 
            //enviar a pagina anterior con mensaje de error
            header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=2");
        } else {
            //es administrativo
            $resultado3 = $consultaAdmin->fetch_assoc();
            $nombre = $resultado3['nombreAdm'];
            $apellido = $resultado3['apellidoAdm'];
            $id = $resultado3['id'];

            $nombreCompleto = "$nombre $apellido.";
            $rtdoMail = sendEmail($nombreCompleto, $mail, $pass);

            if ($rtdoMail) {
                $consultaAlum = $con->query("UPDATE `administrativo` SET `contraseniaAdm`='$Pass_cifrada' WHERE id = '$id'");
                header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=1");
            } else {
                header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=3");
            }
        }
    } else {
        //es docente 
        $resultado2 = $consultaProf->fetch_assoc();
        $nombre = $resultado2['nombreProf'];
        $apellido = $resultado2['apellidoProf'];
        $id = $resultado2['id'];

        $nombreCompleto = "$nombre $apellido.";
        $rtdoMail = sendEmail($nombreCompleto, $mail, $pass);

        if ($rtdoMail) {
            $consultaAlum = $con->query("UPDATE `profesor` SET `contraseniaProf`='$Pass_cifrada' WHERE id = '$id'");
            header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=1");
        } else {
            header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=3");
        }
    }
} else {
    //es alumno  
    $resultado1 = $consultaAlum->fetch_assoc();
    $nombre = $resultado1['nombreAlum'];
    $apellido = $resultado1['apellidoAlum'];
    $id = $resultado1['id'];

    $nombreCompleto = "$nombre $apellido";
    $rtdoMail = sendEmail($nombreCompleto, $mail, $pass);

    if ($rtdoMail) {
        $consultaAlum = $con->query("UPDATE `alumno` SET `contraseniaAlum`='$Pass_cifrada' WHERE id = '$id'");
        header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=1");
    } else {
        header("location: /DayClass/RestablecerPass/restablecer-contrasenia.php?resultado=3");
    }
}


function sendEmail($nombreC, $eMail, $pass){
    //No tabular el texto, porque toma los espacios.
    $mensaje =  "Hola, $nombreC.

Se ha restablecido su contraseña en DayClass.
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
