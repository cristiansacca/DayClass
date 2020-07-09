<?php
include "header.html";
?>

<div class="text-center m-auto" style="width:45%; height:55%;">
    <form class="form-group m-4">
      <svg width="6em" height="6em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
      </svg>
      <h1 class="font-weight-normal">Inicio de sesión</h1>
      <input type="email" class="form-control m-2" placeholder="Correo electrónico" required autofocus>
      <input type="password" class="form-control m-2" placeholder="Contraseña" required>
      <label class="m-2">
          <input type="checkbox"> Recordar
      </label>
      <button class="btn btn-lg btn-primary btn-block m-auto" style="width:40%" type="submit">Ingresar</button>
      <a class="">Olvidé mi contraseña</a>
    </form>
</div>

<?php
include "footer.html";
?>
