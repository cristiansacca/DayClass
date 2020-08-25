<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

$id_admin = $_SESSION['administrador']["id"];

$consulta1 = $con->query("SELECT `legajoAdm`,`apellidoAdm`,`nombreAdm`,`dniAdm`, `emailAdm`, `fechaNacAdm`, `id` FROM `administrativo` WHERE id = '$id_admin'");
$resultado1 = $consulta1->fetch_assoc();

$_SESSION['administrador']= $resultado1;


?>

<script src="administrador.js"> </script>

<div class="container">
      
  <div class="jumbotron my-4 py-4">
      <p class="card-text">Administrador</p>
      
      <h5>Editar Curso</h5>
      
      <?php
            include "../databaseConection.php";
            $id_curso = $_GET['id'];
            
            $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
            $resultado = $consultaCurso->fetch_assoc();
            $fchDesde = $resultado["fechaDesdeCursado"];
            $fchHasta = $resultado["fechaHastaCursado"];
            $nombreCurso = $resultado["nombreCurso"];
        
            echo "<h1>$nombreCurso</h1>";
            
            //echo "<h6>Inicio del curso: ".strftime('%d/%m/%Y', strtotime($fchDesde))."</h6>";
            //echo "<h6>Finalización de curso: ".strftime('%d/%m/%Y', strtotime($fchHasta))."</h6>";
        
        ?>
      
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
    <form method="post" id="editarAdmin" name="editarAdmin" action="actualizarDatosAdmin.php" onsubmit="return validarRepeticion()" enctype="multipart/form-data" role="form">
      <div class="fill_fields">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName4">Inicio Cursado:</label>
            <input type="date" class="form-control" id="inputInicioCursado" name="inputInicioCursado" placeholder="Fecha Inicio Cursado" required <?php echo "value='".$fchDesde."'"; ?>>
            <h9 class="msg" id="msjValidacionNombre"></h9>
          </div>
         
            <div class="form-group col-md-6">
            <label for="inputSurname4">Fin Cursado:</label>
            <input type="date" class="form-control" id="inputFinCursado" name="inputFinCursado" placeholder="Fecha Fin Cursado" required <?php echo "value='".$fchHasta."'"; ?>>
            <h9 class="msg" id="msjValidacionApellido"></h9>
          </div>
        </div>

        <input type="submit" value="Guardar cambios" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>

  <?php
include "../footer.html";
?>