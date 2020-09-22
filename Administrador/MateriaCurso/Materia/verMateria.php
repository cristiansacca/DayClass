<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
include "../../../databaseConection.php";
 
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
        <?php
            $id_materia = $_GET["id"];
            $consultaMateria = $con->query("SELECT * FROM `materia` WHERE id = $id_materia AND `fechaBajaMateria` IS NULL  ORDER BY id ASC");
            $resultadoMateria = $consultaMateria->fetch_assoc();
            $nombreMateria = $resultadoMateria["nombreMateria"];
            $nivelMateria = $resultadoMateria["nivelMateria"];
            $cargaHorariaMateria = $resultadoMateria["cargaHorariaMateria"];
            
            echo "<h1>$nombreMateria</h1>";
            echo "<h4>Nivel: $nivelMateria</h4>";
            echo "<h4>Horas semanales: $cargaHorariaMateria</h4>";
        
        ?>
        
        <a href="/DayClass/Administrador/MateriaCurso/Materia/admMateria.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <button class="btn btn-success my-2 mx-2" data-toggle="modal" data-target="#staticBackdrop2"><i class="fa fa-pencil-square-o mr-1"></i>Editar Datos</button>
        <button class="btn btn-primary my-2 mx-2" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-upload mr-1"></i>Cargar programa</button>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Programa cargado exitosamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Fallo al cargar el programa.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error en el formato del archivo.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Se registraron los cambios correctamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 5:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error al registrar los cambios.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    
    }

    ?>
    <div>
        
    </div>
    
    
    <div class="jumbotron my-4 py-4">
        <table id="dataTable" class="table table-bordered bg-light table-striped">
        <?php
            $id_materia = $_GET["id"];
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDateTime = date('Y-m-d');
            $currentYear = date('Y');
            
            $consultaPrograma = $con->query("SELECT temasmateria.nombreTema, temasmateria.unidadTema FROM programamateria, materia, temasmateria WHERE materia.id = $id_materia AND materia.id = programamateria.materia_id AND programamateria.fechaDesdePrograma <= '$currentDateTime' AND programamateria.fechaHastaPrograma IS NULL AND programamateria.id = temasmateria.programaMateria_id AND programamateria.anioPrograma = $currentYear ORDER BY temasmateria.id ASC");
        
            if(($consultaPrograma->num_rows) == 0){
                echo "<div class='alert alert-warning' role='alert'>
                        <h5>Todavía no se ha cargado un programa en esta materia para el año en curso.</h5>
                    </div>";
            }else{
                
                echo "<h5>Programa del año: $currentYear</h5>";

                echo "<thead>
                        <th>Unidad</th>
                        <th>Tema</th>
                    </thead>
                    <tbody> ";
                while ($programaMateria = $consultaPrograma->fetch_assoc()) {       
                    $unidad = $programaMateria["unidadTema"];
                    $tema = $programaMateria["nombreTema"];
                    echo "<tr>
                        <td style='width:5%'>" . $unidad . "</td>
                        <td>" . $tema . "</td>
                        </tr>";

                }
                               
                echo " </tbody>";
                                
            }
                    
        ?>
        </table>
        
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
            <form method="POST" id="modifMateria" name="modifMateria" action="modifMateria.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="inputNombreMateria"> Nombre materia</label>
                        <input type="text" name="inputNombreMateria" id="inputNombreMateria" class="form-control" <?php echo "value = '$nombreMateria'";?> required>
                    </div>
                    <div class="my-2">
                        <label for="inputNivel"> Nivel materia </label>
                        <input type="number" name="inputNivel" id="inputNivel" class="form-control" <?php echo "value = '$nivelMateria'";?> required>
                    </div>
                    <div class="my-2">
                        <label for="inputNivel"> Carga Horaria Materia </label>
                        <input type="number" name="inputCargaHoraria" id="inputCargaHoraria" class="form-control" <?php echo "value = '$cargaHorariaMateria'";?> required>
                    </div>
                    
                    <input id="idMateria" name="idMateria" <?php echo "value = '$id_materia'";?> hidden> 
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
                        <button type="submit" class="btn btn-primary" id="btnCrear"> Aceptar </button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Cargar programa de <?php echo "$nombreMateria";?></h5>
        </div>
        <div class="modal-body">
        
        <form method="POST" id="importPlanilla" name="importPlanilla" action="altaProgramaMateria.php" enctype="multipart/form-data" role="form">
                <div class="my-2">
                    <div>
                        <h9>La extensión para la lista debe ser .xlsx y los campos deben estar ordenados como se muestra a continuación: </h9>

                        <table class="table table-bordered text-center table-info table-sm">
                            <thead>
                                <th>Unidad</th>
                                <th>Tema</th>
                            </thead>
                        </table>
                    </div>
                
                    <div class="custom-file my-3">
                        <input type="file" class="form-control-file" name="inpGetFile" id="inpGetFile" accept=".xlsx" onchange="comprobarLista()" lang="es" required>
                    </div>
                </div>
            
                <div class="my-2">
                    <label for="inputDescripPrograma"> Descripción/Nombre</label>
                    <input type="text" name="inputDescripPrograma" id="inputDescripPrograma" class="form-control" required>
                </div>
            
                <div class="my-2">
                    <label for="inputAnioPrograma"> Año del programa</label>
                    <input type="number" name="inputAnioPrograma" id="inputAnioPrograma" class="form-control" <?php echo "value = '$currentYear'";?> required readonly>
                </div>
                
            <input id="idMateria" name="idMateria" <?php echo "value = '$id_materia'";?> hidden> 
            
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  id="btncancelar" data-dismiss="modal"> Cancelar </button>
            <button type="submit" class="btn btn-primary" name="importar" id="btnImportFile">Aceptar</button>
        </div>
    </form>
    </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="../../administrador.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="../../paginadoDataTable.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../../footer.html";
?>