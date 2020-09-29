<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
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
  
if(isset($_GET["id_curso"])){
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
} else {
    header("location:/DayClass/Profesor/index.php");
}
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<script src="../profesor.js"></script>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1> Estadística de asistencias</h1>
        <h4 class="font-weight-normal my-2"><?php echo $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'" ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <div class="alert alert-danger" role="alert" id="faltanDatos" hidden>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Faltan datos por completar</h5>
    </div>

    <div class="row my-2">
        <div class="col-md-6">
            <div class="my-2">
                <label for="fechaDesde" class="mr-2">Desde:</label><label class="text-danger" id="msgPeriodoDesde"></label>
                <input type="date" id="fechaDesde" class="form-control inputPeriodo" onchange="habilitarSegundaFecha()" <?php echo "max='$currentDate'" ?>>
            </div>
            <div class="my-2">
                <label for="fechaHasta" class="mr-2">Hasta:</label><label class="text-danger" id="msgPeriodoHasta"></label>
                <input type="date" id="fechaHasta" class="form-control inputPeriodo" onchange="validarPeriodo();" <?php echo "max='$currentDate'" ?> disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="my-2">
                <label class="mr-2">Tipo de gráfico:</label>
                <select class="custom-select" id="tipoGrafico">
                    <option value="pie">Gráfico de torta</option>
                    <option value="bar">Gráfico de barras</option>
                    <option value="doughnut">Gráfico de rosca</option>
                </select>
            </div>
        </div>
        <input type="text" id="curso" <?php echo "value='$id_curso'" ?> hidden>
    </div>

    <button class="btn btn-primary mt-2 mr-2" id="btnGenerar" disabled><i class="fa fa-pie-chart mr-1"></i>Generar</button>
    <button class="btn btn-secondary mt-2 mr-2" id="btnLimpiar" hidden><i class="fa fa-eraser mr-1"></i>Limpiar</button>

    <div class="my-4">
        <div class="card ">
            <div class="card-header">
                <b> Datos de la estadística </b>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action font-weight-bold">Curso:<label class="ml-1 font-weight-normal" id="txtCurso"></label></li>
                    <li class="list-group-item list-group-item-action font-weight-bold">Fecha y hora:<label class="ml-1 font-weight-normal" id="fechaHora"></label></li>
                    <li class="list-group-item list-group-item-action font-weight-bold">Periodo:<label class="ml-1 font-weight-normal" id="periodo"></label></li>
                    <li class="list-group-item list-group-item-action font-weight-bold">Presentes:<label class="ml-1 font-weight-normal" id="cantPresentes"></label></li>
                    <li class="list-group-item list-group-item-action font-weight-bold">Ausentes:<label class="ml-1 font-weight-normal" id="cantAusentes"></label></li>
                    <li class="list-group-item list-group-item-action font-weight-bold">Justificados:<label class="ml-1 font-weight-normal" id="cantJustificados"></label></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="jumbotron py-2 my-2">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script src="estadisticas.js"></script>

<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/TemaDia/temaDelDia.php?id_curso=" . $id_curso . "><i id=icono ></i>Tema del día</a>';";?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['profesor']['nombreProf'] . " " . $_SESSION['profesor']['apellidoProf'] . "'" ?>
</script>
<?php
include "../../footer.html";
?>