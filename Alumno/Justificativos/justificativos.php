<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../header.html"; // <-- Cambia
include "../../databaseConection.php"; // <-- Cambia

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."'");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 11")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if(!$funcionCorrecta){
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

//-----------------------------------------------------------------------------------------------------------------------------

?>
<style>
  .custom-file-label::after {
    content: "Elegir";
  }
</style>
<div class="container">
    <div class="py-4 my-3 jumbotron">
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

    <div id="sinAusentes" class='alert alert-danger alert-dismissible fade show' role='alert' hidden>
      <h5><i class='fa fa-exclamation-circle mr-2'></i>No se registran inasistencias en el período seleccionado.</h5>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
      </button>
    </div>

  <form enctype="multipart/form-data" action="cargaJustificativo.php" method="POST" onsubmit="return validarAusentes();">
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
            <div>
              <input type='checkbox' onchange='seleccionarTodos();' id='checkTodos'><label class='m-2'>Todas</label>
            </div>
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
              date_default_timezone_set('America/Argentina/Buenos_Aires');
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
              <input type="date" id="fechaDesde" name="fechaDesde" onchange="habilitarSegundaFecha();" class="form-control mr-2"
                <?php echo "max='".date("Y-m-d")."'"?> required>
              <h9 class="text-danger" id="msgDesde"></h9>
            </div>
            <div class="form-inline my-2">
              <label style="margin-right: 1.2rem;" for="fechaHasta">Hasta:</label>
              <input type="date" id="fechaHasta" name="fechaHasta" class="form-control mr-2"
                <?php echo "max='".date("Y-m-d")."'"?> disabled required>
              <h9 class="text-danger" id="msgHasta"></h9>
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
    <div class="table-responsive" id="pendientes">
      <?php
        $consulta2 = $con->query("SELECT * FROM justificativo WHERE alumno_id ='".$_SESSION['alumno']['id']."' ORDER BY fechaPresentacion");
        if(!$consulta2->num_rows == 0){
          echo "<table class='table table-bordered table-secondary table-hover'>
          <thead>
            <th>Imagen</th>
            <th>Fecha de presentación</th>
            <th>Estado</th>
            <th></th>
          </thead>
          <tbody>";
          while($justificativo = $consulta2->fetch_assoc()){
            $estado = 'NO REVISADO';
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

            echo "<tr>
              <td>".$justificativo['descripcionImagen']."</td>
              <td>".strftime("%d/%m/%Y", strtotime($justificativo['fechaPresentacion']))."</td>
              <td class=$colorTexto ><b>".$estado."</b></td>
              <td class='text-center'><a class='btn btn-primary' href='verImgJustificativo.php?id=".$justificativo['id']."'><i class='fa fa-eye mr-1'></i>Ver</a></td>
            </tr>";
          }
          echo "</tbody></table>";
        } else {
          echo "<div class='alert alert-warning' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>No tenés justificativos cargados.</h5></div>";
        }
      ?>
    </div>
  </div>
</div>

<script src="../alumno.js"></script>
<script src="justitificativos.js"></script>

<?php
include "../modal-autoasistencia.php";
?>

<?php
include "../../footer.html";
?>