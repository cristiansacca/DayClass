<?php
include "databaseConection.php";

//Obtiene los datos del formulario de inicio de sesión
$email = $_POST["email"];
$contrasenia = $_POST["contrasenia"];

//Realiza las consultas con el mail ingresado para obtener el usuario
$consulta1 = $con->query("SELECT * FROM alumno WHERE emailAlum = '$email'");
$consultaSesion = $con->query("SELECT * FROM vigenciasesion");

//Si el tiempo de sesion no está definido por defecto se ponen 40 minutos
($consultaSesion->num_rows) != 0 ? $limiteSesion = $consultaSesion->fetch_assoc() : $limiteSesion = 40;

if (($consulta1->num_rows) == 1) { //Si la consulta 1 obtiene un resultado verifica la contraseña
    
    $resultado1 = $consulta1->fetch_assoc();
    $cifrada = $resultado1["contraseniaAlum"];
    
    if (password_verify($contrasenia, $cifrada)) {
        //Si la contraseña cifrada coincide con lo ingresado se inicia la sesión
        session_start();
        //En la variable de sesión se guardan los datos del usuario que ingresó
        $_SESSION["alumno"] = $resultado1;
        
        //Se define la variable de sesión con el tiempo límite de inactividad en minutos
        $_SESSION['limite'] = ($limiteSesion['duracionSesion']*60);
        
        //Se redirigue a la página principal correspondiente al usuario
        header("Location: /DayClass/Alumno/index.php");

    } else {
        header("Location: /DayClass/index.php?error=0");
    }
} else {

    $consulta2 = $con->query("SELECT * FROM profesor WHERE emailProf = '$email'");

    if (($consulta2->num_rows) == 1) {
        
        $resultado2 = $consulta2->fetch_assoc();
        $cifrada = $resultado2["contraseniaProf"];

        if (password_verify($contrasenia, $cifrada)) {
            
            session_start();
            $_SESSION["profesor"] = $resultado2;
            header("Location: /DayClass/Profesor/index.php");

        } else {
            header("Location: /DayClass/index.php?error=0");
        }
    } else {

        $consulta3 = $con->query("SELECT * FROM administrativo WHERE emailAdm = '$email'");

        if (($consulta3->num_rows) == 1) {
            
            $resultado3 = $consulta3->fetch_assoc();
            $cifrada = $resultado3["contraseniaAdm"];
            
            if (password_verify($contrasenia, $cifrada)) {
                
                session_start();
                $_SESSION["administrador"] = $resultado3;
                header("Location: /DayClass/Administrador/index.php");

            } else {
                header("Location: /DayClass/index.php?error=0");
            }
        } else { //Si ninguna consulta obtnien resultado el email ingresado no existe en la base de datos
            header("Location: /DayClass/index.php?error=1");
        }
    }
}

?>