<?php
include "../header.html";
?>
<script src="administrador.js"></script>

<style>.custom-file-label::after { content: "Elegir";}</style>
<div class="container">
    <h1 class="display-4 my-2">Alumnos</h1>
    <label> Buscar por:</label>
    <div class="form-inline">
    
        <div class="form-inline my-2">
      
        <label for="buscarMateria" style="margin-right: 8px;">Legajo: </label>
            <input type="text" id="buscarMateria" class="form-control" style="margin-right: 8px;">
            
        </div>
        <div class="form-inline my-2">
            <label for="buscarMateria" style="margin-right: 8px;">Nombre: </label>
            <input type="text" id="buscarMateria" class="form-control" style="margin-right: 8px;">
            <button class="btn btn-outline-primary my-2" id="btnBuscarMateria">Buscar</button>
        </div>
    </div>
<div class="my-2" style="float:right">
    <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" >Crear Nuevo</button>
    <button class="btn btn-success mx-3" data-toggle="modal" data-target="#staticBackdrop1" >Importar Lista</button>
 
</div>
    <div class="my-5">
        <table class="table table-bordered text-center table-info">
            <thead>
                <th>Legajo</th>
                <th>Nombre </th>
                <th>Dni</th>
            </thead>
            <tbody>
                <tr>
                    <td>8956</td>
                    <td>Roberto</td>
                    <td>4578215</td>
                </tr>
                <tr>
                    <td>2356</td>
                    <td>Mariana</td>
                    <td>4578129</td>
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
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel"> Nuevo Alumno</h5>
            </div>
            <div class="modal-body">
                <div class="my-2">
                    <label for="nombrecurso"> Nombre </label>
                    <input type="text" name="nombreProfe" id="nombreProfe" class="form-control" >
                </div>
                <div class="my-2">
                    <label for="apellidoProfe">Apellido </label>
                    <input type="text" name="apellidoProfe" id="apellidoProfe" class="form-control" >
                </div>
                <div class="my-2">
                    <label for="legajoProfe">Legajo </label>
                    <input type="text" name="legajoProfe" id="legajoProfe" class="form-control" >
                </div>
                <div class="my-2">
                    <label for="dniProfe">Numero Dni </label>
                    <input type="text" name="dniProfe" id="dniProfe" class="form-control" >
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"> Crear </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel"> Importar Lista</h3>
            </div>
            <div class="modal-body">

            <form method="#" id="importPlanilla" name="importPlanilla" action="#" enctype="multipart/form-data" role="form">
            <div class="container" style="margin-top:50px;">

                <div class="custom-file">
                    <input type="file" class="custom-file-input" required name="inpGetFil" id="inpGetFil" accept=".xlsx"
                        onchange="comprobarListaAlumnos()" lang="es">

                    <label class="custom-file-label" for="validatedCustomFile">Seleccionar archivo</label>

                </div>
                </div>
                <!-- la funcion comrobar esta en administrador.js -->
                <br>
                <br>
                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                        <button type="button" class="btn btn-primary " data-dismiss="modal"> Importar </button>
                </div>
    
        </form>
    </div>
            
        </div>
    </div>
</div>



<?php
include "../footer.html";
?>