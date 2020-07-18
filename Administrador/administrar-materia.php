<?php
include "../header.html";
?>

<div class="container">
    <h1 class="display-4">Materias</h1>
    <div class="form-inline">
        <div class="form-inline my-2">
            <label for="selectEstadoMateria" style="margin-right: 8px;">Mostrar:</label>
            <select id="selectEstadoMateria" class="custom-select" style="margin-right: 8px;">
                <option value="1">Habilitadas</option>
                <option value="2">No habilitadas</option>
                <option value="3" selected>Todas</option>
            </select>
        </div>
        <div class="form-inline my-2">
            <label for="buscarMateria" style="margin-right: 8px;">Nombre: </label>
            <input type="text" id="buscarMateria" class="form-control" style="margin-right: 8px;">
            <button class="btn btn-outline-primary my-2" id="btnBuscarMateria">Buscar</button>
        </div>
    </div>
    <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">Nueva materia</button>
    <div class="my-2">
        <table class="table table-bordered text-center table-info">
            <thead>
                <th>Id</th>
                <th>Nombre materia</th>
                <th>Año</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Cargar programa</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Matemática</td>
                    <td>2020</td>
                    <td>Habilitada</td>
                    <td><button class="btn btn-primary"><i class="fa fa-edit"></i></button></td>
                    <td><button class="btn btn-success"><i class="fa fa-upload"></i></button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Lengua</td>
                    <td>2020</td>
                    <td>Habilitada</td>
                    <td><button class="btn btn-primary"><i class="fa fa-edit"></i></button></td>
                    <td><button class="btn btn-success"><i class="fa fa-upload"></i></button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Estadística</td>
                    <td>2020</td>
                    <td>No habilitada</td>
                    <td><button class="btn btn-primary"><i class="fa fa-edit"></i></button></td>
                    <td><button class="btn btn-success"><i class="fa fa-upload"></i></button></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Química</td>
                    <td>2020</td>
                    <td>Habilitada</td>
                    <td><button class="btn btn-primary"><i class="fa fa-edit"></i></button></td>
                    <td><button class="btn btn-success"><i class="fa fa-upload"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva materia</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                <button type="button" class="btn btn-success" data-dismiss="modal"> Confirmar </button>
            </div>
        </div>
    </div>
</div>

<script src="administrador.js"></script>

<?php
include "../footer.html";
?>