<?php
include "../header.html";
include "../databaseConection.php";

$consulta1 = $con->query("SELECT * FROM alumno");

?>
<script src="administrador.js"></script>

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>
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
        <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">Crear Nuevo</button>
        <button class="btn btn-success mx-3" data-toggle="modal" data-target="#staticBackdrop1">Importar Lista</button>

    </div>
    <div class="my-5">
        <table class="table table-bordered text-center table-info">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre </th>
                <th>DNI</th>
            </thead>
            <tbody>
                <?php
                while ($resultado1 = $consulta1->fetch_assoc()) {
                    echo "<tr>
                <td>" . $resultado1['legajoAlumno'] . "</td>
                <td>" . $resultado1['apellidoAlum'] . "</td>
                <td>" . $resultado1['nombreAlum'] . "</td>
                <td>" . $resultado1['dniAlum'] . "</td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel"> Nuevo Alumno</h5>
            </div>
            <form method="POST" id="insertAlumno" name="insertAlumno" action="insertAlumno.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="inputName"> Nombre </label>
                        <input type="text" name="inputName" id="inputName" class="form-control" placeholder="Nombre" onchange="validarNombre()" required>
                        <h9 class="msg" id="msjValidacionNombre"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputSurname">Apellido </label>
                        <input type="text" name="inputSurname" id="inputSurname" class="form-control" placeholder="Apellido" onchange="validarApellido()" required>
                        <h9 class="msg" id="msjValidacionApellido"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputLegajo">Legajo </label>
                        <input type="number" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Legajo" required>
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">Numero Dni </label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                    <button type="submit" class="btn btn-primary" id="btnCrear" disabled> Crear </button>
                </div>
            </form>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel"> Importar Lista</h3>
            </div>
            <div class="modal-body">

                <form method="#" id="importPlanilla" name="importPlanilla" action="#" enctype="multipart/form-data" role="form">
                    <div class="container" style="margin-top:50px;">

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" required name="inpGetFil" id="inpGetFil" accept=".xlsx" onchange="comprobarListaAlumnos()" lang="es">

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