<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
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

  <div class="jumbotron my-4 py-4">
    <p class="card-text">Administrador</p>
    <h1><?php echo "$saludo, ".$_SESSION["administrador"]["nombreAdm"] ?></h1>
    
      
    <div class="form-inline">
        <a href="/DayClass/Administrador/EditarPerfil/editarPerfilAdmin.php" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Editar perfil</a>
        <form method="POST" enctype="multipart/form-data" role="form" action="AlumnosLibres/buscarAlumnosLibres.php" class="ml-2">
            <button type="submit" class="btn-dayclass my-3"><i class="fa fa-user-times mr-1"></i>Alumnos libres</button>

        </form>
    </div>
  </div>

  <!-- Page Features -->
  <div class="row text-center">

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="../images/materiasycursos.png" alt="Cursos" oncontextmenu="return false">
        <div class="card-body">

          <h5 class="card-text">Administrar materias y cursos</h5>
        </div>
        <div class="card-footer">
          <a href="/DayClass/Administrador/MateriaCurso/Materia/admMateria.php" class="btn btn-primary">Ingresar</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top imagen" src="../images/estadisticas.png" oncontextmenu="return false" alt="Estadisticas">
        <div class="card-body">
          <h5 class="card-text">Generar estadísticas</h5>
        </div>
        <div class="card-footer">
          <a href="/DayClass/Administrador/Estadisticas/estadistica_curso.php" class="btn btn-primary">Ingresar</a>
        </div>
      </div>
    </div>    

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top imagen" src="../images/reportes1.png" oncontextmenu="return false" alt="Reportes">
        <div class="card-body">
          <h5 class="card-text">Generar reportes </h5>
        </div>
        <div class="card-footer">
          <a href="/DayClass/Administrador/Reportes/indexReporteAsistencia.php" class="btn btn-primary">Ingresar</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="../images/justificativo.png" oncontextmenu="return false" alt="Justificativos">
        <div class="card-body">
          <h5 class="card-text">Evaluar justificativos</h5>
        </div>

        <div class="card-footer">
          <a href="/DayClass/Administrador/Justificativos/validar_justificativos.php" class="btn btn-primary">Ingresar</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../footer.html";
?>