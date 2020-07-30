<?php
include "../header.html";

include "../databaseConection.php";

$consulta1 = $con->query("SELECT `asunto`,`fechaHoraNotif`,`mensaje` FROM `notificacionprofe` ORDER BY fechaHoraNotif ASC");
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
        <?php
                if (!($consulta1->num_rows) == 0) {
                    while ($resultado1 = $consulta1->fetch_assoc()) {
                            echo "<tr>
                        <td>" . $resultado1['asunto'] . "</td>
                        <td>" . $resultado1['mensaje'] . "</td>
                        <td>" . $resultado1['fechaHoraNotif'] . "</td>
                      
                        </tr>";
                    }
                } else {
                    
                    echo "<br><div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    No se han realizado publicaciones<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button></div> ";
                }
                ?>
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
            <form method="POST" id="insertPublicacion" name="insertPublcacion" action="insertPublicacion.php" enctype="multipart/form-data" role="form">
            <div class="modal-body">
                <div>
                    <label for=""> Asunto </label>
                    <input type="text" name="inputAsunto" id="inputAsunto" class="form-control" placeholder="Escribir asunto">
                </div>
                <div class="my-2">
                    <label for=""> Mensaje </label>
                    <textarea class="form-control " name="textMensaje" id="textMensaje" cols="30" rows="10" style="resize:none;"
                        placeholder="Escribir mensaje"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                <button type="submit" class="btn btn-success"  id="btnCrear"> Confirmar </button>
            </div>
            </form>
        </div>
    </div>
</div>


<?php
include "../footer.html";
?>