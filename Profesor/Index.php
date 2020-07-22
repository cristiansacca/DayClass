<?php
include "../header.html";
?>

<div class="container">

    <div class="jumbotron my-4">
        <h3 class="">ApellidoUsuario, NombreUsuario</h3>
        <p class="lead"></p>
        <a href="editar_perfil.php" class="btn btn-primary btn-lg">Ver Perfil</a>
    </div>

    <!-- Page Features -->
    <div class="row text-center">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/reportes.png" oncontextmenu="return false"alt="">
                <div class="card-body">
                    <h4 class="card-title">Reportes y estadísticas</h4>
                    <p class="card-text">Genere reportes y estadisticas de asistencias</p>
                </div>

                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/cursos.png" oncontextmenu="return false" alt="">
                <div class="card-body">
                    <h4 class="card-title">Cursos</h4>
                    <p class="card-text">En los que dica actualmente</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/Pizzarra-de-novedades.png" oncontextmenu="return false" alt="pizarra-novedades">
                <div class="card-body">
                    <h4 class="card-title">Pizzarra de novedades</h4>
                    <p class="card-text">Publica novedades para los alumnos de un curso</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top imagen" src="../images/asistencias.png" oncontextmenu="return false" alt="">
                <div class="card-body">
                    <h4 class="card-title">Asistencias</h4>
                    <p class="card-text">Concurrencia al aula</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="profesor.js"></script>

<?php
include "../footer.html";
?>