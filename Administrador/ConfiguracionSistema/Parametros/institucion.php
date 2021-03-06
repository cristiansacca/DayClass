<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
include "../../../databaseConection.php";

//-----------------------------------------------------------------------------------------------------------------------------

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 13")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if(!$funcionCorrecta){
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo'])&&isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
  
    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $_SESSION['limite'])
    {
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

//-----------------------------------------------------------------------------------------------------------------------------
$institucion = $con->query("SELECT * FROM institucion");

if(($institucion->num_rows)==0){
    $nombre = "";
    $telefono = "";
    $correo = "";
    $direccion = "";
} else {
    $dataInstitucion = $institucion->fetch_assoc();
    $nombre = $dataInstitucion['nombreInstitucion'];
    $telefono = $dataInstitucion['telefonoInstitucion'];
    $correo = $dataInstitucion['correoInstitucion'];
    $direccion = $dataInstitucion['direccionInstitucion'];
}

?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Datos de la institución</h1>
        <a href="config_parametros.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-edit mr-1"></i>Editar</button>
    </div>

    <?php

    if(isset($_GET["resultado"])){          
        switch ($_GET["resultado"]) {
            case 0:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al editar los datos.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Datos actualizados correctamente.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;       
        }
    }

    ?>

    <div class="table-responsive">
        <table class="table bg-light table-bordered table-striped">
            <tr>
                <td class="font-weight-bold">Nombre:</td>
                <td><?php echo "$nombre" ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Teléfono:</td>
                <td><?php echo "$telefono" ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Correo electrónico:</td>
                <td><?php echo "$correo" ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Dirección:</td>
                <td><?php echo "$direccion" ?></td>
            </tr>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar datos de la institución</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="editar_institucion.php" method="post">
                <div class="modal-body">
                    <div>
                        <label>Nombre</label>
                        <input class="form-control mb-2" type="text" name="nombre" placeholder="Nombre" <?php echo "value='$nombre'"; ?> required>
                        <label>Teléfono</label>
                        <input class="form-control mb-2" type="tel" name="telefono" placeholder="Teléfono" <?php echo "value='$telefono'"; ?> required>
                        <label>Correo electrónico</label>
                        <input class="form-control mb-2" type="email" name="email" placeholder="Correo electrónico" <?php echo "value='$correo'"; ?> required>
                        <label>Dirección</label>
                        <input class="form-control mb-2" type="text" name="direccion" placeholder="Direccion" <?php echo "value='$direccion'"; ?> required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>
<?php
include "../../../footer.html";
?>