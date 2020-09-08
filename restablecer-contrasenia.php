<?php
include "header.html";
?>

<?php
        include "databaseConection.php";
        $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
        $rtdo = false;
        $dni = null;

        if (!($consultaParamLeg->num_rows) == 0) {
            $formatoLegajo = $consultaParamLeg->fetch_assoc();
            $rtdo = true;
            $dni = $formatoLegajo["esDNI"];

            echo "<input type='text' id='esDNI' name='esDNI' value='$dni' hidden>";
            if ($dni) {
            } else {

                $letras = $formatoLegajo["tieneLetras"];
                $numeros = $formatoLegajo["tieneNumeros"];

                $cantTotal = $formatoLegajo["cantTotalCaracteres"];
                echo "<input type='text' id='cantTotal' name='cantTotal' value='$cantTotal' hidden>";

                echo "<input type='text' id='letras' name='letras' value='$letras' hidden>";
                echo "<input type='text' id='numeros' name='numeros' value='$numeros' hidden>";


                if ($letras) {
                    $cantLetras = $formatoLegajo["cantLetras"];

                    echo "<input type='text' id='cantLetras' name='cantLetras' value='$cantLetras' hidden>";
                }
                if ($numeros) {
                    $cantNumeros = $formatoLegajo["cantNumeros"];

                    echo "<input type='text' id='cantNumeros' name='cantNumeros' value='$cantNumeros' hidden>";
                }
            }
        } else {
            echo "<div class='alert alert-warning' role='alert'>
                <h5>Su institucion no ha definido un formato de legajo</h5>
            </div>";
        }

?>

<div class="container">
  <div class="jumbotron my-4 py-4">
    <h1>Restablecer contraseña</h1>
    <a href="/DayClass/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
  </div>
  <div class="form-group text-center my-2">
    <form action="" method="POST" onsubmit="return validarRestPass()">
      <h3 class="font-weight-normal my-4">Ingrese los datos con los que esta registrado en DayClass:</h3>
      <i class="fa fa-key fa-5x mb-4"></i>
        <input type="email" class="form-control m-auto" style="width: 20rem;" placeholder="Correo electrónico" id="inputEmail" name="inputEmail" onchange="validarEmail()" required>
        <h9 class="msg" id="msjValidacionEmail"></h9>
        <input type="number" class="form-control m-auto" id="inputDNI" name="inputDNI" placeholder="Documento Nacional de Identidad" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" required style="width: 20rem;">
        <h9 class="msg" id="msjValidacionDNI"></h9>
        <input type="text" class="form-control m-auto" id="inputLegajo" name="inputLegajo" placeholder="Legajo" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" style="width: 20rem;" <?php if($dni){echo "hidden  ";}else{"requiered  ";} ?>>
        <h9 class="msg" id="msjValidacionLegajo"></h9>
          
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


<script src="signIn/signIn_funciones.js"></script>

<?php
include "footer.html";
?>