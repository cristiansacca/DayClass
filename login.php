<?php
include "header.html";
?>
<?php
include "databaseConection.php";

//Obtiene los datos del formulario de inicio de sesión
$email = $_POST["email"];
$contrasenia = $_POST["contrasenia"];

//Realiza las consultas con el mail ingresado para obtener el usuario
$consulta1 = $con->query("SELECT * FROM alumno WHERE emailAlum = '$email'");

if (($consulta1->num_rows) == 1) { //Si la consulta 1 obtiene un resultado verifica la contraseña
    
    $resultado1 = $consulta1->fetch_assoc();
    $cifrada = $resultado1["contraseniaAlum"];
    
    if (password_verify($contrasenia, $cifrada)) {
        
        session_start();
        $_SESSION["alumno"] = $resultado1;
        header("Location: /DayClass/Alumno/index.php");

    } else {
        echo "<div class='container'><br><div class='alert alert-danger' role='alert'>
        <h3>Contraseña incorrecta</h3>
        </div>";
        echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a></div>";
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
            echo "<div class='container'><br><div class='alert alert-danger' role='alert'>
            <h3>Contraseña incorrecta</h3>
            </div>";
            echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a></div>";
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
                echo "<div class='container'><br><div class='alert alert-danger' role='alert'>
                <h3>Contraseña incorrecta</h3>
                </div>";
                echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a></div>";
            }
        } else { //Si ninguna consulta obtnien resultado el email ingresado no existe en la base de datos
            echo "<div class='container'><br><div class='alert alert-danger' role='alert'>
                <h3>El correo electrónico ingresado no se encuentra registrado</h3>
              </div>";
            echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a></div>";
        }
    }
}

?>
<?php
include "footer.html"
?>