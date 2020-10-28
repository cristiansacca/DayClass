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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<link rel="stylesheet" href="../../styleCards.css">
<script src="fnValidarDiasCurso.js"></script>

<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <p class="card-text">Administrador</p>
        
        
        <?php
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('Y-m-d');
        $id_permiso = $_GET["id_permiso"];

        $selectPermiso = $con->query("SELECT * FROM permiso WHERE permiso.id = '$id_permiso'");
        $permiso = $selectPermiso->fetch_assoc();
        $nombrePermiso = $permiso["nombrePermiso"];
        
        
        echo "<h1>$nombrePermiso<i class='fa fa-user-tie ml-2'></i></h1>"
        
        ?>
        
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        
    </div>
    <!-- Page Features -->

    
    <h2>Permisos del Rol</h2>
    <div class="py-4 my-3 jumbotron" style="background-color:PowderBlue;">
        <?php
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('Y-m-d');
        $id_permiso = $_GET["id_permiso"];

        $selectPermisosFuncion = $con->query("SELECT funcion.nombreFuncion FROM permiso, permisofuncion, funcion WHERE permiso.id = '$id_permiso' AND permiso.id = permisofuncion.id_permiso AND permisofuncion.fechaDesdePermisoFuncion <= '$currentDate' AND permisofuncion.fechaHastaPermisoFuncion IS NULL AND permisofuncion.id_funcion = funcion.id AND funcion.fechaDesdeFuncion <= '$currentDate' AND funcion.fechaHastaFuncion IS NULL");
        
        
        
        while($permisosFuncion = $selectPermisosFuncion->fetch_assoc()){
            $nombreFuncion = $permisosFuncion["nombreFuncion"];
            
            echo   "<div class='form-group col-md-6'>
            <label for='inputInicio'>$nombreFuncion</label>
            </div>";
        
        }
        
        ?>
    </div>

    

</div>




<script src="../../administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>