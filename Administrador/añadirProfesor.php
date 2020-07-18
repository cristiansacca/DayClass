<?php
include "../header.html";
?>
<script src="administrador.js"></script>

<div class="container">
   <h2 class=" my-5"> Seleccionar profesores</h2>
   <div class="form-inline my-2">
        <label for="selectcargo">Cargo   </label>
                    <select id="selectcargo" class="custom-select mx-2" style="width:200px">
                       <option>Teoria</option>
                       <option>JTP</option>
                       <option>PJ</option>
                    </select>
    </div>
        <div class="form-inline my-2">
            <label for="buscarMateria" style="margin-right: 8px;">Nombre </label>
            <input type="text" id="buscarMateria" class="form-control" style="margin-right: 8px;">
            <button class="btn btn-outline-primary my-2" id="btnBuscarMateria">Buscar</button>
        </div>
  
    <div class="my-2">
        <table class="table table-bordered text-center table-info">
            <thead>
                <th>Legajo</th>
                <th>Nombre </th>
                <th>Añadir</th>
            </thead>
            <tbody>
                <tr>
                    <td>1236</td>
                    <td>Patricia</td>
                    <td><button class="btn btn-success"><i class="fa fa-upload"></i></button></td>
                </tr>
                <tr>
                    <td>2859</td>
                    <td>Marisa</td>
                    <td><button class="btn btn-success"><i class="fa fa-upload"></i></button></td>
                </tr>
                </tbody>
        </table>
    </div>








</div>


    <?php
include "../footer.html";
?>