<?php
include "../header.html";
?>

<div class="container">

    <div class="jumbotron my-4">
      <h3 class=>ApellidoUsuario, NombreUsuario</h3>
      <p class="lead"></p>
      <a href="#" class="btn btn-primary btn-lg">Ver Perfil</a>
    </div>

    <!-- Page Features -->
    <div class="row text-center">

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="../images/Banner-cursos (2).png" alt="">
          <div class="card-body">
            <h4 class="card-title">Cursos</h4>
            <p class="card-text">en los que esta inscripto actualmente</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Ver</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top imagen" src="../images/l_1527842247.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Asistencias</h4>
            <p class="card-text">Concurrencia al aula</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Ver</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="../images/maxresdefault.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Justificativos</h4>
            <p class="card-text">Carga de justificaciones de inasistencias a clases</p>
          </div>

          <div class="card-footer">
            <a href="#" class="btn btn-primary">Ver</a>
          </div>
        </div>
      </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">AutoAsistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class=" text-center my-3 mx-4 form-row">
          <div class="form-group col-12 " >
            <h3>Ingrese el código dado por el profesor</h3><br>
            <h6 class="text-muted">Sin guiones ni espacios</h6>
            <input type="text"  class="form-control m-auto " style="width: 230px; font-size: large; border-width: 4px;">
            <input type="button" class="btn btn-lg btn-secondary my-3" value="Dar Presente" style=" background-color: mediumpurple; border-color: mediumpurple">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="alumno.js"></script>

<?php
include "../footer.html";
?>