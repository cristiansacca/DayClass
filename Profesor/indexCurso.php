<?php
include "../header.html";
?>

<div class="container">

    <div class="jumbotron my-4" style="background-color:LightSteelBlue">
        <h3 class="">Nombre materia</h3>
        <h4>Nombre curso</h4>
        <p class="lead"></p>
    </div>

    <!-- Page Features -->
    <div class="row text-center">

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/reportes.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">Reportes y estadísticas</h4>
                    <p class="card-text">Genere reportes y estadisticas de asistencias</p>
                </div>

                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Crear</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/Pizzarra-de-novedades.png" alt="pizarra-novedades">
                <div class="card-body">
                    <h4 class="card-title">Pizzarra de novedades</h4>
                    <p class="card-text">Publica novedades para los alumnos del curso</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/asistencias.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">Asistencias</h4>
                    <p class="card-text">Concurrencia al aula de los alumnos </p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Autoasistencia</a>
                    <a href="#" class="btn btn-success">Tradicional</a>
                    
                </div>
            </div>
        </div>

    </div>

</div>

<script src="profesor.js"></script>

<?php
include "../footer.html";
?>