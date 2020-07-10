<?php
include "header.html";
?>

<div class="text-center my-5 mx-4 form-row row-cols-2">
    <div>
        <h3>Código de auto-asistencia</h3>
        <br>
        <input type="text" readonly value="XXXXXXXXX" class="form-control m-auto text-center" style="width: 30%; font-size: x-large;">
        <br>
        <input type="button" class="btn btn-primary" value="Generar">
    </div>    
    <div>
        <h3>Seleccione la duración del código</h3>
        <br>
        <select class="form-control m-auto" style="width: 30%;">
            <option value="5" selected>5 minutos</option>
            <option value="10">10 minutos</option>
            <option value="15">15 minutos</option>
            <option value="20">20 minutos</option>
            <option value="30">30 minutos</option>
        </select>
    </div>
</div>
<div class="text-center">
    <input type="button" value="Habiliar" class="btn btn-lg btn-success">
</div>

<?php
include "footer.html";
?>