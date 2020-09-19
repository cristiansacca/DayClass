<?php
//Se inicia o restaura la sesión
session_start();

include "header.html";

//Si hay una sesión activa no se puede iniciar otra

if (isset($_SESSION['alumno'])) {
   //Nos envía a la página de inicio de cada usuario
   header("location:/DayClass/Alumno/index.php");
}

if (isset($_SESSION['profesor'])) {
   //Nos envía a la página de inicio de cada usuario
   header("location:/DayClass/Profesor/index.php");
}

if (isset($_SESSION['administrador'])) {
   //Nos envía a la página de inicio de cada usuario
   header("location:/DayClass/Administrador/index.php");
}

?>

<div class="text-center m-auto h-100 d-flex justify-content-center" style="width: 25rem;">
   <form action="login.php" method="POST" class="form-group m-4">
      <i class="fa fa-user fa-5x" alt="imagen-usuario"></i>
      <h1 class="font-weight-normal my-2">Inicio de sesión</h1>
      <input type="email" name="email" class="form-control my-2" placeholder="Correo electrónico" required autofocus>

      <input type="password" id="txtPassword" name="contrasenia" class="form-control my-2" placeholder="Contraseña" required>
      <div>
         <input type="checkbox" id="show_password" class="mr-1" onchange="mostrarPassword()"><label onclick="mostrarPassword()">Mostrar contraseña</label>
      </div>

      <button class="btn btn-primary m-auto" style="font-size: large;" type="submit"><i class="fa fa-sign-in mr-2"></i>Ingresar</button><br>
      <a class="btn btn-link my-2" href="RestablecerPass/restablecer-contrasenia.php">Olvidé mi contraseña</a>

      <?php
      if (isset($_GET["error"])) {
         echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
         switch ($_GET["error"]) {
            case 0:
               echo "<h6>Contraseña incorrecta.</h6>";
               break;
            case 1:
               echo "<h6>Correo electrónico no registrado.</h6>";
               break;
         }
         echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
         </div>";
      }


      if (isset($_GET["resultado"])) {

         switch ($_GET["resultado"]) {
            case 1:
               echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Registro exitoso.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
            case 2:
               echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Datos no localizados.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
            case 3:
               echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>La sesión a caducado.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
         }
      }

      ?>
   </form>
</div>

<script type="text/javascript">
   function mostrarPassword() {
      var cambio = document.getElementById("txtPassword");
      if (cambio.type == "password") {
         cambio.type = "text";
         document.getElementById("show_password").checked = true;
      } else {
         cambio.type = "password";
         document.getElementById("show_password").checked = false;
      }
   }

   document.getElementById("contenidoNavbar").innerHTML = "<a class='btn btn-secondary p-2' href='/DayClass/signIn/sign_in.php' style='width:8rem;'><i class='fa fa-user-plus mx-1'></i>Registrarse</a>";
</script>

<?php
include "footer.html";
?>