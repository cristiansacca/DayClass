<?php
include "../header.html";
?>
<style>
  .custom-file-label::after {
    content: "Elegir";
  }
</style>
<div class="container">
  <div class="my-2">
    <h2 class="display-4">Justificativos</h2>
  </div>
  <form action="#">
    <h4>Cargar justificativo de inasistencias</h4>
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-6 my-2">
        <div class="my-2">
          <label>Seleccione la imagen del justificativo:</label>
          <div class="custom-file my-2">
            <input id="imgJustificativo" type="file" accept="image/*" class="custom-file-input" required>
            <label for="imgJustificativo" class="custom-file-label">Elija el justificativo</label>
          </div>
        </div>
        <div class="my-2">
          <label for="materias">Seleccione las materias que correspondan:</label><br>
          <h9 id="msgMaterias"></h9>
          <div class="form-group" id="materias">
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 1</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 2</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 3</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 4</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 5</label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-6 my-2">
        <div class="my-2">
          <label>Seleccione el periodo al que corresponde el justificativo:</label>
          <div class="my-2">
            <div class="form-inline my-2">
              <label style="margin-right: 1rem;" for="fechaDesde">Desde:</label>
              <input type="date" id="fechaDesde" onchange="validarFechasJustificativo();" class="form-control mr-2"
                <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'"?> required>
              <h9 id="msgDesde"></h9>
            </div>
            <div class="form-inline my-2">
              <label style="margin-right: 1.2rem;" for="fechaHasta">Hasta:</label>
              <input type="date" id="fechaHasta" onchange="validarFechasJustificativo();" class="form-control mr-2"
                <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'"?> required>
              <h9 id="msgHasta"></h9>
            </div>
          </div>
        </div>
      </div>
      <div class="container mb-2">
        <button type="submit" id="btnCargar" class="btn btn-primary" disabled><i class="fa fa-upload pr-1"></i>Cargar</button>
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

<?php
include "modal-autoasistencia.html";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="alumno.js"></script>

<?php
include "../footer.html";
?>