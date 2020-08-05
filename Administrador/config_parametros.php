<?php
include "../header.html";
?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Parámetros</h1>
        <a href="index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div>
        <div class="list-group">
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-flag fa-lg mr-2"></i>Institución</a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-check-circle fa-lg mr-2"></i>Tipo de asistencias</a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-clock-o fa-lg mr-2"></i>Tiempo límite código de auto-asistencia</a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-sign-out fa-lg mr-2"></i>Vigencia de sesión</a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-info-circle fa-lg mr-2"></i>Mínimo de asistencia y estados</a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-briefcase fa-lg mr-2"></i>Modalidades</a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-calendar fa-lg mr-2"></i>Días</a>
        </div>
    </div>
</div>

<script src="administrador.js"></script>

<?php
include "../footer.html";
?>