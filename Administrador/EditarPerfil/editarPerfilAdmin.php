<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

$id_admin = $_SESSION['administrador']["id"];

$consulta1 = $con->query("SELECT `legajoAdm`,`apellidoAdm`,`nombreAdm`,`dniAdm`, `emailAdm`, `fechaNacAdm`, `id` FROM `administrativo` WHERE id = '$id_admin'");
$resultado1 = $consulta1->fetch_assoc();

$_SESSION['administrador']= $resultado1;


?>

<script src="../administrador.js"> </script>

<div class="container">
      
  <div class="jumbotron my-4 py-4">
      <p class="card-text">Administrador</p>
      <h1>Editar perfil</h1>
      <a href="../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
  </div>
  <?php
        if(isset($_GET["resultado"])){

            switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Modificación exitosa.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El email ingresado ya existe.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;

            }


        }

        ?>
  <div class="mt-2 mx-auto">
    <form method="post" id="editarAdmin" name="editarAdmin" action="actualizarDatosAdmin.php" onsubmit="return validarRepeticion()" enctype="multipart/form-data" role="form">
      <div class="fill_fields">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName4">Nombre</label>
            <input type="text" readonly class="form-control" id="inputName" name="inputName" placeholder="Nombre" required <?php echo "value='".$_SESSION["administrador"]["nombreAdm"]."'"; ?>>
            <h9 class="msg" id="msjValidacionNombre"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputSurname4">Apellido</label>
            <input type="text" readonly class="form-control" id="inputSurname" name="inputSurname" placeholder="Apellido" required <?php echo "value='".$_SESSION["administrador"]["apellidoAdm"]."'"; ?>>
            <h9 class="msg" id="msjValidacionApellido"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDNI">DNI</label>
            <input type="number" readonly class="form-control" id="inputDNI" name="inputDNI"
              placeholder="Documento Nacional de Identidad" required <?php echo "value='".$_SESSION["administrador"]["dniAdm"]."'"; ?>>
            <h9 class="msg" id="msjValidacionDNI"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputLegajo">Legajo</label>
            <input type="text" readonly class="form-control" id="inputLegajo" name="inputLegajo" placeholder="Legajo" required <?php echo "value='".$_SESSION["administrador"]["legajoAdm"]."'"; ?>>
            <h9 class="msg" id="msjValidacionLegajo"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDate">Fecha de nacimiento</label>
            <input id="inputDate" name="inputDate" type="date" readonly class="form-control" required <?php echo "value='".$_SESSION["administrador"]["fechaNacAdm"]."'"; ?>>
            <h9 class="msg" id="msjValidacionFchNac"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmailNew" name="inputEmailNew" placeholder="Email" onchange="validarEmail()"
              required <?php echo "value='".$_SESSION["administrador"]["emailAdm"]."'"; ?>>
            <h9 class="msg" id="msjValidacionEmail"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class=" form-group col-md-4 control-label ">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#oculto" aria-controls="oculto"
              aria-expanded="false">Cambiar contraseña</button>
          </div>
        </div>

        <div class="form-row collapse" id="oculto">

          <div class="form-group col-md-6">
            <label for="inputPassNew">Nueva contraseña</label>
            <input type="password" class="form-control" id="inputPassNew" name="inputPassNew"  placeholder="Escribir contraseña"
              onchange="validarContrasenia()">
            <h9 class="msg" id="msjValidacionPass"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassNewRep">Confirmar contraseña</label>
            <input type="password" class="form-control" id="inputPassNewRep" name="inputPassNewRep" placeholder="Escribir contraseña"
              onchange="validarRepeticion()" required disabled>
            <h9 class="msg" id="msjValidacionRepeticion"></h9>
          </div>
        </div>
        <input type="submit" value="Guardar cambios" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../footer.html";
?>