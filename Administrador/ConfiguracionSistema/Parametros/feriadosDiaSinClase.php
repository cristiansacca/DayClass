<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo']) && isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if ($vida_session > $_SESSION['limite']) {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();
        //Redirigimos pagina.
        header("Location: /DayClass/index.php?resultado=3");

        exit();
    }
}
$_SESSION['tiempo'] = time();

include "../../../databaseConection.php";
?>

<script src="../../administrador.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Feriados y días sin clases</h1>
        <a href="config_parametros.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    
    <?php

            if (isset($_GET["resultado"])) {
                switch ($_GET["resultado"]) {
                    case 1:
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Feriado o día sin clase creado correctamente.</h5>";
                        break;
                    case 2:
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Error al crear el feriado o día sin clases.</h5>";
                        break;
                    case 3:
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Ya existe un feriado o día sin clases con el mismo nombre y motivo, modifique el existente.</h5>";
                        break;
                }
                echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
            }

        ?>
    
    <div>
        <a class="btn btn-success mb-3" href="" data-toggle="modal" data-target="#nuevoFeriadoDiaSinClase"><i class="fa fa-plus mr-2"></i>Agregar</a>
        
        <table class="table table-bordered table-secondary">
            <thead>
                <th></th>
                <th>Evento</th>
                <th>Fecha</th>
                <th>Día</th>
                <th>Motivo</th>
            </thead>
            <tbody>
                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Editar</label>
                    </div>
                </td>
                <td><input class="form-control" type="date" readonly></td>
                <td><input class="form-control" type="text" readonly></td>
                <td><input class="form-control" type="text" readonly></td>
                <td><input class="form-control" type="text" readonly></td>
            </tbody>
        </table>

    </div>
</div>

<div class="modal fade" id="nuevoFeriadoDiaSinClase" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo feriado o día sin clases</h5>
            </div>
            <form action="insertFeriadoDiaSinClases.php" method="POST">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="fechaFeriadoDiaSinClases">Fecha:</label>
                        <input type="date" placeholder="fecha" name="inputFechaSinClases" id="inputFechaSinClases" class="form-control" required>
                        <label for="descripcionFeriadoDiaSinClases">Descripción:</label>
                        <input type="Text" placeholder="Descripción" name="inputComentarioFDiaSinClases" id="inputComentarioFDiaSinClases" class="form-control" required>
                        <label for="motivoFeriadoDiaSinClases">Motivo:</label>
                        <select name="comboMotivo" id="comboMotivo" class="custom-select" required>
                            <option value="" selected>Seleccione...</option>
                            <?php
                                $consultaMotivo = $con->query("SELECT * FROM `motivodiasinclases` WHERE `fechaHastaMotivoDiaSinClases` IS NULL");
                                while ($motivo = $consultaMotivo->fetch_assoc()) {
                                    echo "<option value='" . $motivo["id"] . "'>" . $motivo["nombreMotivoDiaSinClases"] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../../footer.html";
?>