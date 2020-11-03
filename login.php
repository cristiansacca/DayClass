<?php
include "databaseConection.php";


date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

//Obtiene los datos del formulario de inicio de sesión
$email = $_POST["email"];
$contrasenia = $_POST["contrasenia"];

//Realiza las consultas con el mail ingresado para obtener el usuario
$consulta1 = $con->query("SELECT * FROM usuario WHERE emailUsuario = '$email'");
$consultaSesion = $con->query("SELECT * FROM vigenciasesion");

//Si el tiempo de sesion no está definido por defecto se ponen 40 minutos
if(($consultaSesion->num_rows) == 0){
    $limiteSesion = 40;
}else{
    $limiteSesion = ($consultaSesion->fetch_assoc())['duracionSesion'];
}

if (($consulta1->num_rows) == 1) { //Si la consulta 1 obtiene un resultado verifica la contraseña
    $resultado1 = $consulta1->fetch_assoc();
    $cuentaHabilitada = $resultado1["cuentaHabilitada"];
    
    
    if($cuentaHabilitada == 1){
        $fechaBajaUsuario = $resultado1["fechaBajaUsuario"];

        if($fechaBajaUsuario == "" || $fechaBajaUsuario == null){//validar que la cuenta no haya sido dada de baja 
            $cifrada = $resultado1["contraseniaUsuario"];
            if (password_verify($contrasenia, $cifrada)) {
                //Si la contraseña cifrada coincide con lo ingresado se inicia la sesión
                session_start();
                //En la variable de sesión se guardan los datos del usuario que ingresó
                $_SESSION["usuario"] = $resultado1;

                //Se define la variable de sesión con el tiempo límite de inactividad en minutos
                $_SESSION['limite'] = ($limiteSesion*60);
                
                $bloqueado = $resultado1["bloqueado"];
                
                if($bloqueado == 1){
                    //Se redirigue a la página principal correspondiente al usuario
                    header("Location: /DayClass/Administrador/index.php");
                }else{
                    
                    $id_permiso = $resultado1["id_permiso"];
                    $selectRol = $con->query("SELECT * FROM permiso WHERE permiso.id = '".$id_permiso."'");
                    $rol = $selectRol->fetch_assoc();
                    $nombreRol = $rol["nombrePermiso"];
                    
                    switch ($nombreRol){
                        case "ALUMNO":
                            header("Location: /DayClass/Alumno/Index.php");
                            break;
                        case "DOCENTE":
                            header("Location: /DayClass/Profesor/indexCurso.php");
                            break;
                        default:
                            header("Location: /DayClass/Usuario/inicioSesion.php");
                            break;
                    }
                }
            } else {
                header("Location: /DayClass/index.php?error=0");
            }

        }else{
            if($fechaBajaUsuario <= $currentDate){
                header("Location: /DayClass/index.php?error=2");
            }
        }
    
    }else{
        header("Location: /DayClass/index.php?error=3");
    }
}else{
    header("Location: /DayClass/index.php?error=1");
}


function buscarRoles($id_permiso){
    
}


?>