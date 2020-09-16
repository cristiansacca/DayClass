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
        <h1>Materias</h1>
        <a href="/DayClass/Administrador/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Materia agregada correctamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>La materia ya se encuentra registrada.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Baja exitosa.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error en la baja.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    
    }

    ?>

    <button class="btn btn-success my-2" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus-square mr-1"></i>Nueva materia</button>
    <div class="my-2">
        <table id="dataTable" class="table table-info table-bordered table-hover">
            <thead>
                <th>Nombre materia</th>
                <th>Nivel</th>
                <th>Programa</th>
                <th>Ver</th>
                <th>Eliminar</th>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDate = date('Y-m-d');          
                $consulta1 = $con->query("SELECT * FROM `materia` WHERE `fechaBajaMateria` IS NULL  ORDER BY id ASC");
                while ($resultado1 = $consulta1->fetch_assoc()) {
                    $idmateria = $resultado1['id'];
                    
                    $consulta2 = $con->query("SELECT * FROM programamateria WHERE materia_id = '$idmateria' AND fechaDesdePrograma <= '$currentDate' AND fechaHastaPrograma IS NULL");                    
                    $programa = $consulta2->fetch_assoc();
                    $url = 'bajaMateria.php?id='.$idmateria;
                    $nombreMateria = $resultado1['nombreMateria'];
                    $nivelMateria = $resultado1['nivelMateria'];
                    
                    if(($consulta2->num_rows)!=0){
                        $cargado = "Cargado";
                    } else {
                        $cargado = "Sin cargar";
                    }
                    
                    
                    $classHabilitado = "btn btn-danger btn-sm mb-1";
                    
                    $consultaCursosMateria = $con->query("SELECT curso.id AS idCurso, curso.fechaDesdeCursado, curso.fechaHastaCursado FROM curso, materia WHERE materia.id = '$idmateria' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado > '$currentDate'"); 
                    
                    if(mysqli_num_rows($consultaCursosMateria) != 0 ){
                         while ($cursosMateria = $consultaCursosMateria->fetch_assoc()){
                             $idCurso = $cursosMateria["idCurso"];
                             $fechaDesdeCursado = $cursosMateria["fechaDesdeCursado"];
                             $fechaHastaCursado = $cursosMateria["fechaHastaCursado"];
                             
                             $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaDesdeCursado' AND `fechaHastaAlumCurAc` = '$fechaHastaCursado'  AND `curso_id` = '$idCurso' ");
                             
                             if(mysqli_num_rows($consultaAlumnos) != 0 ){
                                $classHabilitado = "btn btn-danger btn-sm mb-1 disabled";
                                break;
                            }
                         }
                    }
                    
                    
                    
                    echo "<tr>
                    <td><a href='/DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=".$resultado1['id']."'>" . $nombreMateria . "</a></td>
                    <td>$nivelMateria</td>
                    <td>".$cargado."</td>
                    <td class='text-center'><a class='btn btn-primary' href='/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$idmateria'><i class='fa fa-eye'></i></a></td>
                    <td class='text-center'><a class='$classHabilitado' data-emp-id=".$idmateria." onclick='return confirmDelete()' href='$url'><i class='fa fa-trash'></i></a></td>
                    </tr>";
                    
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
            <form method="POST" id="insertMateria" name="insertMateria" action="altaMateria.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="inputNombreMateria"> Nombre</label>
                        <input type="text" name="inputNombreMateria" id="inputNombreMateria" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="inputNivel"> Nivel </label>
                        <input type="number" name="inputNivel" id="inputNivel" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="inputNivel"> Cantidad de horas semanales </label>
                        <input type="number" name="inputCargaHoraria" id="inputCargaHoraria" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
                        <button type="submit" class="btn btn-primary" id="btnCrear"> Crear </button>
                    </div>

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