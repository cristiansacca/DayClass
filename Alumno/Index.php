<?php
include "../header.html";
?>

<div class="container">

  <div class="jumbotron my-4">
    <h3 class="">ApellidoUsuario, NombreUsuario</h3>
    <p class="lead"></p>
    <a href="editar_perfil.php" class="btn btn-primary btn-lg">Ver Perfil</a>
  </div>

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
          <a href="asistencias.php" class="btn btn-primary">Ver</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="../images/justificativos.png" alt="" oncontextmenu="return false">
        <div class="card-body">
          <h4 class="card-title">Justificativos</h4>
          <p class="card-text">Carga de justificaciones de inasistencias a clases</p>
        </div>

        <div class="card-footer">
          <a href="carga-justificativo.php" class="btn btn-primary">Ver</a>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
include "modal-autoasistencia.html";
?>

<script src="alumno.js"></script>

<?php
include "../footer.html";
?>