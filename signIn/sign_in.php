<?php
include "header.html";
?>
<script src="signIn_funciones.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>


<div class="text-center m-auto" style="width:45%; height:55%;">
<form>
<h1 class="title"><u>Registro de nuevo usuario</u></h1>
<h6 class="light_txt">Todos los datos aquí ingresados serán validados contra los ya almacenados por la institución, cualquier falsedad en los mismos conllevará a una panalización por parte de las autoridades</h6>
<div class="fill_fields">
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName4">Nombre</label>
      <input type="text" class="form-control" id="inputName" placeholder="Nombre" onchange="validarNombre()" required>
        <h9 class="msg" id="msjValidacionNombre"></h9>
    </div>
    <div class="form-group col-md-6">
      <label for="inputSurname4">Apellido</label>
      <input type="text" class="form-control" id="inputSurname" placeholder="Apellido" onchange="validarApellido()" required>
        <h9 class="msg" id="msjValidacionApellido"></h9>
    </div>
</div>  
        
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputDNI">DNI</label>
      <input type="number" class="form-control" id="inputDNI" placeholder="Documento Nacional de Identidad" onchange="validarDNI()" required>
        <h9 class="msg" id="msjValidacionDNI"></h9>
    </div>
    <div class="form-group col-md-6">
      <label for="inputLegajo">Legajo</label>
      <input type="number" class="form-control" id="inputLegajo" placeholder="Legajo" onchange="validarLegajo()" required>
        <h9 class="msg" id="msjValidacionLegajo"></h9>
    </div>
</div>  
        
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail" placeholder="Email" onchange="validarEmail()" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Contraseña</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Contraseña" required>
    </div>
  </div>
    
    <div class="form-row">
     <div class="form-group col-md-6">
      <label for="inputDate">Fecha de nacimiento</label>
      <input id="inputDate" type="date" class="form-control" onkeydown="return false" onchange="validarFechaNac()" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputRole">Rol a registrarse</label>
      <select id="inputRole" class="form-control" required>
          <option selected value="alumno">Alumno</option>  
          <option value="docente">Docente</option>  
      </select>
    </div>
  </div>
    

  
  <button type="submit" class="btn btn-primary">Registrarse</button>
</div>
</form>
</div>

<?php
include "footer.html";
?>