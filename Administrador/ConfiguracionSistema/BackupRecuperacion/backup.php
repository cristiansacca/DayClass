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
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."'");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 20")->fetch_assoc(); // <-- Cambia
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




?>

<script src="fnBackup.js"></script>
<script src="../../administrador.js"></script>


<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text"><?php echo $nombreRol;?></p>
        <h1>Copia de seguridad y recuperación de datos<i class="fa fa-database ml-2"></i></h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 0:
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha generado ninguna copia de seguridad.</h5>";
                break;
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Copia de seguridad creada correctamente.</h5>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al crear la copia de seguridad.</h5>";
                break;
            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Restauración exitosa de la base de datos.</h5>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al restaurar la base de datos.</h5>";
                break;
            case 5:
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay ninguna copia almacenada para restaurar.</h5>";
                break;
            case 6:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error del sistema. Contacte al administrador de base de datos para restauración manual.</h5>";
                break;
        }
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    ?>

    <div class="mt-4">
        <h5>Última copia de seguridad generada</h5>
        <table class="table table-bordered bg-light">
            <tr>

                <td><b>Archivo: </b><?php
                    $files = glob('backupDB/*'); //obtenemos todos los nombres de los ficheros
                    $archivo = null;

                    if (count($files) !== 0) {
                        foreach ($files as $file) {
                            if (is_file($file))
                                //echo $file;

                                $archivo = strval($file);
                            $archivo = explode("/", $archivo);
                            $nombreArchivo = $archivo[1];
                            echo $nombreArchivo;
                        }
                    } else {
                        echo "No se ha generado ninguna copia de seguridad";
                    } ?></td>
                <td><b>Fecha:</b> 
                    <?php
                        if (count($files) !== 0) {
                            $fechaArchivo = date_create_from_format ("Y-m-d-His", substr($nombreArchivo, 12, 17));
                            echo date_format($fechaArchivo, "d/m/Y H:i:s");   
                        } else {
                            echo "No se ha generado ninguna copia de seguridad";
                        }    
                    ?>
                </td>
            </tr>
        </table>
    </div>


    <div class="mt-4">
        <h5>Generar copia de seguridad</h5>
        <a href="descargaBackup.php" class="btn btn-primary"><i class="fa fa-database mr-1"></i>Realizar copia</a>
        <a href="descargaBackup.php?download=true" class="btn btn-secondary"><i class="fa fa-download mr-1"></i>Descargar copia</a>
    </div>

    <div class="mt-4">
        <h5>Restaurar base de datos anterior</h5>
        <button class="btn btn-success" data-toggle="modal" data-target="#restoreDataBase"><i class="fa fa-upload mr-1"></i>Restaurar base de datos</button>
    </div>


</div>

<!-- Modal para seleccionar el modo de recuperacion de la BD -->
<div class="modal fade" id="restoreDataBase" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Recuperación de base de datos</h3>
            </div>

            <form method="POST" id="uploadBackup" name="uploadBackup" action="restaurarBackup.php" enctype="multipart/form-data" role="form" onsubmit="return confirmRestaurar()">

                <div class="modal-body">
                    <h9>Seleccione la forma de recuperación:</h9>

                    <div class="container">
                        <div class="radio">
                            <label onclick='hide()'><input type="radio" id="guardado" name="optradio" checked onclick='hide()'> Copia guardada en el sistema.</label>
                        </div>

                        <div class="radio">
                            <label onclick='unHide()'><input type="radio" id="subir" name="optradio" onclick='unHide()'> Subir copia guardada.</label>
                        </div>
                    </div>

                    <div class="container" name="msgLastBackUp" id="msgLastBackUp">
                        <table class="table table-bordered bg-light">
                            <tr>
                                <td>Copia de seguridad que se va a restaurar:</td>
                                <td><?php

                                    $files = glob('backupDB/*'); //obtenemos todos los nombres de los ficheros

                                    if (count($files) !== 0) {
                                        foreach ($files as $file) {
                                            if (is_file($file))
                                                echo $file;
                                        }
                                    } else {
                                        echo nl2br("<b>No hay ninguna copia de seguridad guardada en el servidor.\n Revise si tiene copias locales descargadas.</b>");
                                    } ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="container" name="inputFile" id="inputFile" style="display:none">
                        <div class="custom-file">
                            <input type="file" class="form-control-file" id="inputSQL" name="inputSQL" accept=".sql" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancelar</button>
                    <button id="btnImportar" type="submit" class="btn btn-primary">Restaurar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../../../footer.html";
?>