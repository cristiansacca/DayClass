<?php
include "../../header.html";
?>

<div class="text-center m-auto" style="width:45%; height:55%;">

 <form method="#" id="importPlanilla" name="importPlanilla" action="#" 
 enctype="multipart/form-data" role="form" >
     <h1>Importar Lista de alumnos</h1>
  <div class="container" style="margin-top:50px;">
     
    <div class="custom-file">
        <input type="file" class="custom-file-input" required name="name" id="name" accept=".xlsx" onchange="comprobar()" lang="es">
        
        <label class="custom-file-label" for="validatedCustomFile">Seleccionar archivo</label>
        
  </div>
         <!-- la funcion comrobar esta en funciones_import_planillaAlumnos.js -->
        <br>
        <br>
    <button name="importar" type="submit" class="btn btn-lg btn-secondary my-3" style="background-color: mediumpurple; border-color: mediumpurple" disabled= true >Importar Datos</button>
        
    
     </div>
</form>

</div>
<script src="funciones_import_planillaAlumnos.js"></script> 
<script src="../administrador.js"></script>

<?php
include "../../footer.html";
?>