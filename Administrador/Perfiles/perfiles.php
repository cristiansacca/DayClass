<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";

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
<link rel="stylesheet" href="../../styleCards.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<div class="container">

    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Roles<i class="fa fa-user-tie ml-2"></i></h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <div class="my-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-user-plus mr-1"></i>Crear nuevo rol</button>
    </div>
<div class="row text-center">
    <?php
        include "../../databaseConection.php";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('Y-m-d');
    
        $selectPermisos = $con->query("SELECT * FROM `permiso` WHERE `fechaDesdePer` <= '$currentDate' AND `fechaHastaPer` IS NULL AND nombrePermiso <> 'ADMINISTRADOR' ORDER BY nombrePermiso ASC");
    
    
        if(($selectPermisos->num_rows) > 0){
            
        $contador = 0;
    
            while($permisos = $selectPermisos->fetch_assoc()){
                
                $id_permiso = $permisos["id"];
                $nombrePermiso = ucfirst(strtolower($permisos["nombrePermiso"]));
                

                if ($contador == 4) {
                    $contador = 0;
                }
                            
                    echo "<div class='col-lg-6 col-md-3 mb-4' >
                        <div class='card color$contador' >
                            <div class='card-body'>
                                <h4 class='card-title'>".$nombrePermiso."</h4>
                                <h5 class='font-weight-normal'></h5>
                            </div>
                            <div class='card-footer'>
                                <a href='verPerfil.php?id_permiso=$id_permiso' class='btn btn-success'>Ver</a>
                                <a href='' class='btn btn-primary'>Modificar</a>
                                <a href='' class='btn btn-secondary'>Eliminar</a>
                            </div>
                        </div>
                    </div>";
                    $contador++;
            } 
        }
    ?>
</div>
    
</div>

<!-- Modal nuevo rol -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo rol</h5>
            </div>
            <form method="POST" id="insertRol" name="insertRol" action="insertPerfil.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputName4">Nombre Rol</label>
                            <input type="text" class="form-control" id="inputNombrePermiso" name="inputNombrePermiso" required>
                            <h9 class="msg" id="msjValidacionNombreRol"></h9>
                        </div>
                        
                    </div>
                </div>
                <input type="text" id="arregloFunciones" name="arregloFunciones" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btnSpinner" type="submit" class="btn btn-primary" id="btnRegistrarse"> Crear</button>
                </div>
            </form>

        </div>

    </div>
</div>

<script src="../administrador.js"></script>
<script src="perfiles.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="../paginadoDataTable.js"></script>


<script type="text/javascript">
    function mostrarPassword() {
        var cambio = document.getElementById("inputPassword4");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
</script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>
<?php
include "../../footer.html";
?>