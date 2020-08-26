<?php
include "../header.html";
?>

<script src="signIn_funciones.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>-->


<div class="text-center m-auto" style="width:45%; height:55%;">
  <form action="sign_inParte2.php" method="POST">
    <h1 class="title"><u>Registro de nuevo usuario</u></h1>
    <h6 class="text-muted">Los datos aquí ingresados serán validados con los de la institución, cualquier falsedad en los mismos puede derivar en una panalización por parte de la institución.</h6>
    
      
      
    <?php
        if(isset($_GET["resultado"])){

            switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Registro Exitoso</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Datos no localizados</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Usuario ya registrado</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El Correo Electronico, ya es utilizado por otro usuario, proporcione otro</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;

            }


        }

        ?>  
    <div class="fill_fields">
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDNI">DNI</label>
          <input type="number" class="form-control" id="inputDNI" name="inputDNI" placeholder="Documento Nacional de Identidad" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" required>
          <h9 class="msg" id="msjValidacionDNI"></h9>
        </div>
            
        <div class="form-group col-md-6">
          <label for="inputLegajo">Legajo</label>
          <input type="number" class="form-control" id="inputLegajo" name="inputLegajo" placeholder="Legajo" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" required>
          <h9 class="msg" id="msjValidacionLegajo"></h9>
        </div>
      </div>
      


      <button type="submit" class="btn btn-primary" id="btnRegistrarse">Registrarse</button>

    </div>
  </form>
</div>

<script type="text/javascript">
   function mostrarPassword() {
      var cambio = document.getElementById("inputPassword4");
      if (cambio.type == "password") {
         cambio.type = "text";
         $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
      } else {
         cambio.type = "password";
         $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
      }
   }
</script>

<?php
include "../footer.html";
?>