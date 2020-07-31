<?php
include "../header.html";

//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<div class="container">

    <h1 class="display-4 my-2">Alumnos</h1>

    <?php
    
    if(isset($_GET["resultado"])){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <h5>Se creó correctamente</h5>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }

    ?>

    <div class="my-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-user-plus mr-2"></i>Crear nuevo</button>
        <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-download mr-2"></i>Importar lista</button>
    </div>

    <div class="my-4">

        <table id="dataTable" class="table table-info table-bordered table-hover table-sm">
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="administrador.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="paginadoDataTable.js"></script>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo alumno</h5>
            </div>
            <form method="POST" id="insertAlumno" name="insertAlumno" action="insertAlumno.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="inputName">Nombre</label>
                        <input type="text" name="inputName" id="inputName" class="form-control" placeholder="Nombre" onchange="validarNombre()" required>
                        <h9 class="msg" id="msjValidacionNombre"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputSurname">Apellido</label>
                        <input type="text" name="inputSurname" id="inputSurname" class="form-control" placeholder="Apellido" onchange="validarApellido()" required>
                        <h9 class="msg" id="msjValidacionApellido"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputLegajo">Legajo</label>
                        <input type="number" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Legajo" required>
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear" disabled> Crear</button>
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
                <h3 class="modal-title " id="staticBackdropLabel">Importar lista</h3>
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

                <form method="POST" id="importPlanilla" name="importPlanilla" action="importMasivoALUMNOS.php" enctype="multipart/form-data" role="form">
                    <div class="container" style="margin-top:50px;">

                        <div class="custom-file">
                            <input type="file" class="form-control-file" name="inpGetFile" id="inpGetFile" accept=".xlsx" onchange="comprobarLista()" lang="es" required>

                        </div>
                    </div>
                    <!-- la funcion comrobar esta en administrador.js -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button id="btnImportar" type="submit" class="btn btn-primary " disabled>Importar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>



<?php
include "../footer.html";
?>