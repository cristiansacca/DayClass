<?php
include "header.html";
?>
<script src="signIn_funciones.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>


<div class="text-center m-auto" style="width:45%; height:55%;">
<form>
<h1 class="title"><u>Registro de nuevo usuario</u></h1>
<h6 class="light_txt">Todos los datos aquí ingresados serán validados contra los ya almacenados por la institución, cualquier falsedad en los mismos conllevará una anulación total de la cuenta, imposibilitando su uso por un período no menor a 10(días) hábiles</h6>
<div class="fill_fields">
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName4">Nombre</label>
      <input type="text" class="form-control" id="inputName" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="inputSurname4">Apellido</label>
      <input type="text" class="form-control" id="inputSurname" placeholder="Apellido">
    </div>
</div>  
        
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputDNI">DNI</label>
      <input type="number" class="form-control" id="inputDNI" placeholder="Documento Nacional de Identidad" onchange="validarDNI()">
    </div>
    <div class="form-group col-md-6">
      <label for="inputLegajo">Legajo</label>
      <input type="number" class="form-control" id="inputSurname" placeholder="Legajo">
    </div>
</div>  
        
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Contraseña</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Contraseña">
    </div>
    <div class="form-group col-md-3">
      <label for="inputUser">Usuario</label>
      <input type="text" class="form-control" id="inputUser" placeholder="Usuario">
    </div>
  </div>
    <div class="form-group">
     <div class="form-group col-md-15">
      <label for="inputDate">Fecha de nacimiento</label>
      <input id="inputDate" type="date" class="form-control">
    </div>
  </div>
  <div class="form-group">
     <div class="form-group col-md-15">
      <label for="inputState">Rol a registrarse</label>
      <select id="inputState" class="form-control">
        <option selected></option>
            <option>Docente</option>
            <option>Alumno</option>
            <option>Administrativo</option>
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