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

        <div class="col-lg-6 col-md-3 mb-4" >
            <div class="card h-100" style="background-color:LightSteelBlue">
                <div class="card-body">
                    <h4 class="card-title">Materia 1</h4>
                    <h5 class="card-title">Curso 1</h5>
                </div>

                <div class="card-footer">
                    <a href="indexCurso.php" class="btn btn-primary btn-lg">Ingresar</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-3 mb-4">
            <div class="card h-100" style="background-color:LightBlue">
                <div class="card-body" >
                    <h4 class="card-title">Materia 1</h4>
                    <h5 class="card-title">Curso 3</h5>
                </div>

                <div class="card-footer">
                    <a href="indexCurso.php" class="btn btn-primary btn-lg">Ingresar</a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-3 mb-4">
            <div class="card h-100" style="background-color:Thistle">
                <div class="card-body" >
                    <h4 class="card-title">Materia 63</h4>
                    <h5 class="card-title">Curso 2</h5>
                </div>

                <div class="card-footer">
                    <a href="indexCurso.php" class="btn btn-primary btn-lg">Ingresar</a>
                </div>
            </div>
        </div>


    </div>

</div>

<script src="profesor.js"></script>

<?php
include "../footer.html";
?>