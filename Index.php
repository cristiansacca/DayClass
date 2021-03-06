<?php
//Se inicia o restaura la sesión
session_start();

include "header.html";
include "databaseConection.php";

//Si hay una sesión activa no se puede iniciar otra

if (isset($_SESSION['usuario'])) {


   header("Location: /DayClass/Usuario/inicioSesion.php");
   /*$bloqueado = $_SESSION['usuario']["bloqueado"];

   if ($bloqueado == 1) {
      //Se redirigue a la página principal correspondiente al usuario
      header("Location: /DayClass/Administrador/index.php");
   } else {

      $id_permiso = $_SESSION['usuario']["id_permiso"];
      $selectRol = $con->query("SELECT * FROM permiso WHERE permiso.id = '" . $id_permiso . "'");
      $rol = $selectRol->fetch_assoc();
      $nombreRol = $rol["nombrePermiso"];

      //Se redirigue a la página principal correspondiente al rol
      switch ($nombreRol) {
         case "ALUMNO":
            header("Location: /DayClass/Alumno/Index.php");
            break;
         case "DOCENTE":
            header("Location: /DayClass/Profesor/indexCurso.php");
            break;
         default:
            
            break;
      }
   }*/
}

?>

<div class="container">
   <div class="text-center mx-auto h-100 d-flex justify-content-center my-auto pt-4">
      <form action="login.php" method="POST" class="form-group m-4">
         <i class="fa fa-user fa-5x" alt="imagen-usuario"></i>
         <h1 class="font-weight-normal my-2">Inicio de sesión</h1>
         <input type="email" name="email" class="form-control my-2" placeholder="Correo electrónico" required autofocus>

         <input type="password" id="txtPassword" name="contrasenia" class="form-control my-2" placeholder="Contraseña" required>
         <div>
            <input type="checkbox" id="show_password" class="mr-1" onchange="mostrarPassword()"><label onclick="mostrarPassword()">Mostrar contraseña</label>
         </div>

         <button class="btn btn-primary m-auto" style="font-size: large;" type="submit"><i class="fa fa-sign-in mr-1"></i>Ingresar</button><br>
         <a class="btn btn-link my-2" href="RestablecerPass/restablecer-contrasenia.php">Olvidé mi contraseña</a>
      </form>
   </div>

   <div class="text-center mx-auto h-100 d-flex justify-content-center mb-4">
      <?php
      if (isset($_GET["error"])) {
         echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
         switch ($_GET["error"]) {
            case 0:
               echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Contraseña incorrecta.</h5>";
               break;
            case 1:
               echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Correo electrónico no registrado.</h5>";
               break;
            case 2:
               echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Cuenta dada de baja.</h5>";
               break;
            case 3:
               echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Su cuenta no se encuentra habilitada. Diríjase a su email para habilitarla.</h5>";
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
               echo "<div class='alert alert-success alert-dismissible fade show mx-auto' role='alert'>
                             <h4 class='alert-heading'>¡Correo enviado! <i class='fa fa-paper-plane'></i></h4>
                            <h6>Se acaba de enviar una mail de activación al correo electrónico provisto.</h6>
                            <h6 class='mb-0'>Revise su bandeja de entrada o spam.</h6>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
            case 2:
               echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Datos no localizados.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
            case 3:
               echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Se cerró la sesión por inactividad.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
            case 4:
               echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Cuenta activada correctamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
            case 5:
               echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al activar la cuenta.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
               break;
         }
      }

      ?>
   </div>
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