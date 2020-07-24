<?php
include "header.html";
?>

<div class="container">
    <div class="form-group text-center my-5">
        <h3 class="font-weight-normal my-4">Ingrese el correo con el que está registrado en DayClass:</h3>
        <input type="email" class="form-control m-auto" style="width: 25rem;"  placeholder="Correo electrónico">
        <input type="button" class="btn btn-primary my-4" value="Restablecer" data-toggle="modal" data-target="#staticBackdrop">
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Correo enviado!</h4>
                <p>Se acaba de enviar una contraseña provisoria al correo indicado.</p>
                <hr>
                <p class="mb-0">Revise su bandeja de entrada o spam.</p>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

<script src="/DayClass/signIn/signIn_funciones.js"></script>

<?php
include "footer.html";
?>