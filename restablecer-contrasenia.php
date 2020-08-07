<?php
include "header.html";
?>

<div class="container">
  <div class="jumbotron my-4 py-4">
    <h1>Restablecer contraseña</h1>
    <a href="/DayClass/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
  </div>
  <div class="form-group text-center my-2">
    <form action="" method="POST">
      <h3 class="font-weight-normal my-4">Ingrese el correo con el que está registrado en DayClass:</h3>
      <i class="fa fa-key fa-5x mb-4"></i>
      <input type="email" class="form-control m-auto" style="width: 20rem;" placeholder="Correo electrónico" required>
      <input type="submit" class="btn btn-primary my-4" value="Restablecer contraseña">
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">¡Correo enviado! <i class="fa fa-paper-plane"></i></h4>
          <p>Se acaba de enviar una contraseña provisoria al correo indicado.</p>
          <hr>
          <p class="mb-0">Revise su bandeja de entrada o spam.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>
  cambiarContenidoNavbar();

  function cambiarContenidoNavbar() {
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='/DayClass/index.php'><i class='fa fa-sign-in fa-lg mr-1'></i>Iniciar sesión</a></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
  }
</script>

<?php
include "footer.html";
?>