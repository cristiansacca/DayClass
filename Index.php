<?php
include "header.html";

//Se inicia o restaura la sesión
session_start();

//Si hay una sesión activa

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
   header("location:/DayClass/administrador/index.php");
}

?>

<div class="text-center m-auto h-100 d-flex justify-content-center" style="width: 25rem;">
   <form action="login.php" method="POST" class="form-group m-4">
      <i class="fa fa-user fa-5x" alt="imagen-usuario"></i>
      <h1 class="font-weight-normal my-2">Inicio de sesión</h1>
      <input type="email" name="email" class="form-control my-2" placeholder="Correo electrónico" required autofocus>
      <div class="input-group">
         <input type="password" id="txtPassword" name="contrasenia" class="form-control my-2" placeholder="Contraseña" required>
         <div class="input-group-append">
            <button id="show_password" class="btn btn-secondary my-2" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
         </div>
      </div>
      <button class="btn btn-primary m-auto" style="font-size: large;" type="submit"><i class="fa fa-sign-in mr-2"></i>Ingresar</button><br>
      <a class="btn btn-link my-2" href="restablecer-contrasenia.php">Olvidé mi contraseña</a>
   </form>
</div>

<script type="text/javascript">
   function mostrarPassword() {
      var cambio = document.getElementById("txtPassword");
      if (cambio.type == "password") {
         cambio.type = "text";
         $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
      } else {
         cambio.type = "password";
         $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
      }
   }
</script>

<?php
include "footer.html";
?>