<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}
$id_alumno = $_SESSION["alumno"]["id"];

$consulta1 = $con->query("SELECT `legajoAlumno`,`apellidoAlum`,`nombreAlum`,`dniAlum`, `emailAlum`, `fechaNacAlumno`, `id` FROM `alumno` WHERE id = '$id_alumno'");
$resultado1 = $consulta1->fetch_assoc();

$_SESSION['alumno']= $resultado1;


?>

<div class="container">

  <div class="jumbotron my-4 py-4 bg-light">
      <h1>Editar perfil</h1>
      <a href="index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
  </div>

  <?php
    if(isset($_GET["resultado"])){
        
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5>Modificación exitosa</h5>
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

  <div class="mt-2 mx-auto">
    <form method="post" id="editarAlumno" name="editarAlumno" action="actualizarDatos.php" onsubmit="return validarRepeticion()" enctype="multipart/form-data" role="form">
      <div class="fill_fields">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName4">Nombre</label>
            <input type="text" readonly class="form-control" id="inputName" placeholder="Nombre" required <?php echo "value='".$_SESSION["alumno"]["nombreAlum"]."'"; ?>>
            <h9 class="msg" id="msjValidacionNombre"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputSurname4">Apellido</label>
            <input type="text" readonly class="form-control" id="inputSurname" placeholder="Apellido" required <?php echo "value='".$_SESSION["alumno"]["apellidoAlum"]."'"; ?>>
            <h9 class="msg" id="msjValidacionApellido"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDNI">DNI</label>
            <input type="number" readonly class="form-control" id="inputDNI" name="inputDNI"
              placeholder="Documento Nacional de Identidad" required <?php echo "value='".$_SESSION["alumno"]["dniAlum"]."'"; ?>>
            <h9 class="msg" id="msjValidacionDNI"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputLegajo">Legajo</label>
            <input type="text" readonly class="form-control" id="inputLegajo" name="inputLegajo" placeholder="Legajo" required <?php echo "value='".$_SESSION["alumno"]["legajoAlumno"]."'"; ?>>
            <h9 class="msg" id="msjValidacionLegajo"></h9>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDate">Fecha de nacimiento</label>
            <input id="inputDate" type="date" readonly class="form-control" required <?php echo "value='".$_SESSION["alumno"]["fechaNacAlumno"]."'"; ?>>
            <h9 class="msg" id="msjValidacionFchNac"></h9>
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmailNew" name="inputEmailNew" placeholder="Email" onchange="validarEmail()"
              required <?php echo "value='".$_SESSION["alumno"]["emailAlum"]."'"; ?>>
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
          <div class="form-group col-md-6">
            <label for="inputPassNew">Nueva Contraseña</label>
            <input type="password" class="form-control" id="inputPassNew" name="inputPassNew" placeholder="Escribir Contraseña"
              onchange="validarContrasenia()" >
            <h9 class="msg" id="msjValidacionPass"></h9>
          </div>
          
          <div class="form-group col-md-6">
            <label for="inputPassNewRep">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="inputPassNewRep" name="inputPassNewRep" placeholder="Escribir Contraseña"
              onchange="validarRepeticion()" disabled required>
            <h9 class="msg" id="msjValidacionRepeticion"></h9>
          </div>
        </div>
        <input type="submit" value="Guardar cambios" class="btn btn-primary">
      </div>
    </form>
    
    <script src="alumno.js"></script>

  </div>
    </div>

  <?php
  include "modal-autoasistencia.php";
  ?>

  <?php
include "../footer.html";
?>