<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

date_default_timezone_set('America/Argentina/Buenos_Aires');
$hora = date('H:i:s');
if($hora >= date('06:00:00') && $hora < date('12:00:00')) {
  $saludo = "Buenos días";
} elseif($hora >= date('12:00:00') && $hora < date('20:00:00')){
  $saludo = "Buenas tardes";
} else{
  $saludo = "Buenas noches";
}

?>

<div class="container">

  <div class="jumbotron my-4 py-4 bg-light">
    <h1 class=""><?php echo "$saludo, ".$_SESSION["alumno"]["nombreAlum"]/*." ".$_SESSION["alumno"]["apellidoAlum"]*/ ?></h1>
    <p class="lead"></p>
    <a href="/Dayclass/Alumno/editar_perfil.php" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Editar perfil</a>
  </div>

     <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Codigo de asistencia ingresado correctamente, se ha registrado tu presente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El codigo ingresado no existe</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El tiempo del codigo se ha agotado</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Se ingreso un codigo para un curso en el que no estas incripto</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                 case 5:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Falla al cargar el codigo, consulte con el administrador</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 6:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Actualemnte estas libre en esta materia, no puedes registrar asistencia</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;

            }
    }

    ?>

    
    
  <div class="row text-center">

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="../images/materias.png" alt="" oncontextmenu="return false">
        <div class="card-body">
          <h4 class="card-title">Materias</h4>
          <p class="card-text">Que cursa actualmente</p>
        </div>
        <div class="card-footer">
          <a href="materiasAlumno.php" class="btn btn-primary">Ver</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top imagen" src="../images/asistencias.png" alt="" oncontextmenu="return false">
        <div class="card-body">
          <h4 class="card-title">Asistencias</h4>
          <p class="card-text">Concurrencia al aula</p>
        </div>
        <div class="card-footer">
          <a href="/DayClass/Alumno/Asistencias/asistencias.php" class="btn btn-primary">Ver</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="../images/justificativos.png" alt="" oncontextmenu="return false">
        <div class="card-body">
          <h4 class="card-title">Justificativos</h4>
          <p class="card-text">Carga y consulta de justificativos pendientes</p>
        </div>

        <div class="card-footer">
          <a href="/DayClass/Alumno/Justificativos/justificativos.php" class="btn btn-primary">Ver</a>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="alumno.js"></script>

<?php
include "modal-autoasistencia.php";
?>

<?php
include "../footer.html";
?>