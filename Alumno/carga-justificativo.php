<?php
include "../header.html";
?>
<style>.custom-file-label::after { content: "Elegir";}</style>
<div class="container">
    <div class="my-2">
        <h2 class="display-4">Justificativos</h2>
    </div>
    <form action="#">
        <h4>Cargar justificativo de inasistencias</h4>
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-6 my-2">
                <label>Seleccione el periodo al que corresponde el justificativo:</label>
                <div class="my-2">
                    <div class="form-inline my-2">
                      <label style="margin-right: 1rem;" for="fechaDesde">Desde:</label>
                      <input type="date" id="fechaDesde" onchange="validarFechasJustificativo();" class="form-control mr-2" <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'"?> required>
                      <h9 id="msgDesde"></h9>
                    </div>
                    <div class="form-inline my-2">
                      <label style="margin-right: 1.2rem;" for="fechaHasta">Hasta:</label>
                      <input type="date" id="fechaHasta" onchange="validarFechasJustificativo();" class="form-control mr-2" <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'"?> required>
                      <h9 id="msgHasta"></h9>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-6 my-2">
              <label>Seleccione la imagen del justificativo:</label>
              <div class="custom-file my-2">
                  <input id="imgJustificativo" type="file" accept="image/*" class="custom-file-input" required>
                  <label for="imgJustificativo" class="custom-file-label">Elija el justificativo</label>
                  <button type="submit" id="btnCargar" class="btn btn-primary my-3 disabled">Cargar</button>
              </div>
          </div>
        </div>
    </form>
    <div class="my-2">
        <h4>Justificativos pendientes de confirmación</h4>
        <div id="pendientes">
            <div class="alert alert-info" role="alert">
                No tenés justificativos pendientes de confirmación
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Auto-asistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class=" text-center my-3 mx-4 form-row">
          <div class="form-group col-12 ">
            <h3>Ingrese el código dado por el profesor</h3><br>
            <h6 class="text-muted">Sin guiones ni espacios</h6>
            <input type="text"  class="form-control m-auto text-center" style="width: 230px; font-size: large; border-width: 4px;" id = "inputCodigoIngresado" onkeyup="this.value = this.value.toUpperCase();" maxlength="11">
            <h9 id = "msgValidacionCodigo" ></h9> <br>
            <input type="button" class="btn btn-lg btn-secondary my-3" value="Dar Presente" style=" background-color: mediumpurple; border-color: mediumpurple" id ="btnVerificarCodIngresado" onclick = "validarLongCodIngresado()">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrar">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="alumno.js"></script>

<?php
include "../footer.html";
?>