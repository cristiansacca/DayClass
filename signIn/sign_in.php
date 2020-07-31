<?php
include "../header.html";
?>

<script src="signIn_funciones.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>


<div class="text-center m-auto" style="width:45%; height:55%;">
  <form action="registro.php" method="POST">
    <h1 class="title"><u>Registro de nuevo usuario</u></h1>
    <h6 class="text-muted">Los datos aquí ingresados serán validados con los de la institución, cualquier falsedad en los mismos puede derivar en una panalización por parte de la institución.</h6>
    <div class="fill_fields">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputName4">Nombre</label>
          <input type="text" class="form-control" id="inputName" name="nombre" placeholder="Nombre" onchange="validarNombre()" required>
          <h9 class="msg" id="msjValidacionNombre"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputSurname4">Apellido</label>
          <input type="text" class="form-control" id="inputSurname" name="apellido" placeholder="Apellido" onchange="validarApellido()" required>
          <h9 class="msg" id="msjValidacionApellido"></h9>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDNI">DNI</label>
          <input type="number" class="form-control" id="inputDNI" name="dni" placeholder="Documento Nacional de Identidad" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" required>
          <h9 class="msg" id="msjValidacionDNI"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputLegajo">Legajo</label>
          <input type="number" class="form-control" id="inputLegajo" name="legajo" placeholder="Legajo" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" required>
          <h9 class="msg" id="msjValidacionLegajo"></h9>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" onchange="validarEmail()" required>
          <h9 class="msg" id="msjValidacionEmail"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Contraseña</label>
          <div class="input-group">
            <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Contraseña" onchange="validarContrasenia()" required>
            <div class="input-group-append">
              <button id="show_password" class="btn btn-secondary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
            </div>
          </div>
          <h9 class="msg" id="msjValidacionPass"></h9>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDate">Fecha de nacimiento</label>
          <input id="inputDate" name="fechaNac" type="date" class="form-control" onkeydown="return false" onchange="validarFechaNac()" required>
          <h9 class="msg" id="msjValidacionFchNac"></h9>
        </div>
        <div class="form-group col-md-6">
          <label for="inputRole">Rol a registrarse</label>
          <select id="inputRole" name="rol" class="form-control" required>
            <option selected value="alumno">Alumno</option>
            <option value="docente">Docente</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" id="btnRegistrarse" disabled>Registrarse</button>

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