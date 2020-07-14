<?php
include "../../header.html";
?>
<script src="funciones_habilitarAutoasistencia.js"></script>


<div class="text-center my-5 mx-4 form-row">
    <div class="form-group col-md-6">
        <h3>Código de auto-asistencia</h3>
        <br>
        <input type="text" readonly value="XXXXXXXXX" class="form-control m-auto text-center" style="width: auto; font-size: large;" id="outCodigoAutoasist">
        <br>
        <input type="button" class="btn btn-lg btn-primary" value="Generar" id="btnCodigoAutoasist" onclick="generarCodigo()">
    </div>    
    <div class="form-group col-md-6">
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
    <input type="button" value="Habilitar" class="btn btn-lg btn-success">
</div>

<?php
include "../../footer.html";
?>