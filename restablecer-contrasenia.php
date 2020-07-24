<?php
include "header.html";
?>

<div class="container">
  <div class="form-group text-center my-5">
    <h3 class="font-weight-normal my-4">Ingrese el correo con el que está registrado en DayClass:</h3>
    <i class="fa fa-key fa-5x mb-4"></i>
    <input type="email" class="form-control m-auto" style="width: 20rem;" placeholder="Correo electrónico">
    <input type="button" class="btn btn-primary my-4" value="Restablecer contraseña" data-toggle="modal" data-target="#staticBackdrop">
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
    contenido += "<li class='nav-item'><button class='btn btn-primary' id='btnVolver'><i class='fa fa-arrow-circle-left mx-1'></i>Volver</button></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
  }

  document.getElementById("btnVolver").onclick = function () {
    location.href = "/DayClass/Index.php"
  }
</script>

<?php
include "footer.html";
?>