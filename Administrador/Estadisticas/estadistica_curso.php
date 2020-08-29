<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

include "../../databaseConection.php";
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1> Estadística de asistencias</h1>
        <a href="/DayClass/Administrador/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <div class="row my-2">
        <div class="col-lg-6 col-md-6 mb-6">
            <label>Modalidad:</label><br>
            <select class="custom-select" id="modalidad">
                <option value="" selected>Seleccione</option>
                <option value="TODAS">TODAS</option>
                <?php
                include "../../databaseConection.php";
                $conMod = $con->query("SELECT * FROM modalidad WHERE fechaBajaModalidad IS NULL");
                while ($modalidades = $conMod->fetch_assoc()) {
                    echo "<option value='" . $modalidades['id'] . "'>" . $modalidades['nombre'] . "</option>";
                }
                ?>
            </select>
            <div>
                <label>Materia:</label><br>
                <select class="custom-select" id="materia">
                    <option value="" selected>Seleccione</option>
                    <?php
                    $conMat = $con->query("SELECT * FROM materia WHERE fechaBajaMateria IS NULL");
                    while ($materias = $conMat->fetch_assoc()) {
                        echo "<option value='" . $materias['id'] . "'>" . $materias['nombreMateria'] . " " . $materias['nivelMateria'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-6">
            <label for="fechaDesde" class="mr-2">Desde:</label>
            <input type="date" id="fechaDesde" class="form-control" required>

            <label for="fechaHasta" class="mr-2">Hasta:</label>
            <input type="date" id="fechaHasta" class="form-control" required>
        </div>
    </div>

    <button class="btn btn-primary mt-2" id="btnGenerar"><i class="fa fa-pie-chart mr-1"></i>Generar</button>

    <div class="my-4">
        <div class="card ">
            <div class="card-header">
                <b> Datos Generales </b>
            </div>
            <div class="card-body">
                <li>Fecha y hora:<label id="fecha"></label></li>
                <li>Periodo:<label id="periodo"></label></li>
                <li>Cantidad de presentes:<label id="cantAusentes"></label></li>
                <li>Cantidad de ausentes:<label id="cantPresentes"></label></li>
            </div>
        </div>
    </div>
    <div class="jumbotron my-2">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script src="../administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>
<script>
    document.getElementById("btnGenerar").onclick = function () {
        var modalidad = document.getElementById('modalidad').value;
        var materia = document.getElementById('materia').value;
        var fechaDesde = document.getElementById('fechaDesde').value;
        var fechaHasta = document.getElementById('fechaHasta').value;

        if(modalidad != "" && materia != "" && fechaDesde != "" && fechaHasta != ""){
            var datos = {
                modalidad: modalidad,
                materia: materia,
                fechaDesde: fechaDesde,
                fechaHasta: fechaHasta
            };
            generarPieChart(datos);
        } else {
            alert("Faltan datos");
        }
    }

    function generarPieChart(datosEntrada) {
        $.ajax({
            url:'generarEstadistica.php',
            type: 'POST',
            data: datosEntrada,
            success: function (dd) {
                var o = JSON.parse(dd);
                alert((o['asistencias']));
            }
            /*success: function(datosRecibidos) {
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Presentes', 'Ausentes'],
                        datasets: [{
                            label: 'Asistencias vs. Inasistencias',
                            data: [(datosRecibidos[0]['asistencias']), (datosRecibidos[0]['inasistencias'])],
                            backgroundColor: ['rgba(0, 147, 0, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                            borderColor: ['rgba(0, 147, 0, 1)','rgba(255, 99, 132, 1)'],
                            borderWidth: 1.5
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }*/
        })
    }
</script>
<?php
include "../../footer.html";
?>