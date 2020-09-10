<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div class="container">
    <div class="py-4 my-3 jumbotron bg-light">
        <h1>Información de asistencias</h1>
        <a class="btn btn-info" href="/DayClass/Alumno/index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Atras</a>
    </div>
    <div class="form-group">
            <?php
              include "../../databaseConection.php";
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d');

              //Busca todas las instanias de AlumnoCursoActual que están asociadas al alumno que ingresó
              $consulta1 = $con->query("SELECT * FROM alumnocursoactual WHERE alumno_id = '".$_SESSION['alumno']['id']."' AND `fechaDesdeAlumCurAc` <= '$currentDateTime' AND  `fechaHastaAlumCurAc` >= '$currentDateTime'");
              
            if(($consulta1->num_rows) == 0){
            echo "<div class='alert alert-warning' role='alert'>
                    <h5>Todavia no esta inscripto a ninguna materia, no puede justiticar .</h5>
                </div>";
            }else{
                
                echo "<label for=''>Seleccione la materia:</label>";
                echo "<select name='' id='materias' class='custom-select'>";
              while ($alumnocursoactual = $consulta1->fetch_assoc()) {
                  
                //Por cada instancia de AlumnoCursoActual se obtiene el curso asociado
                  $curso = $con->query("SELECT * FROM curso WHERE id = '".$alumnocursoactual['curso_id']."'")->fetch_assoc();

                  echo "<option value='".$curso['id']."'>".$curso['nombreCurso']."</option>";

              }
                echo "</select>";
            }
        ?>
        
    </div>

    <div class="form-inline">
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

    <div>
        <table class="table table-bordered text-center table-info table-sm">
            <thead>
                <th>Fecha</th>
                <th>Asistencia</th>
                <th>Justificado</th>
            </thead>
            <tbody id="tablaAsistencias">

            </tbody>
        </table>
    </div>
</div>

<script src="../alumno.js"></script>
<script>
    document.getElementById("materias").onchange = function () {

    }

    function mostrarAsistencias() {
        var id_curso = document.getElementById("materias").value;
        

    }
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Presentes', 'Ausentes', 'Justificados'],
            datasets: [{
                label: 'Asistencias vs. Inasistencias vs. Justificados',
                data: [25,5,2],
                //backgroundColor: ['rgba(0, 147, 0, 0.5)', 'rgba(255, 99, 132, 0.5)', 'rgba(255, 255, 0, 0.5)'],
                backgroundColor: ['rgba(0, 147, 0, 1)','rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
                borderColor: ['rgba(0, 147, 0, 1)','rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
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
        },
        plugins: {
            labels: {
                render: 'percentage',
                fontColor: ['white', 'white', 'white'],
                precision: 2
            }
        },
    });

    var ctx2 = document.getElementById('barChart').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'horizontalBar',
        data: {
            labels: ['Presentes', 'Ausentes', 'Justificados'],
            datasets: [{
                label: '',
                barPercentage: 0.6,
                data: [25,5,2],
                //backgroundColor: ['rgba(0, 147, 0, 0.5)', 'rgba(255, 99, 132, 0.5)', 'rgba(255, 255, 0, 0.5)'],
                backgroundColor: ['rgba(0, 147, 0, 1)','rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
                borderColor: ['rgba(0, 147, 0, 1)','rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
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
</script>
<?php
include "../modal-autoasistencia.php";
?>

<?php
include "../../footer.html";
?>