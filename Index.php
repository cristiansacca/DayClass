<?php
include "header.html";
?>
<link href="DayClassStyle.css" rel="stylesheet" type="text/css">
<div class="text-center m-auto" style="width:45%; height:55%;">
  <form class="form-group m-4">
    <img src="bootstrap-icons-1.0.0-alpha5/person-fill.svg" alt="imagen-usuario" width="90rem" height="90rem">
    <h1 class="font-weight-normal">Inicio de sesión</h1>
    <input type="email" class="form-control m-2" placeholder="Correo electrónico" required autofocus>
    <input type="password" class="form-control m-2" placeholder="Contraseña" required>
    <label class="m-2">
      <input type="checkbox"> Recordar
    </label>
    <button class="btn btn-primary btn-block m-auto" style="width:8rem" type="submit">Ingresar</button>
    <a href="#">Olvidé mi contraseña</a>
  </form>
</div>

<?php
include "footer.html";
?>