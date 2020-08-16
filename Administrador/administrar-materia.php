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

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
.custom-file-label::after {
    content: "Elegir";
}
</style>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Materias</h1>
        <a href="index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Materia agregada correctamente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>La materia ya se encuentra registrada</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Baja exitosa</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error en la baja</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    
    }

    ?>

    <button class="btn btn-success my-2" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus-square mr-1"></i>Nueva materia</button>
    <button class="btn btn-primary my-2 mx-2" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-upload mr-1"></i>Cargar programa</button>
    <div class="my-2">
        <table id="dataTable" class="table table-info table-bordered table-hover">
            <thead>
                <th>N°</th>
                <th>Nombre materia</th>
                <th>Editar </th>
                <th>Programa Cargado</th>
                <th>Eliminar Materia</th>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDate = date('Y-01-01');          
                $aux=1 ;
                $consulta1 = $con->query("SELECT * FROM `materia` WHERE `fechaBajaMateria` IS NULL  ORDER BY id ASC");
                while ($resultado1 = $consulta1->fetch_assoc()) {
                    $idmateria = $resultado1['id'];
                    $consulta2 = $con->query("SELECT * FROM programamateria WHERE materia_id = '$idmateria' AND fechaVigentePrograma > '$currentDate'");
                    $programa = $consulta2->fetch_assoc();
                    $url = 'bajaMateria.php?id='.$idmateria;
                    $nombreMateria = $resultado1['nombreMateria'];
                    
                    if(($consulta2->num_rows)!==0){
                        $cargado = $programa["descripcionPrograma"];
                    } else {
                        $cargado = "Sin cargar";
                    }

                    echo "<tr>
                    <td>$aux</td>   
                    <td><a href='admcurso.php?id=".$resultado1['id']."'>" . $nombreMateria . "</a></td>
                    <td><button class='btn btn-primary' data-toggle='modal' data-target='#staticBackdrop2'><i class='fa fa-edit'></i></button></td>
                    <td>".$cargado."</td>
                    <td class='text-center'><a class='btn btn-danger btn-sm' data-emp-id=".$idmateria." onclick='return confirmDelete()' href='$url'><i class='fa fa-trash'></i></a></td>
                    </tr>";
                   
                   
                    $aux++ ;
                    
                }
                
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Crear nueva materia-->
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

                </div>
            </form>
        </div>
    </div>
    </div>

<!-- Modal Editar Materia-->
<div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar materia</h5>
            </div>
            <form method="POST" id="insertMateria" name="insertMateria" action="editarMateria.php" enctype="multipart/form-data" role="form">
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
    
                </div>
            </form>
        </div>
    </div>
    </div>
    
  <!-- Modal Cargar Programa-->
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
                            $nombreMateria = utf8_encode($resultado1['nombreMateria']);
                            echo "<option value='".$resultado1['id']."'>" . $nombreMateria . "</option>";

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