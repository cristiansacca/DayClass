<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo'])&&isset($_SESSION['limite'])) {

  //Calculamos tiempo de vida inactivo.
  $vida_session = time() - $_SESSION['tiempo'];

  //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
  if($vida_session > $_SESSION['limite'])
  {
      //Removemos sesión.
      session_unset();
      //Destruimos sesión.
      session_destroy();              
      //Redirigimos pagina.
      header("Location: /DayClass/index.php?resultado=3");

      exit();
  }
}
$_SESSION['tiempo'] = time();

?>
<style>
  .custom-file-label::after {
    content: "Elegir";
  }
</style>
<div class="container">
    <div class="py-4 my-3 jumbotron bg-light">
        <h1>Justificativos</h1>
        <a class="btn btn-info" href="/DayClass/Alumno/index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
    </div>

    <?php
      if(isset($_GET['resultado'])) {
        $resultado = $_GET['resultado'];
        if($resultado == 1){

          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <h5><i class='fa fa-exclamation-circle mr-2'></i>Se cargó el justificativo correctamente</h5>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
          </div>";

        } else {

          echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al cargar el justificativo</h5>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
          </div>";

        }
      }
    ?>

  <form enctype="multipart/form-data" action="cargaJustificativo.php" method="POST">
    <h4>Cargar justificativo de inasistencias</h4>
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-6 my-2">
        <div class="my-2">
          <label>Seleccione la imagen del justificativo:</label>
          <div class="custom-file my-2">
            <input id="imgJustificativo" name="imgJust" type="file" accept="image/*" class="custom-file-input" required>
            <label for="imgJustificativo" class="custom-file-label">Elija el justificativo</label>
          </div>
        </div>
        <div class="my-2">
          <label for="materias">Seleccione las materias que correspondan:</label><br>
          <h9 id="msgMaterias"></h9>
          <div class="form-group" id="materias">
            <?php
              include "../../databaseConection.php";

              //Busca todas las instanias de AlumnoCursoActual que están asociadas al alumno que ingresó
              $consulta1 = $con->query("SELECT * FROM alumnocursoactual WHERE alumno_id = '".$_SESSION['alumno']['id']."'");
              
              while ($alumnocursoactual = $consulta1->fetch_assoc()) {
                  
                //Por cada instancia de AlumnoCursoActual se obtiene el curso asociado
                  $curso = $con->query("SELECT * FROM curso WHERE id = '".$alumnocursoactual['curso_id']."'")->fetch_assoc();

                  echo "<div>
                  <input class='checkMateria' type='checkbox' onchange='validar_checkbox()' name='materia[]' value='".$curso['id']."'><label class='m-2'>".$curso['nombreCurso']."</label>
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
              <input type="date" id="fechaDesde" name="fechaDesde" onchange="validarFechasJustificativo();" class="form-control mr-2"
                <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'"?> required>
              <h9 id="msgDesde"></h9>
            </div>
            <div class="form-inline my-2">
              <label style="margin-right: 1.2rem;" for="fechaHasta">Hasta:</label>
              <input type="date" id="fechaHasta" name="fechaHasta" onchange="validarFechasJustificativo();" class="form-control mr-2"
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
    <h4>Estado de tus justificativos</h4>
    <div id="pendientes">
      <?php
        $consulta2 = $con->query("SELECT * FROM justificativo WHERE alumno_id ='".$_SESSION['alumno']['id']."' ORDER BY fechaPresentacion");
        if(!$consulta2->num_rows == 0){
          echo "<table class='table table-bordered table-info table-hover'>
          <thead>
            <th>Imagen</th>
            <th>Fecha de presentación</th>
            <th>Fecha de revisión</th>
            <th>Estado</th>
            <th>Comentario</th>
          </thead>
          <tbody>";
          while($justificativo = $consulta2->fetch_assoc()){
            $estado = 'No revisado';
            $colorTexto = '';
            if(!$justificativo['fechaRevision'] == null){
              if($justificativo['aprobado'] == true){
                $estado = 'APROBADO';
                $colorTexto = 'text-success';
              } else {
                $estado = 'RECHAZADO';
                $colorTexto = 'text-danger';
              }
            }

            if($justificativo['fechaRevision'] == null){
              $fechaRevision = 'No revisado';
            } else {
              $fechaRevision = strftime("%d/%m/%Y", strtotime($justificativo['fechaRevision']));
            }

            echo "<tr>
              <td><a href='verImgJustificativo.php?id=".$justificativo['id']."'>".$justificativo['descripcionImagen']."</a></td>
              <td>".strftime("%d/%m/%Y", strtotime($justificativo['fechaPresentacion']))."</td>
              <td>".$fechaRevision."</td>
              <td class=$colorTexto ><b>".$estado."</b></td>
              <td>".$justificativo['comentarioJustificativo']."</td>
            </tr>";
          }
          echo "</tbody></table>";
        } else {
          echo "<div class='alert alert-warning' role='alert'>No tenés justificativos cargados</div>";
        }
      ?>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../alumno.js"></script>

<?php
include "../modal-autoasistencia.php";
?>

<?php
include "../../footer.html";
?>