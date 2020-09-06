<?php
include "../../../databaseConection.php";

$nombre = $_POST["inputName"];
$apellido= $_POST["inputSurname"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];
$fchNac = $_POST["inputDate"];
$email = $_POST["inputEmail"];
$currentDateTime = date('Y-m-d H:i:s');




$consultaAlumL = $con->query("SELECT id FROM `alumno` WHERE legajoAlum = $legajo");
$consultaAlumD = $con->query("SELECT id FROM `alumno` WHERE dniAlum = $dni");

$consultaProfL = $con->query("SELECT id FROM `profesor` WHERE legajoProf = $legajo");
$consultaProfD = $con->query("SELECT id FROM `profesor` WHERE dniProf = $dni");

$consultaAdminL = $con->query("SELECT id FROM `administrativo` WHERE legajoAdm = $legajo");
$consultaAdminD = $con->query("SELECT id FROM `administrativo` WHERE dniAdm = $dni");


if(mysqli_num_rows($consultaAlumL) == 0 && mysqli_num_rows($consultaAlumD) == 0 && mysqli_num_rows($consultaProfL) == 0 && mysqli_num_rows($consultaProfD) == 0 && mysqli_num_rows($consultaAdminL) == 0 && mysqli_num_rows($consultaAdminD) == 0){
    
    $pass = passAleatoria();
    $Pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);


    $cadenaMail = "$nombre $apellido, \r\nSe ha dado de alta su cuenta de administrativo en Dayclass \r\nSu contraseña es la siguiente: $pass";

    $consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "ADMINISTRADOR"');
    $resultado1 = $consulta1->fetch_assoc();
    $id_permiso = $resultado1['id'];
    
    $resultado2 = $con->query('INSERT INTO `administrativo`(`nombreAdm`,`apellidoAdm`, `dniAdm`, `fechaAltaAdm`, `legajoAdm`, `permiso_id`,`fechaNacAdm`,`emailAdm`,`contraseniaAdm`) VALUES ("'.$nombre.'","'.$apellido.'","'.$dni.'","'.$currentDateTime.'","'.$legajo.'","'.$id_permiso.'","'.$fchNac.'","'.$email.'","'.$Pass_cifrada.'");');
    
    enviarMail($email,$cadenaMail);
    
    header("Location:/DayClass/Administrador/ConfiguracionSistema/Administradores/configAdmin.php?resultado=1");
    
}else{
     header("Location:/DayClass/Administrador/ConfiguracionSistema/Administradores/configAdmin.php?resultado=2");
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
    $rtdo = mail($destino, 'Alta de cuenta Administrativo en Dayclass', $mensaje);

    return;
}


function passAleatoria(){
    $nros = rand(100,999);
    $pass = "Dayclass".$nros;
    return $pass;
}
	
?>