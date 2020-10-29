<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

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
  
?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Asistencias</h1>
        <a href="/DayClass/Administrador/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div class="row mx-1">
        <select name="materia" id="materia" class="custom-select col-md-6">
            <option value="">Materias</option>
            <?php
                $consultaMateria = $con->query("SELECT * FROM materia WHERE fechaBajaMateria IS NULL ORDER BY nombreMateria, nivelMateria ASC");

                while($materia = $consultaMateria->fetch_assoc()){
                    echo "<option value='".$materia['id']."'>".$materia['nombreMateria']." (Nivel ".$materia['nivelMateria'].")</option>";
                }

            ?>
        </select>
        <select name="curso" id="curso" class="custom-select col-md-6">
            <option value="">Cursos</option>
        </select>
    </div>
</div>

<script src="../administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>