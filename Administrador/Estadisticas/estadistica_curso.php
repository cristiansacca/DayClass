<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

//-----------------------------------------------------------------------------------------------------------------------------

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
$consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."'");

$consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 10")->fetch_assoc(); // <-- Cambia
$idFuncionNecesaria = $consultaFuncionNecesaria['id'];

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

$funcionCorrecta = false;
while ($fn = $consultaFunciones->fetch_assoc()) {
    if ($fn['id_funcion'] == $idFuncionNecesaria) {
        $funcionCorrecta = true;
        break;
    }
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

  

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1> Estadística de asistencias</h1>
        <a href="/DayClass/Administrador/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <div class="alert alert-danger" role="alert" id="faltanDatos" hidden>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Faltan datos por completar</h5>
    </div>

    <div class="row my-2">
        <div class="col-md-6">
            <div class="my-2">
                <label>Materia:</label><br>
                <select class="custom-select" id="materia">
                    <option value="" selected>Seleccione</option>
                    <?php
                    $conMat = $con->query("SELECT * FROM materia WHERE fechaBajaMateria IS NULL");
                    while ($materias = $conMat->fetch_assoc()) {
                        echo "<option value='" . $materias['id'] . "'>" . $materias['nombreMateria'] . " (Nivel " . $materias['nivelMateria'] . ")</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="my-2">
                <label>Curso:</label><br>
                <select class="custom-select" id="curso" disabled>
                    <option value="" selected>Seleccione</option>
                </select>
            </div>
            <div>
                <label class="mr-2">Tipo de gráfico:</label>
                <select class="custom-select" id="tipoGrafico">
                    <option value="pie">Gráfico de torta</option>
                    <option value="bar">Gráfico de barras</option>
                    <option value="doughnut">Gráfico de rosca</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="my-2">
                <label for="fechaDesde" class="mr-2">Desde:</label><label class="text-danger" id="msgPeriodoDesde"></label>
                <input type="date" id="fechaDesde" class="form-control inputPeriodo" onchange="validarPeriodo();">
            </div>
            <div class="my-2">
                <label for="fechaHasta" class="mr-2">Hasta:</label><label class="text-danger" id="msgPeriodoHasta"></label>
                <input type="date" id="fechaHasta" class="form-control inputPeriodo" onchange="validarPeriodo();" <?php echo "max='$currentDate'" ?>>
            </div>
        </div>
    </div>

    <section id="estadistica">
        <button class="btn btn-primary my-2 mr-2" id="btnGenerar" disabled><i class="fa fa-pie-chart mr-1"></i>Generar</button>
        <button class="btn btn-secondary mt-2 mr-2" id="btnLimpiar" hidden><i class="fa fa-eraser mr-1"></i>Limpiar</button>
        <div class="my-4" id="oculto" hidden>
            <div class="card ">
                <div class="card-header">
                    <h5> Datos de la estadística </h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action font-weight-bold">Materia:<label class="ml-1 font-weight-normal" id="txtMateria"></label></li>
                        <li class="list-group-item list-group-item-action font-weight-bold">Curso:<label class="ml-1 font-weight-normal" id="txtCurso"></label></li>
                        <li class="list-group-item list-group-item-action font-weight-bold">Fecha y hora:<label class="ml-1 font-weight-normal" id="fechaHora"></label></li>
                        <li class="list-group-item list-group-item-action font-weight-bold">Periodo:<label class="ml-1 font-weight-normal" id="periodo"></label></li>
                        <li class="list-group-item list-group-item-action font-weight-bold">Presentes:<label class="ml-1 font-weight-normal" id="cantPresentes"></label></li>
                        <li class="list-group-item list-group-item-action font-weight-bold">Ausentes:<label class="ml-1 font-weight-normal" id="cantAusentes"></label></li>
                        <li class="list-group-item list-group-item-action font-weight-bold">Justificados:<label class="ml-1 font-weight-normal" id="cantJustificados"></label></li>
                        <li class="list-group-item list-group-item-action font-weight-bold">Gráfico:<canvas id="myChart"></canvas></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="../administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>
<script src="estadisticas.js"></script>
<?php
include "../../footer.html";
?>