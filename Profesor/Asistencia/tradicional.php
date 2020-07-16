<?php
include "../../header.html";
?>

<script src="funciones_habilitarAutoasistencia.js"></script>
<h2 class="text-center my-4">Nombre del curso</h2>
<div class="text-center my-5">
    <i class="fa fa-user-circle-o fa-5x"></i>
    <br>
    <label id="labelNombre" style="font-size:xx-large;">Apellido, Nombre</label>
    <div>
        <button class="btn btn-lg btn-danger mx-4"><i class="fa fa-ban mx-1"></i>Ausente</button>
        <button class="btn btn-lg btn-success mx-4"><i class="fa fa-check mx-1"></i>Presente</button>
    </div>
    <div class="my-4">
        <a><i class="fa fa-arrow-circle-left fa-2x mx-5"></i></a>
        <a><i class="fa fa-arrow-circle-right fa-2x mx-5"></i></a>
    </div>
</div>

<?php
include "../../footer.html";
?>