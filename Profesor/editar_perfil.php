<?php
include "../header.html";
include "../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

$id_profesor = $_SESSION["profesor"]["id"];

$consulta1 = $con->query("SELECT `legajoProf`,`apellidoProf`,`nombreProf`,`dniProf`, `emaiProf`, `fechaNacProf`, `id` FROM `profesor` WHERE id = '$id_profesor'");
$resultado1 = $consulta1->fetch_assoc();

$_SESSION['profesor']= $resultado1;


?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="profesor.js"></script>
<script>
    $("#temaDia").attr("hidden", "hidden")
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

<div class="container">
    
    <?php
    if(isset($_GET["resultado"])){
        
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5>Modificacion Exitosa</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5>El mail ingresado ya existe</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
                
        }
        

    }

    ?>

  <div class=" m-auto " style="width:85%; height:55%;">
    <form method="post" id="editarProfesor" name="editarProfesor" action="actualizarDatosProf.php" onsubmit="return validarRepeticion()" enctype="multipart/form-data" role="form">
      <h2 class="title">Perfil</h2>
      <div class="fill_fields">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName4">Nombre</label>
            <input type="text" readonly class="form-control" id="inputName" placeholder="Nombre" required <?php echo "value='".$_SESSION["profesor"]["nombreProf"]."'"; ?>>
            <h9 class="msg" id="msjValidacionNombre"></h9>
          </div>

          <div class="form-group col-md-6">
            <label for="inputSurname4">Apellido</label>
            <input type="text" readonly class="form-control" id="inputSurname" placeholder="Apellido" required <?php echo "value='".$_SESSION["profesor"]["apellidoProf"]."'"; ?>>
            <h9 class="msg" id="msjValidacionApellido"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDNI">DNI</label>
            <input type="number" readonly class="form-control" id="inputDNI"
              placeholder="Documento Nacional de Identidad" required <?php echo "value='".$_SESSION["profesor"]["dniProf"]."'"; ?>>
            <h9 class="msg" id="msjValidacionDNI"></h9>
          </div>

          <div class="form-group col-md-6">
            <label for="inputLegajo">Legajo</label>
            <input type="number" readonly class="form-control" id="inputLegajo" placeholder="Legajo" required <?php echo "value='".$_SESSION["profesor"]["legajoProf"]."'"; ?>>
            <h9 class="msg" id="msjValidacionLegajo"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDate">Fecha de nacimiento</label>
            <input id="inputDate" type="date" readonly class="form-control" required <?php echo "value='".$_SESSION["profesor"]["fechaNacProf"]."'"; ?>>
            <h9 class="msg" id="msjValidacionFchNac"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmailNew" placeholder="Email" onchange="validarEmail()"
              required <?php echo "value='".$_SESSION["profesor"]["emailProf"]."'"; ?>>
            <h9 class="msg" id="msjValidacionEmail"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class=" form-group col-md-4 control-label ">
            <button type="button" class="btn btn-link " data-toggle="collapse" data-target="#oculto" aria-controls="oculto"
              aria-expanded="false">Cambiar Contraseña</button>
          </div>
        </div>

        <div class="form-row collapse" id="oculto">

          <div class="form-group col-md-4">
            <label for="inputPassNew">Nueva Contraseña</label>
            <input type="password" class="form-control" id="inputPassNew" placeholder="Escribir Contraseña"
              onchange="validarContrasenia()">
            <h9 class="msg" id="msjValidacionPass"></h9>
          </div>

          <div class="form-group col-md-4">
            <label for="inputPassNewRep">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="inputPassNewRep" placeholder="Escribir Contraseña"
              onchange="validarRepeticion()" required disabled>
            <h9 class="msg" id="msjValidacionRepeticion"></h9>
          </div>

        </div>
        <input type="button" value="Volver" class="btn btn-secondary" onclick="location.href='/DayClass/Profesor/index.php'">
        <input type="submit" value="Guardar cambios" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>


<?php
include "../footer.html";
?>