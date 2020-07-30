<?php
include "header.html";
?>

<div class="text-center m-auto h-100 d-flex justify-content-center" style="width: 25rem;">
  <form action="login.php" method="POST" class="form-group m-4">
    <i class="fa fa-user fa-5x" alt="imagen-usuario"></i>
    <h1 class="font-weight-normal ml-2">Inicio de sesión</h1>
    <input type="email" name="email" class="form-control m-2" placeholder="Correo electrónico" required autofocus>
    <input type="password" name="contrasenia" class="form-control m-2" placeholder="Contraseña" required>
    <button class="btn btn-primary m-auto" style="font-size: large;" type="submit"><i class="fa fa-sign-in mr-2"></i>Ingresar</button><br>
    <a class="btn btn-link my-2" href="restablecer-contrasenia.php">Olvidé mi contraseña</a>
  </form>
</div>

<?php
include "footer.html";
?>