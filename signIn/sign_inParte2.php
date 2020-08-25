<?php
include "../header.html";
?>

<script src="signIn_funciones.js"></script>

<?php
include "../databaseConection.php";

$legajo = $_POST["inputLegajo"];

$dni = $_POST["inputDNI"];

$consultaAlum = $con->query("SELECT * FROM `alumno` WHERE legajoAlumno = '$legajo' AND dniAlum = '$dni'");

//echo "SELECT * FROM `alumno` WHERE legajoAlum = '$legajo' AND dniAlum = '$dni'";

if(mysqli_num_rows($consultaAlum) == 0){
    $consultaProf = $con->query("SELECT * FROM `profesor` WHERE legajoProf = '$legajo' AND dniProf = '$dni'");
    
    if(mysqli_num_rows($consultaProf) == 0){
            //no existe esa combinacion 
        //enviar a pagina anterior con mensaje de error
        header("location: /DayClass/signIn/sign_in.php?resultado=2");
    }else{
       //es docente 
        $resultado2 = $consultaProf->fetch_assoc();
        $nombre = $resultado2['nombreProf'];
        $apellido = $resultado2['apellidoProf'];
        $rol = "Profesor";
    }
    
}else{
   //es alumno  
    $resultado1 = $consultaAlum->fetch_assoc();
    $nombre = $resultado1['nombreAlum'];
    $apellido = $resultado1['apellidoAlum'];
    $rol = "Alumno";
}

?>

<div class="text-center m-auto" style="width:45%; height:55%;">
  <form action="updateUser.php" method="POST" onsubmit="return valiarCampos()">
    <h1 class="title"><u>Registro de nuevo usuario</u></h1>
    <h6 class="text-muted">Los datos aquí ingresados serán validados con los de la institución, cualquier falsedad en los mismos puede derivar en una panalización por parte de la institución.</h6>
    
    <div class="fill_fields">
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDNI">DNI</label>
          <input type="number" class="form-control" id="inputDNI" name="inputDNI" <?php echo "value= '$dni'";?> readonly>
          <h9 class="msg" id="msjValidacionDNI"></h9>
        </div>
            
        <div class="form-group col-md-6">
          <label for="inputLegajo">Legajo</label>
          <input type="number" class="form-control" id="inputLegajo" name="inputLegajo" <?php echo "value= '$legajo'";?> readonly>
          <h9 class="msg" id="msjValidacionLegajo"></h9>
        </div>
      </div>
      
<h6 class="text-muted">Sus Datos</h6>
    <div class="form-row" id="nombreApellido">
        <div class="form-group col-md-6">
          <label for="inputName4">Nombre</label>
          <input type="text" class="form-control" id="inputName" name="inputName" readonly <?php echo "value= '$nombre'";?> >
          <h9 class="msg" id="msjValidacionNombre"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputSurname4">Apellido</label>
          <input type="text" class="form-control" id="inputSurname" name="inputSurname" readonly <?php echo "value= '$apellido'";?>  >
          <h9 class="msg" id="msjValidacionApellido"></h9>
        </div>
      </div>

      
<h6 class="text-muted">Complete: </h6>
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
              <button id="show_password" class="btn btn-secondary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
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
          <input type="text" class="form-control" id="inputRol" name="inputRol" <?php echo "value= '$rol'";?>  readonly>
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