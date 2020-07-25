<?php
include "../../header.html";
?>
<script src="../profesor.js"></script>
<script src="funciones_habilitarAutoasistencia.js"></script>


<div class="container">
    <h2 class="display-4 text-center">Habilitar auto-asistencia</h2>
    <div class="mt-4">
        <div class="text-center row">
            <div class="form-group col-md-6">
                <h3>Código de auto-asistencia</h3>
                <br>
                <input type="text" readonly value="XXXXXXXXX" class="form-control m-auto text-center" style="width: auto; font-size: large;" id="outCodigoAutoasist">
                <br>
                <button class="btn btn-lg btn-primary" id="btnCodigoAutoasist" onclick="generarCodigo()"><i class="fa fa-refresh mr-2"></i>Generar</button>
            </div>    
            <div class="form-group col-md-6">
                <h3>Seleccione la duración del código</h3><br>
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
            <button class="btn btn-lg btn-success"><i class="fa fa-check-circle mr-2"></i>Habilitar</button>
        </div>
    </div>
</div>

<?php
include "../../footer.html";
?>