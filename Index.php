<?php
include "header.html";
?>
<link href="DayClassStyle.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<div class="text-center m-auto h-100 d-flex justify-content-center" style="width: 25rem;">
  <form class="form-group m-4">
    <i class="fa fa-user fa-5x" alt="imagen-usuario"></i>
    <h1 class="font-weight-normal">Inicio de sesión</h1>
    <input type="email" class="form-control m-2" placeholder="Correo electrónico" required autofocus>
    <input type="password" class="form-control m-2" placeholder="Contraseña" required>
    <div>
      <input type="checkbox">
      <label class="my-2">Recordar</label>
    </div>
    <button class="btn btn-primary btn-block m-auto" style="width:6rem; font-size: large;" type="submit">Ingresar</button>
    <a href="#" class="btn btn-link my-2">Olvidé mi contraseña</a>
  </form>
</div>

<?php
include "footer.html";
?>