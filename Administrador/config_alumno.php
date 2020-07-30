<?php
include "../header.html";


?>
<script src="administrador.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


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
        
        <table id="example" class="table table-striped table-bordered table-sm" onload="cargar()">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre </th>
                <th>DNI</th>
            </thead>
            
            <tbody>
                <?php
                include "../databaseConection.php";
                
                $consulta1 = $con->query("SELECT `legajoAlumno`,`apellidoAlum`,`nombreAlum`,`dniAlum` FROM `alumno` ORDER BY apellidoAlum ASC");
                
                if (mysqli_num_rows($consulta1) != 0) {
                    while ($resultado1 = $consulta1->fetch_assoc()) {
                            echo "<tr>
                        <td>" . $resultado1['legajoAlumno'] . "</td>
                        <td>" . $resultado1['apellidoAlum'] . "</td>
                        <td>" . $resultado1['nombreAlum'] . "</td>
                        <td>" . $resultado1['dniAlum'] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
                    echo "<br><div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    No hay alumnos cargados en el sistema.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
                }
                ?>
            </tbody>
            
            <script>
                function cargar(){
                    eval("debugger;");
                    $('#example').dataTable();
                }
            </script>
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
                
                <div>
                    <h9>La extension para la lista debe ser .xlsx y los campos deben estar ordenados como sigue: </h9>
                    
                    <table class="table table-bordered text-center table-info">
                        <thead>
                            <th>DNI</th>
                            <th>Legajo</th>
                            <th>Apellido</th>
                            <th>Nombre </th>
                        </thead>
                    </table>
                
                </div>

                <form method="POST" id="importPlanilla" name="importPlanilla" action="insertBDAlumnos.php" enctype="multipart/form-data" role="form">
                    <div class="container" style="margin-top:50px;">

                        <div class="custom-file">
                            <input type="file" class="form-control-file" name="inpGetFile" id="inpGetFile" accept=".xlsx" onchange="comprobarLista()" lang="es"required >

                        </div>
                    </div>
                    <!-- la funcion comrobar esta en administrador.js -->
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                        <button id="btnImportar" type="submit" class="btn btn-primary " disabled> Importar </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>



<?php
include "../footer.html";
?>