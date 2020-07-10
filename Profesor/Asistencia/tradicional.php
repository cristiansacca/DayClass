<?php
include "header.html";
?>

<div class="text-center my-5">
    <img src="../../bootstrap-icons-1.0.0-alpha5/person-fill.svg" width="10%" height="10%">
    <br>
    <label id="labelNombre" style="font-size:x-large;">Apellido, Nombre</label>
    <div>
        <button class="btn btn-lg btn-danger mx-5">Ausente</button>
        <button class="btn btn-lg btn-success mx-5">Presente</button>
    </div>
    <div class="my-4">
        <a class="mx-5"><img src="../../bootstrap-icons-1.0.0-alpha5/arrow-left-square.svg" width="30px" height="30px"></a>
        <a class="mx-5"><img src="../../bootstrap-icons-1.0.0-alpha5/arrow-right-square.svg" width="30px" height="30px"></a>
    </div>
</div>

<?php
include "footer.html";
?>