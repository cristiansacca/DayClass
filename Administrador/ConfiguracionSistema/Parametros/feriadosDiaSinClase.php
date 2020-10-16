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
        <h1>Días sin clases</h1>
        <a href="config_parametros.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    
    <?php
            if (isset($_GET["resultado"])) {
                switch ($_GET["resultado"]) {
                    case 1:
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Día sin clase creado correctamente.</h5>";
                        break;
                    case 2:
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Error al crear el día sin clases.</h5>";
                        break;
                    case 3:
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Ya existe un día sin clases con el mismo nombre y motivo, modifique el existente.</h5>";
                        break;
                    case 4:
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Día sin clases modificado exitosamente.</h5>";
                        break;
                    case 5:
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Error al modificar día sin clase.</h5>";
                        break;
                    case 6:
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>La baja se realizó correctamente.</h5>";
                        break;
                    case 7:
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja.</h5>";
                        break;     
                }
                echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
            }

        ?>
    
    <a class="btn btn-success mb-3" href="" data-toggle="modal" data-target="#nuevoFeriadoDiaSinClase"><i class="fa fa-plus mr-1"></i>Agregar</a>
    <div class="table-responsive">      
        <?php
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            setlocale(LC_ALL, 'Spanish');
            $currentDate = date('Y-m-d');
                                
            $consulta = $con->query("SELECT * FROM diassinclases WHERE fechaAltaDiaSinClases <= '$currentDate' AND fechaBajaDiaSinClases IS NULL ORDER BY fechaDiaSinClases DESC");
        
            if(!($consulta->num_rows)==0){
        ?>
            <table class="table table-bordered table-secondary">
                <thead>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Día</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    
                    <?php
                        while($feriados = $consulta->fetch_assoc()){
                            $id = $feriados['id'];
                    ?>
                            <tr>
                                <td><?php echo "<label id='evento$id'>".$feriados['comentarioDiaSinClases']."</label>"?></td>
                                <td><?php echo "<label id='fecha$id'>".strftime("%d/%m/%Y", strtotime($feriados['fechaDiaSinClases']))."</label>"?></td>
                                <td><?php echo ucwords(strftime("%A", strtotime($feriados['fechaDiaSinClases'])))?></td>
                                <td><?php echo "<label id='motivo$id'>".$con->query("SELECT nombreMotivoDiaSinClases FROM motivodiasinclases WHERE id = '".$feriados['id_motivo']."'")->fetch_assoc()['nombreMotivoDiaSinClases']."</label>" ?></td>
                                <td>
                                    <button class="btn btn-primary mb-1" <?php echo "onclick='cargarDatos($id)'"; ?> data-toggle="modal" data-target="#editarFeriadoDiaSinClase"><i class="fa fa-edit mr-1"></i>Editar</button>
                                    <button class="btn btn-danger mb-1" <?php echo "onclick='darBaja($id)'"; ?>><i class="fa fa-trash mr-1"></i>Baja</button>
                                </td>
                            </tr>
                    <?php 
                        }; 
                    ?>

                </tbody>
            </table>
        <?php
            } else {
                echo "<br><div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>No se han registrado feriados ni días sin clases.</h5>
                </div> ";
            }
        ?>
        
        

    </div>
</div>

<!-- Modal nuevo feriado -->
<div class="modal fade" id="nuevoFeriadoDiaSinClase" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo día sin clases</h5>
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

<!-- Modal editar -->
<div class="modal fade" id="editarFeriadoDiaSinClase" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title">Editar día sin clases</h5>
            </div>
            <form action="editarDiaSinClases.php" method="POST">
                <div class="modal-body">
                    <div class="my-2">
                        <label>Fecha:</label>
                        <input type="date" placeholder="fecha" name="txtFecha" id="txtFecha" class="form-control" required>
                        <label>Descripción:</label>
                        <input type="text" placeholder="Descripción" name="txtComentario" id="txtComentario" class="form-control" required>
                        <label>Motivo:</label>
                        <select name="cboMotivo" id="cboMotivo" class="custom-select" required>
                            <?php
                                $consultaMotivo = $con->query("SELECT * FROM `motivodiasinclases` WHERE `fechaHastaMotivoDiaSinClases` IS NULL");
                                while ($motivo = $consultaMotivo->fetch_assoc()) {
                                    echo "<option value='" . $motivo["id"] . "'>" . $motivo["nombreMotivoDiaSinClases"] . "</option>";
                                }
                            ?>
                        </select>
                        <input type="text" id="txtId" name="txtId" hidden>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<script>
    function cargarDatos(id){
        document.getElementById("txtId").value = id;
        $.ajax({
            url: 'obtenerDatosDiaSinClases.php',
            type: 'POST',
            data: {id: id},
            success: function(datosRecibidos) {
                json = JSON.parse(datosRecibidos);
                document.getElementById("txtFecha").value = json.fecha;
                document.getElementById("txtComentario").value = json.comentario;    
                document.getElementById("cboMotivo").value = json.motivo;
            }
        })
    }

    function darBaja(id){
        var r = confirm("¿Seguro que quiere gestionar la baja?");
        if (r == true) {
        location.href = "/DayClass/Administrador/ConfiguracionSistema/Parametros/bajaDiaSinClases.php?id="+id;
        }
    }
</script>
<?php
include "../../../footer.html";
?>