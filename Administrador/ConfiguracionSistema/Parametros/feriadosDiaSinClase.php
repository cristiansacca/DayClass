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
    <div>
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

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../../footer.html";
?>