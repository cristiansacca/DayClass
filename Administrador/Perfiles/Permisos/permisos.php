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

if (!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")) {
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '" . $_SESSION['usuario']['id_permiso'] . "'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '" . $permiso['id'] . "' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 22")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if (!$funcionCorrecta) {
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

//-----------------------------------------------------------------------------------------------------------------------------


?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Seleccionar archivo";
    }
</style>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Permisos</h1>
        <a href="/DayClass/Administrador/Perfiles/perfiles.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <div class="my-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-clipboard-check mr-1"></i>Dar de alta permiso</button>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Alta exitosa del permiso.</h5>";
                break;

            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Falla en el alta del permiso.</h5>";
                break;
            case 3:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Falla en el alta del permiso. La imagen que intenta subir no es correcta.</h5>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ya existe un permiso con el mismo nombre y/o código. Intente nuevamente.</h5>";
                break;
            case 5:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Se dio de baja el permiso correctamente.</h5>";
                break;
            case 6:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al dar de baja el permiso.</h5>";
                break;
            case 7:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Permiso actualizado correctamente.</h5>";
                break;

            case 8:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al actualizar los datos del permiso.</h5>";
                break;
        }
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    ?>

    <div class="table-responsive">
        <table class="table table-secondary table-bordered" id="dataTable">
            <thead>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
                $consultaPermisos = $con->query("SELECT * FROM funcion WHERE fechaHastaFuncion IS NULL");
                while ($funcion = $consultaPermisos->fetch_assoc()) {
                    $consultaAsignado = $con->query("SELECT * 
                        FROM permisofuncion 
                        WHERE id_funcion = '".$funcion['id']."' 
                        AND fechaHastaPermisoFuncion IS NULL");
                    $deshabilitado = ($consultaAsignado->num_rows) == 0 ? '' : 'disabled'; 
                    echo "<tr>
                        <td>" . $funcion['codigoFuncion'] . "</td>
                        <td>" . $funcion['nombreFuncion'] . "</td>
                        <td>
                            <button data-toggle='modal' data-target='#modalEditar' class='btn btn-success mr-1 mb-1' onclick='editar(" . $funcion['id'] . ");'><i class='fa fa-edit mr-1'></i>Editar</button>
                            <button $deshabilitado class='btn btn-danger mr-1 mb-1' onclick='darBaja(" . $funcion['id'] . ");'><i class='fa fa-trash mr-1'></i>Baja</button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Modal nuevo permiso -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Alta de permiso</h5>
            </div>
            <form enctype="multipart/form-data" action="altaPermiso.php" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" name="inputNombre" id="inputNombre" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="inputLink">Vínculo a la página principal</label>
                        <input type="text" name="inputLink" id="inputLink" class="form-control" required>
                    </div>
                    <label>Cargar imagen</label>
                    <div class="custom-file mb-2">
                        <input type="file" name="inputImagen" id="inputImagen" accept="image/*" class="custom-file-input" required>
                        <label for="inputImagen" class="custom-file-label"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal editar permiso -->
<div class="modal fade" id="modalEditar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar permiso</h5>
            </div>
            <form enctype="multipart/form-data" action="editarPermiso.php" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="editarNombre">Nombre</label>
                        <input type="text" name="editarNombre" id="editarNombre" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="editarCodigo">Código</label>
                        <input type="number" name="editarCodigo" id="editarCodigo" class="form-control" min="0" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="editarLink">Vínculo a la página principal</label>
                        <input type="text" name="editarLink" id="editarLink" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="imagenGuardada">Imagen</label><br>
                        <div class="text-center">
                            <img  id="imagenGuardada" class='img-thumbnail' src="" width="60%">
                        </div>
                    </div>
                    <label>Nueva imagen</label>
                    <div class="custom-file mb-2">
                        <input type="file" name="editarImagen" id="editarImagen" accept="image/*" class="custom-file-input">
                        <label for="editarImagen" class="custom-file-label"></label>
                    </div>
                    <input type="text" name="idPermisoEditar" id="idPermisoEditar" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../administrador.js"></script>

<script>
    function darBaja(id) {
        var confirmacion = confirm("¿Está seguro que desea dar de baja el permiso?");
        var datos = {
            idFuncion: id
        }
        if (confirmacion) {
            $.ajax({
                url: 'darBajaPermiso.php',
                type: 'POST',
                //async: false,
                data: datos,
                success: function(datosRecibidos) {
                    //json = JSON.parse(datosRecibidos);
                    //alert(datosRecibidos);  
                    if(datosRecibidos == 'true'){ 
                        location.href = "/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=5";
                    } else {
                        location.href = "/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=6";
                    }
                }
            })
        }
    }

    function editar(id) {
        eval("debugger;");
        var datos = {
            id: id
        }
        
        $.ajax({
            url: 'obtenerDatos.php',
            type: 'POST',
            async: false,
            data: datos,
            success: function(datosRecibidos) {
                json = JSON.parse(datosRecibidos);
                //alert(datosRecibidos);
                document.getElementById('editarNombre').value = json.nombreFuncion;
                document.getElementById('editarCodigo').value = json.codigoFuncion;
                document.getElementById('editarLink').value = json.refPagina;
                document.getElementById('imagenGuardada').src = json.refImagen;
                document.getElementById('idPermisoEditar').value = id;                   
            }
        });
    }
</script>

<script>
    $(".custom-file-input").on("change", function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="../../paginadoDataTable.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../../../footer.html";
?>