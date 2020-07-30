<?php
include "../header.html";

//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>

<div class="container">

  <div class="jumbotron my-4">
    <p class="card-text">Administrador</p>
    <h3 class="">Bienvenido<?php echo " ".$_SESSION["administrador"]["nombreAdm"] ?></h3>
    <p class="lead"></p>
    <a href="editar_perfil.php" class="btn btn-primary btn-lg">Ver Perfil</a>
  </div>

  <!-- Page Features -->
  <div class="row text-center">

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="../images/admCursos.png" alt="Cursos" oncontextmenu="return false">
        <div class="card-body">

          <h6 class="card-text">Administrar materias y cursos</h6>
        </div>
        <div class="card-footer">
          <a href="/DayClass/Administrador/administrar-materia.php" class="btn btn-primary">Ir</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top imagen" src="../images/reportes.png" oncontextmenu="return false" alt="Estadisticas">
        <div class="card-body">
          <h6 class="card-text">Generar estadísticas </h6>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop15">Ir</a>
        </div>
      </div>
    </div>   

 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop15" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
      aria-labelledby="staticBackdropLabel2" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title col-12" id="staticBackdropLabel2">Selecione opción de estadísticas: </h5>
          </div>
          <div class="modal-body text-center  ">

            <div class="input-group text m-auto">

              <form name="estadisticaadmin"  action="" class="m-auto">
                <input type="radio" id="curso" name="tipo1" value="curso">
                <label for="curso">Curso</label><br>
                <input type="radio" id="materia" name="tipo1" value="materia">
                <label for="alumno">Materia</label><br>
              </form>

            </div>

          </div>

          <div class="modal-footer m-auto">
            <button type="button" class="btn btn-success " id="btnconfirmarestadistica" data-dismiss="modal">Aceptar</button>
            <button type="button" class="btn btn-danger" id="btncancelarestadistica" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
 

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top imagen" src="../images/reportes.png" oncontextmenu="return false" alt="Reportes">
        <div class="card-body">
          <h6 class="card-text">Generar reportes </h6>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Ir</a>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title col-12" id="staticBackdropLabel">Selecione opción de reporte </h5>
          </div>
          <div class="modal-body text-center  ">

            <div class="input-group text m-auto">

              <form name="reporteadmin" action="" class="m-auto">
                <input type="radio" id="curso" name="tipo" value="curso">
                <label for="curso">Curso</label><br>
                <input type="radio" id="alumno" name="tipo" value="alumno">
                <label for="alumno">Alumno</label><br>
              </form>

            </div>

          </div>

          <div class="modal-footer m-auto">
            <button type="button" class="btn btn-success " id="btnconfirmar" data-dismiss="modal">Aceptar</button>
            <button type="button" class="btn btn-danger" id="btncancelar" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="../images/justificativos.png" oncontextmenu="return false" alt="Justificativos">
        <div class="card-body">
          <h6 class="card-text">Evaluar justificativos</h6>
        </div>

        <div class="card-footer">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop1">Ir</a>
        </div>
      </div>
    </div>
  </div>

</div>

  <!-- Modal -->
    <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modalidad para validar justificativos:</h5>
          </div>
          <div class="modal-body">

            <select id="modalidadseleccionado" class="custom-select my-3 ">
              <option selected> Seleccione una modalidad </option>
              <option value="1">Modalidad 1</option>
              <option value="2">Modalidad 2</option>
              <option value="3">Modalidad 3</option>
            </select>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-success"  id="btnaceptar" data-dismiss="modal">Aceptar</button>
            <button type="button" class="btn btn-danger"  id="btncancelar" data-dismiss="modal"> Cancelar </button>
          </div>
        </div>
      </div>
    </div>

    <script src="administrador.js"></script>

    <?php
include "../footer.html";
?>