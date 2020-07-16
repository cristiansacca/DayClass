<?php
include "../header.html";
?>
<div class="container">

    <h1 class="display-4 "> Pizarra de Novedades</h1>

    <button class="btn btn-primary my-2" id="AniadirPublicacion " data-toggle="modal" data-target="#staticBackdrop">
        Añadir publicación </button>

    <table style= "background-color:rgb(204, 153, 241);" class="table table-striped table-hover  table-bordered text-center my-2">
        <thead>
            <tr>
                <th>
                  Tema  
                </th>
                <th>
                    Realizado por 
                </th>
                <th>
                    Fecha 
                </th>
            </tr>
        </thead>
        <tbody id= "Publicaciones">
            <tr>
                <td>Hola </td>
                <td>Chau</td>
                <td>ruta</td>
            </tr>
            <tr>
                <td>Hola </td>
                <td>Chau</td>
                <td>ruta</td>
            </tr>
            <tr>
                <td>Hola </td>
                <td>Chau</td>
                <td>ruta</td>
            </tr>
            <tr>
                <td>Hola </td>
                <td>Chau</td>
                <td>ruta</td>
            </tr>
        </tbody>
    </table>
    
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel"> Publicación </h5>
            </div>
            <div class="modal-body">
                <div>
                    <label for=""> Asunto </label>
                    <input type="text" name="" id="" class="form-control" placeholder="Escribir asunto">
                </div>
                <div class="my-2">
                    <label for=""> Mensaje </label>
                    <textarea class="form-control " id="" cols="30" rows="10" style="resize:none;"
                        placeholder="Escribir mensaje"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                <button type="button" class="btn btn-success" data-dismiss="modal"> Confirmar </button>
            </div>
        </div>
    </div>
</div>


<?php
include "../footer.html";
?>