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
<script src="fnBackup.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Copia de seguridad y recuperación de datos<i class="fa fa-database ml-2"></i></h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 0:
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha generado ningún backup.</h5>";
                break;
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Backup de datos creado correctamente.</h5>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al crear el backup de datos.</h5>";
                break;
            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Restauración exitosa de la Base de Datos.</h5>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al restaurar la Base de Datos.</h5>";
                break;
            case 5:
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay ninguna copia almacenada para restaurar.</h5>";
                break;
             case 6:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error del sistema. Contante al administrador de base de datos, para restauración manual.</h5>";
                break;
        }
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    ?>

    <a href="descargaBackup.php" class="btn btn-primary"><i class="fa fa-database mr-1"></i>Realizar copia</a>
    <a href="descargaBackup.php?download=true" class="btn btn-secondary"><i class="fa fa-download mr-1"></i>Descargar copia</a>
    <button class="btn btn-success" data-toggle="modal" data-target="#restoreDataBase"><i class="fa fa-upload mr-1"></i>Restaurar base de datos</button>
    

    <div class="mt-4">
        <table class="table table-bordered bg-light">
            <tr>
                <td><b>Última copia de seguridad generada:</b></td>
                <td><?php 
                    $files = glob('backupDB/*'); //obtenemos todos los nombres de los ficheros

                    if(count($files) !== 0){
                        foreach($files as $file){
                            if(is_file($file))
                            echo $file;
                         }
                    } else {
                        echo "No se ha generado ningún backup";
                    }?></td>
            </tr>
        </table>
    </div>

</div>

<!-- Modal para seleccionar el modo de recuperacion de la BD -->
<div class="modal fade" id="restoreDataBase" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Recuperación de base de datos</h3>
            </div>
            
             <form method="POST" id="uploadBackup" name="uploadBackup" action="restaurarBackup.php" enctype="multipart/form-data" role="form">
            
                <div class="modal-body">
                <h9>Seleccione la forma de recuperación:</h9>
                    
                    <div class="container">
                        <div class="radio">
                            <label onclick='hide()'><input type="radio" id="guardado" name="optradio" checked onclick='hide()'> Copia guadada en el sistema.</label>
                        </div>

                        <div class="radio">
                            <label onclick='unHide()'><input type="radio" id="subir" name="optradio" onclick='unHide()'> Subir copia guadada.</label>
                        </div>
                    </div>
                    
                        <div class="container" name="msgLastBackUp" id="msgLastBackUp">
                            <table class="table table-bordered bg-light">
                                <tr>
                                    <td>Copia de seguridad que se va a restaurar:</td>
                                    <td><?php 
                                        
                                        $files = glob('backupDB/*'); //obtenemos todos los nombres de los ficheros

                                        if(count($files) !== 0){
                                            foreach($files as $file){
                                                if(is_file($file))
                                                echo $file;
                                             }
                                        } else {
                                            echo nl2br ("<b> No hay ningún backup guardado en el sistema.\n Revise si tiene copias locales descaragdas.</b>");
                                        }?></td>
                                </tr>
                            </table>
                        </div>
                    
                    <div class="container" name="inputFile" id="inputFile" style="display:none">
                        <div class="custom-file">
                            <input type="file" class="form-control-file" id="inputSQL" name="inputSQL" placeholder="base de datos que deseas restaurar" accept=".sql" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btnImportar" type="submit" class="btn btn-primary">Restaurar</button>
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