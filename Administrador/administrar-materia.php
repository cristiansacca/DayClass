<?php
include "../header.html";
include "../databaseConection.php";
//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
.custom-file-label::after {
    content: "Elegir";
}
</style>

<div class="container">
    <h1 class="display-4">Materias</h1>
    <button class="btn btn-success my-3" data-toggle="modal" data-target="#staticBackdrop1">Nueva materia</button>
    <button class="btn btn-success my-3" data-toggle="modal" data-target="#staticBackdrop">Cargar Programa</button>
    <div class="my-2">
        <table id="dataTable" class="table table-info table-bordered table-hover">
            <thead>
                <th>N°</th>
                <th>Nombre materia</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Programa Cargado</th>
            </thead>
            <tbody>
                <?php
                
                $aux=1 ;
                $consulta1 = $con->query("SELECT `nombreMateria`,`id` FROM `materia` ORDER BY id ASC");
                while ($resultado1 = $consulta1->fetch_assoc()) {
                    $idmateria = $resultado1['id'];
                    $consulta2 = $con->query("SELECT * FROM `programamateria` WHERE materia_id= '$idmateria'");
                    $programa = $consulta2->fetch_assoc();
                    echo "<tr>
                    <td>$aux</td>
                      
                    <td><a href='admcurso.php?id=".$resultado1['id']."'>" . $resultado1['nombreMateria'] . "</a></td>
                    <td>Habilitada</td>
                    <td><button class='btn btn-primary'><i class='fa fa-edit'></i></button></td>

                    <td>".$programa['descripcionPrograma'] . "</td>

                    </tr>";
                   
                    $aux++ ;
                    
                }
                
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva materia</h5>
            </div>
            <form method="POST" id="insertMateria" name="insertMateria" action="insertMateria.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="inputNombreMateria"> Nombre materia</label>
                        <input type="text" name="inputNombreMateria" id="inputNombreMateria" class="form-control">
                    </div>
                    <div class="my-2">
                        <label for="inputNivel"> Nivel materia </label>
                        <input type="number" name="inputNivel" id="inputNivel" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                        <button type="submit" class="btn btn-success" id="btnCrear"> Confirmar </button>
                    </div>
            </form>
                </div>
        </div>
    </div>
    </div>
    
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Cargar programa de materia</h5>
          </div>
          <div class="modal-body">
          
          <form method="POST" id="importPlanilla" name="importPlanilla" action="import_temas.php" enctype="multipart/form-data" role="form">
                <div class="my-2">    
                    <label for="materias">Seleccione la materia:</label>
                    <select name="selectmaterias" id="selectmaterias" class="custom-select">
                    <?php
                        include "../databaseConection.php";
                        //Busca todas las instanias de materias
                        $consulta1 = $con->query("SELECT `nombreMateria`,`id` FROM `materia` ORDER BY id ASC");
                        while ($resultado1 = $consulta1->fetch_assoc()) {
                            echo "<option value='".$resultado1['id']."'>" . $resultado1['nombreMateria'] . "</option>";

                        }
                    ?>
                    </select>
                 </div>
                    <div class="my-2">
                        <label for="inputDescripPrograma"> Descripcion/Nombre</label>
                        <input type="text" name="inputDescripPrograma" id="inputDescripPrograma" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="inputAnioPrograma"> Año del programa</label>
                        <input type="text" name="inputAnioPrograma" id="inputAnioPrograma" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="inputCargaHoraria"> Carga horaria de la materia</label>
                        <input type="text" name="inputCargaHoraria" id="inputCargaHoraria" class="form-control" required>
                    </div>
                    <br>
                    <div class="my-2">
                        <h6>Cargar los temas del programa de</h6>
                        <h9>La extension para la lista debe ser .xlsx y en la primera columna debe estar el listado de los temas </h9>
                        <br>
                    </div>
                    <div class="custom-file my-3">
                        <input type="file" class="form-control-file" name="inpGetFile" id="inpGetFile" accept=".xlsx" onchange="comprobarLista()" lang="es" required>
                    
                    </div>
                </div>
              <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="importar" id="btnImportFile"  >Aceptar</button>
            <button type="button" class="btn btn-danger"  id="btncancelar" data-dismiss="modal"> Cancelar </button>
          </div>
        </form>
        </div>
      </div>
    </div>
   


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="administrador.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="paginadoDataTable.js"></script>







    <?php
include "../footer.html";
?>