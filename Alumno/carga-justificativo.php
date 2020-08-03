<?php
include "../header.html";

//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>
<style>
  .custom-file-label::after {
    content: "Elegir";
  }
</style>
<div class="container">
    <div class="py-4 my-3 jumbotron bg-light">
        <h2>Justificativos</h2>
        <a class="btn btn-info" href="/DayClass/Alumno/index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Atras</a>
    </div>
  <form action="#">
    <h4>Cargar justificativo de inasistencias</h4>
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-6 my-2">
        <div class="my-2">
          <label>Seleccione la imagen del justificativo:</label>
          <div class="custom-file my-2">
            <input id="imgJustificativo" type="file" accept="image/*" class="custom-file-input" required>
            <label for="imgJustificativo" class="custom-file-label">Elija el justificativo</label>
          </div>
        </div>
        <div class="my-2">
          <label for="materias">Seleccione las materias que correspondan:</label><br>
          <h9 id="msgMaterias"></h9>
          <div class="form-group" id="materias">
            <?php
              include "../databaseConection.php";

              //Busca todas las instanias de AlumnoCursoActual que están asociadas al alumno que ingresó
              $consulta1 = $con->query("SELECT * FROM alumnocursoactual WHERE alumno_id = '".$_SESSION['alumno']['id']."'");
              $contador = 0;
              
              while ($alumnocursoactual = $consulta1->fetch_assoc()) {
                  
                //Por cada instancia de AlumnoCursoActual se obtiene el curso asociado
                  $curso = $con->query("SELECT * FROM curso WHERE id = '".$alumnocursoactual['curso_id']."'")->fetch_assoc();

                  echo "<div>
                  <input type='checkbox' onchange='validar_checkbox()' name='materia' value='".$curso['id']."'><label class='m-2'>".$curso['nombreCurso']."</label>
                </div>";

              }
            ?>

          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-6 my-2">
        <div class="my-2">
          <label>Seleccione el periodo al que corresponde el justificativo:</label>
          <div class="my-2">
            <div class="form-inline my-2">
              <label style="margin-right: 1rem;" for="fechaDesde">Desde:</label>
              <input type="date" id="fechaDesde" onchange="validarFechasJustificativo();" class="form-control mr-2"
                <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'"?> required>
              <h9 id="msgDesde"></h9>
            </div>
            <div class="form-inline my-2">
              <label style="margin-right: 1.2rem;" for="fechaHasta">Hasta:</label>
              <input type="date" id="fechaHasta" onchange="validarFechasJustificativo();" class="form-control mr-2"
                <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'"?> required>
              <h9 id="msgHasta"></h9>
            </div>
          </div>
        </div>
      </div>
      <div class="container mb-2">
        <button type="submit" id="btnCargar" class="btn btn-primary" disabled><i class="fa fa-upload pr-1"></i>Cargar</button>
      </div>
    </div>
  </form>
  <div class="my-2">
    <h4>Justificativos pendientes de confirmación</h4>
    <div id="pendientes">
      <div class="alert alert-info" role="alert">
        No tenés justificativos pendientes de confirmación
      </div>
    </div>
  </div>
</div>

<?php
include "modal-autoasistencia.html";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="alumno.js"></script>

<?php
include "../footer.html";
?>