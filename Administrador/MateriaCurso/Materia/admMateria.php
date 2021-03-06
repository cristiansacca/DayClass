<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../../header.html"; // <-- Cambia
include "../../../databaseConection.php"; // <-- Cambia

//-----------------------------------------------------------------------------------------------------------------------------

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 1")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if(!$funcionCorrecta){
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

//-----------------------------------------------------------------------------------------------------------------------------
  
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
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Materias</h1>
        <a href="/DayClass/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Materia agregada correctamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>La materia ya se encuentra registrada.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Baja exitosa.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    
    }

    ?>

    <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus-square mr-1"></i>Nueva materia</button>
    
    <?php
        $cantidadActivos = $con->query("SELECT id FROM materia WHERE fechaBajaMateria IS NULL")->num_rows;
    ?>

    <div class="mt-4">
        <label><?php echo "Existentes: ".$cantidadActivos ?></label>
    </div>
    
    <div class="my-2 table-responsive">
        <?php
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('Y-m-d');          
        $consulta1 = $con->query("SELECT * FROM `materia` WHERE `fechaBajaMateria` IS NULL ORDER BY materia.nombreMateria, materia.nivelMateria ASC");
        
        if(($consulta1->num_rows)!=0){
        echo "<table id='dataTable' class='table table-secondary table-bordered table-hover'>";
            echo "<thead hidden>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Programa</th>
                <th>Acciones</th>
            </thead>";
            echo "<tbody>";
                
                
                while ($resultado1 = $consulta1->fetch_assoc()) {
                    $idmateria = $resultado1['id'];
                    
                    $consulta2 = $con->query("SELECT * FROM programamateria WHERE materia_id = '$idmateria' AND fechaDesdePrograma <= '$currentDate' AND fechaHastaPrograma IS NULL");                    
                    //$programa = $consulta2->fetch_assoc();
                    $url = 'bajaMateria.php?id='.$idmateria;
                    $nombreMateria = $resultado1['nombreMateria'];
                    $nivelMateria = $resultado1['nivelMateria'];
                    
                    if(($consulta2->num_rows)!=0){
                        $cargado = "Programa cargado";
                    } else {
                        $cargado = "Programa sin cargar";
                    }      
                    
                    $classHabilitado = "btn btn-danger mb-1";
                    
                    $consultaCursosMateria = $con->query("SELECT curso.id AS idCurso, curso.fechaDesdeCursado, curso.fechaHastaCursado FROM curso, materia WHERE materia.id = '$idmateria' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado > '$currentDate'"); 
                    
                    if(mysqli_num_rows($consultaCursosMateria) != 0 ){
                         while ($cursosMateria = $consultaCursosMateria->fetch_assoc()){
                             $idCurso = $cursosMateria["idCurso"];
                             $fechaDesdeCursado = $cursosMateria["fechaDesdeCursado"];
                             $fechaHastaCursado = $cursosMateria["fechaHastaCursado"];
                             
                             $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaDesdeCursado' AND `fechaHastaAlumCurAc` = '$fechaHastaCursado'  AND `curso_id` = '$idCurso' ");
                             
                             if(mysqli_num_rows($consultaAlumnos) != 0 ){
                                $classHabilitado = "btn btn-danger mb-1 disabled";
                                break;
                            }
                         }
                    }
                    
                    echo "<tr>
                        <td>" . $nombreMateria . "</td>
                        <td>Nivel $nivelMateria</td>
                        <td>".$cargado."</td>
                        <td class='text-center'>
                            <a class='btn btn-warning mb-1' href='/DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=".$resultado1['id']."'><i class='fa fa-book mr-1'></i>Ver cursos</a>
                            <a class='btn btn-primary mb-1' href='/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$idmateria'><i class='fa fa-university mr-1'></i>Ver materia</a>
                            <a class='$classHabilitado' data-emp-id=".$idmateria." onclick='return confirmDelete()' href='$url'><i class='fa fa-trash mr-1'></i>Baja</a>
                        </td>
                    </tr>";   
                }
        
        
        echo "</tbody>";
        echo "</table>";
            
        }else{
             echo "<div class='alert alert-warning' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Aún no hay materias creadas.</h5>
                    </div>"; 
        }
                ?>
            
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

<script src="../../administrador.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $("#dataTable").DataTable({
    ordering:false,
    language: {
        processing:     "Procesando...",
        lengthMenu: "Mostrar _MENU_ por página",
        zeroRecords: "No hay coincidencias",
        info: "Página _PAGE_ de _PAGES_",
        infoEmpty: "No se encontraron datos",
        infoFiltered: "(Filtrada de _MAX_ filas)",
        loadingRecords: "Cargando...",
        infoPostFix:    "",
        search: "Buscar:",
        paginate: {
            first: "Primero",
            previous: "Anterior",
            next: "Siguiente",
            last: "Último"
        },
        aria: {
            sortAscending:  ": Ordenar de manera ascendente",
            sortDescending: ": Ordenar de manera descendente"
        }
    }
});
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>

<?php
include "../../../footer.html";
?>