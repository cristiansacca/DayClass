<?php
include "../header.html";
?>

<script src="signIn_funciones.js"></script>

<?php
include "../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$legajo = $_POST["inputLegajo"];

$dni = $_POST["inputDNI"];


$consultaUsuario = $con->query("SELECT * FROM `usuario` WHERE legajoUsuario = '$legajo' AND dniUsuario = '$dni' AND bloqueado = 0");

if (mysqli_num_rows($consultaUsuario) == 0) {
    //no existe esa combinacion 
    //enviar a pagina anterior con mensaje de error
    header("location: /DayClass/signIn/sign_in.php?resultado=2");
  
}else {
  //es   
    $resultado1 = $consultaUsuario->fetch_assoc();
    
    $id_permiso = $resultado1['id_permiso'];
    $nombre = $resultado1['nombreUsuario'];
    $apellido = $resultado1['apellidoUsuario'];
    $pass = $resultado1['contraseniaUsuario'];
    $mail = $resultado1['emailUsuario'];
    $nac = $resultado1['fechaNacimientoUsuario'];
    $cuentaHabilitada = $resultado1["cuentaHabilitada"];
    $nombrePermiso = null;
    
    if($cuentaHabilitada == 0){
            if($id_permiso == NULL || $id_permiso == ""){
                header("location: /DayClass/signIn/sign_in.php?resultado=5");
            }else{
                $selectPermiso = $con->query("SELECT * FROM `permiso` WHERE permiso.id = '$id_permiso' AND permiso.fechaDesdePer <= '$currentDate' AND permiso.fechaHastaPer IS NULL");
                $permiso = $selectPermiso->fetch_assoc();
                $nombrePermiso = $permiso["nombrePermiso"];
            }
        }else{
            header("location: /DayClass/signIn/sign_in.php?resultado=3");
        }
    }

?>

<div class="container">
  <div class="jumbotron my-4 py-4">
    <h1>Registro de nuevo usuario</h1>
    <h6 class="text-muted">Los datos aquí ingresados serán validados con los de la institución. Evite cualquier falsedad en los mismos.</h6>
    <a href="/DayClass/index.php" class="btn btn-success"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
  </div>
  <h6 class="text-muted">Complete los datos faltantes: </h6>
  <form action="updateUser.php" method="POST" onsubmit="return valiarCampos()">
    <div class="fill_fields text-center m-auto">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDNI">DNI</label>
          <input type="number" class="form-control" id="inputDNI" name="inputDNI" <?php echo "value= '$dni'"; ?> readonly>
          <h9 class="msg" id="msjValidacionDNI"></h9>
        </div>

        <div class="form-group col-md-6">
          <label for="inputLegajo">Legajo</label>
          <input type="text" class="form-control" id="inputLegajo" name="inputLegajo" <?php echo "value= '$legajo'"; ?> readonly>
          <h9 class="msg" id="msjValidacionLegajo"></h9>
        </div>
      </div>

      <div class="form-row" id="nombreApellido">
        <div class="form-group col-md-6">
          <label for="inputName4">Nombre</label>
          <input type="text" class="form-control" id="inputName" name="inputName" readonly <?php echo "value= '$nombre'"; ?>>
          <h9 class="msg" id="msjValidacionNombre"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputSurname4">Apellido</label>
          <input type="text" class="form-control" id="inputSurname" name="inputSurname" readonly <?php echo "value= '$apellido'"; ?>>
          <h9 class="msg" id="msjValidacionApellido"></h9>
        </div>
      </div>

      <div class="form-row" id="MailPass">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" onchange="validarEmail()" required>
          <h9 class="msg" id="msjValidacionEmail"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Contraseña</label>
          <div class="input-group">
            <input type="password" class="form-control" id="inputPassword4" name="inputPassword" placeholder="Contraseña" onchange="validarContrasenia()" required>
            <div class="input-group-append">
              <button id="show_password" class="btn btn-secondary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye icon"></span></button>
            </div>
          </div>
          <h9 class="msg" id="msjValidacionPass"></h9>
        </div>
      </div>

      <div class="form-row" id="rolNac">
        <div class="form-group col-md-6">
          <label for="inputDate">Fecha de nacimiento</label>
          <input id="inputDate" name="inputFechaNac" type="date" class="form-control" onkeydown="return false" onchange="validarFechaNac()" required>
          <h9 class="msg" id="msjValidacionFchNac"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputSurname4">Rol</label>
          <input type="text" class="form-control" id="inputRol" name="inputRol" <?php echo "value= '$nombrePermiso'"; ?> readonly>
          <h9 class="msg" id="msjValidacionApellido"></h9>
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
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    } else {
      cambio.type = "password";
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }
  }
</script>

<?php
include "../footer.html";
?>