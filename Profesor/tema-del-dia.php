<?php
include "../header.html";
?>

<div class="container">
    <h1 class="display-4">Tema del día</h1>
    <div class="row">
        <div class="col-lg-6 col-md-6 mb-6 my-2">
            <label for="">Seleccione la unidad</label>
            <select id="unidad" class="custom-select">
                <option value="1">Unidad 1</option>
                <option value="2">Unidad 2</option>
                <option value="3">Unidad 3</option>
            </select>
        </div>
        <div class="col-lg-6 col-md-6 mb-6 my-2">
            <label for="">Seleccione el tema</label>
            <select id="temas" class="custom-select">
                <option value="1">Tema 1</option>
                <option value="2">Tema 2</option>
                <option value="3">Tema 3</option>
            </select>
        </div>
        <div class="col-lg-12 col-md-6 mb-6 my-2 text-center">
            <textarea name="" id="" cols="60" rows="5" style="resize: none;" class="form-control"
                placeholder="Escribe un comentario..."></textarea>
            <button class="btn btn-primary my-3" data-toggle="modal" data-target="#staticBackdrop">Aceptar</button>
        </div>
    </div>
</div>

<script>
    var tema = document.getElementById("temas").value;
    document.getElementById("unidadpopup").innerHTML
</script>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tema del día</h5>

            </div>
            <div class="modal-body">
                <table class="table-sm">
                    <tr>
                        <td>Unidad:</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Tema:</td>
                        <td>Numeros</td>
                    </tr>
                    <tr>
                        <td>Fecha:</td>
                        <td>16/07/2020</td>
                    </tr>
                    <tr>
                        <td>Comentario:</td>
                        <td>Hola hola</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<?php
include "../footer.html";
?>