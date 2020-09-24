<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Auto-asistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='alert alert-success alert-dismissible fade show' id="exito" role='alert' hidden>
          <h5><i class='fa fa-exclamation-circle mr-2'></i>Código de asistencia ingresado correctamente. Se ha registrado su presente.</h5>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='alert alert-danger alert-dismissible fade show' id="noExiste" role='alert' hidden>
          <h5><i class='fa fa-exclamation-circle mr-2'></i>El código ingresado no existe.</h5>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='alert alert-danger alert-dismissible fade show' id="noVigente" role='alert' hidden>
          <h5><i class='fa fa-exclamation-circle mr-2'></i>El código ingresado ya no se encuentra vigente.</h5>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='alert alert-danger alert-dismissible fade show' id="noInscripto" role='alert' hidden>
          <h5><i class='fa fa-exclamation-circle mr-2'></i>Se ingresó un código para un curso en el que no está inscripto.</h5>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='alert alert-danger alert-dismissible fade show' id="falloCarga" role='alert' hidden>
          <h5><i class='fa fa-exclamation-circle mr-2'></i>Falla al cargar el código. Consulte con el administrador.</h5>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>

        <div class='alert alert-danger alert-dismissible fade show' id="alumnoLibre" role='alert' hidden>
          <h5><i class='fa fa-exclamation-circle mr-2'></i>Actualmente se encuentra libre en esta materia. No puedes registrar tu presente.</h5>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>

        <div class=" text-center my-3 mx-4 form-row">
          <div class="form-group col-12 ">
            <h3>Ingrese el código dado por el profesor</h3><br>

            <div id="resultadoMostrar"></div>

            <h6 class="text-muted">Sin guiones ni espacios</h6>
            <input type="text" class="form-control m-auto text-center" style="width: 230px; font-size: large; border-width: 4px;" id="inputCodigoIngresado" onkeyup="this.value = this.value.toUpperCase();" maxlength="11" name="inputCodigoIngresado">
            <h9 id="msgValidacionCodigo"></h9> <br>
            <button class="btn-lg btn-dayclass my-3" id="btnVerificarCodIngresado" onclick="validarLongCodIngresado()" type="submit"><a class="fa fa-check mr-1"></a>Dar presente</button>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrar">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="/DayClass/Alumno/fnAutoasistencia.js"></script>
<script>
  <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['alumno']['nombreAlum'] . " " . $_SESSION['alumno']['apellidoAlum'] . "'" ?>
</script>