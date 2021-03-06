<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

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
?>

<script src="../../administrador.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
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
                                
            $consulta = $con->query("SELECT * FROM funcion WHERE fechaDesdeFuncion <= '$currentDate' AND fechaHastaFuncion IS NULL ORDER BY funcion.nombreFuncion DESC");
        
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
                        while($funcion = $consulta->fetch_assoc()){
                            $id = $funcion['id'];
                    ?>
                            <tr>
                                <td><?php echo "<label id='evento$id'>".$funcion['nombreFuncion']."</label>"?></td>
                                
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
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>No se han registrado funciones en el sistema.</h5>
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
                <h5 class="modal-title " id="staticBackdropLabel">Nueva función</h5>
            </div>
            <form action="insertFeriadoDiaSinClases.php" method="POST">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="descripcionFeriadoDiaSinClases">Nombre:</label>
                        <input type="Text" placeholder="Nombre" name="inputNombreFuncion" id="inputNombreFuncion" class="form-control" required>
                        
                        <label for="descripcionFeriadoDiaSinClases">Ruta de la funcion:</label>
                        <input type="Text" placeholder="Descripción" name="inputRutaFuncion" id="inputRutaFuncion" class="form-control" required>
                        
                        <label for="descripcionFeriadoDiaSinClases">Imagen:</label>
                        <input type="file" placeholder="Descripción" name="inputIamgenFuncion" id="inputImagenFuncion" class="form-control" required>
                        
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
                <h5 class="modal-title">Editar nombre función</h5>
            </div>
            <form action="editarDiaSinClases.php" method="POST">
                <div class="modal-body">
                    <div class="my-2">
                        <label>Nombre:</label>
                        <input type="text" name="txtComentario" id="txtComentario" class="form-control" required>
                        
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
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
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
                document.getElementById("txtComentario").value = json.comentario;    
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
include "../../footer.html";
?>