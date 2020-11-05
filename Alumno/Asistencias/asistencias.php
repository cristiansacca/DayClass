<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../header.html"; // <-- Cambia
include "../../databaseConection.php"; // <-- Cambia

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 18")->fetch_assoc(); // <-- Cambia
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<div class="container">
    
    <div class="py-4 my-3 jumbotron">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Información de asistencias</h1>
        <a class="btn btn-info" href="/DayClass/Index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
    </div>
    <div class="form-group">
        <?php
        include "../../databaseConection.php";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');

        //Busca todas las instanias de AlumnoCursoActual que están asociadas al alumno que ingresó
        $consulta1 = $con->query("SELECT * FROM alumnocursoactual WHERE alumno_id = '" . $_SESSION['usuario']['id'] . "' AND `fechaDesdeAlumCurAc` <= '$currentDateTime' AND  `fechaHastaAlumCurAc` >= '$currentDateTime'");

        if (($consulta1->num_rows) == 0) {
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no esta inscripto a ninguna materia.</h5>
                </div>";
        } else {

            echo "<h5>Curso</h5>";
            echo "<select id='materias' class='custom-select'>";
            while ($alumnocursoactual = $consulta1->fetch_assoc()) {

                //Por cada instancia de AlumnoCursoActual se obtiene el curso asociado
                $curso = $con->query("SELECT * FROM curso WHERE id = '" . $alumnocursoactual['curso_id'] . "'")->fetch_assoc();

                echo "<option value='" . $curso['id'] . "'>" . $curso['nombreCurso'] . "</option>";
            }
            echo "</select>";
        }
        ?>

    </div>

    <div id="alertAsistencias" hidden>
        <div class='alert alert-warning'>
            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no hay datos de asistencias para esta materia.</h5>
        </div>
    </div>

    <div class="form-inline" id="graficosAsistencias">
        <div class="col-md-6 mb-2">
            <div class="jumbotron py-4">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="jumbotron py-4">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <div id="faltasDisponibles">

    </div>

    <div id="tablaAsistenciasCompleta" class="table-responsive">
        <h5>Asistencia por día</h5>
        <table class="table table-bordered text-center table-secondary table-sm" id="dataTable">
            <thead>
                <th>Fecha y hora</th>
                <th>Asistencia</th>
            </thead>
            <tbody id="tablaAsistencias">

            </tbody>
        </table>
    </div>
</div>
<input type="text" id="id_alumno" <?php echo "value='" . $_SESSION['usuario']['id'] . "'"; ?> hidden>
<button class="btn btn-danger mt-2 mr-2" id="btnLimpiar" hidden><i class="fa fa-eraser mr-1"></i>Limpiar graficos</button>
<button class="btn btn-warning mt-2 mr-2" id="btnLimpiarDT" hidden><i class="fa fa-eraser mr-1"></i>Limpiar DataTable</button>


<script src="../alumno.js"></script>
<script src="fnAsistenciasAlumno.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
  <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>