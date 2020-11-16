<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../header.html"; // <-- Cambia
include "../databaseConection.php"; // <-- Cambia

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 5")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
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

date_default_timezone_set('America/Argentina/Buenos_Aires');
$id_permiso = $_SESSION['usuario']['id_permiso'];
$currentDateTime = date('Y-m-d H:i:s');
$hora = date('H:i:s');
if($hora >= date('06:00:00') && $hora < date('12:00:00')) {
  $saludo = "Buenos días";
} elseif($hora >= date('12:00:00') && $hora < date('20:00:00')){
  $saludo = "Buenas tardes";
} else{
  $saludo = "Buenas noches";
}

?>

<link rel="stylesheet" href="../styleCards.css">

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1><?php echo "$saludo, " . $_SESSION["usuario"]["nombreUsuario"]?></h1>
        <a href="editar_perfil.php" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Editar perfil</a>
    </div>

    <?php
        if(isset($_GET['resultado'])){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
            switch ($_GET['resultado']) {
                case 0:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Se guardaron los datos de asistencia correctamente.</h5>";
                    break;
                          
                default:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Resultado correcto.</h5>";
                    break;
            }
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
        }

        if(isset($_GET['error'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
            switch ($_GET['error']) {
                case 0:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>No tiene permiso para acceder a la función solicitada.</h5>";
                    break;
                case 1:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Ya se tomó asistencia el día de hoy en el curso seleccionado.</h5>";
                    break;
                case 2:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>No se seleccionó ningún curso.</h5>";
                    break;
                case 3:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al guardar los datos de asistencia.</h5>";
                    break;
                case 4:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Ya se revisaron los alumnos libres el día de hoy, intente nuevamente mañana.</h5>";
                    break;
                case 5:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>No es el día u horario de cursado.</h5>";
                    break;
                case 6:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>No se puede generar el reporte. El curso no registra información de alumnos inscriptos ni de asistencias.</h5>";
                    break;
                case 7:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>No se puede generar el reporte. El curso no registra información de asistencias en el periodo seleccionado.</h5>";
                    break;
                case 8:
                    echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>No se puede generar el reporte. El curso no registra información alumnos inscriptos.</h5>";
                    break;
                 
                
                default:
                echo "<h5><i class='fa fa-exclamation-circle mr-2'></i>Error.</h5>";
                    break;
            }
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
        }
    ?>
    
    
    <!-- Page Features -->
    <div>
        <?php
    
        if($id_permiso != NULL || $id_permiso != ""){
            $contador = 0;
            
            //echo "<h3 class='font-weight-normal'>Accesos asignados:</h3><br>";
            
            $selectFuncionPermiso = $con->query("SELECT id_funcion 
                FROM `permisofuncion`, funcion 
                WHERE permisofuncion.id_permiso = '$id_permiso' 
                    AND permisofuncion.fechaDesdePermisoFuncion <= '$currentDateTime' 
                    AND permisofuncion.fechaHastaPermisoFuncion IS NULL 
                    AND funcion.id = permisofuncion.id_funcion 
                    AND funcion.fechaHastaFuncion IS NULL
                ORDER BY nombreFuncion ASC");
            
            if(($selectFuncionPermiso->num_rows) > 0){
                echo "<div class='row text-center'>";
                while ($funcionPermiso = $selectFuncionPermiso->fetch_assoc()) {
                    if ($contador == 4) {
                        $contador = 0;
                    }
                    
                    $id_funcion = $funcionPermiso["id_funcion"];
                    

                $consultaFuncion = $con->query("SELECT * FROM funcion WHERE id='$id_funcion' AND fechaHastaFuncion IS NULL");
                $funcion = $consultaFuncion->fetch_assoc();
                $nombreFuncion = $funcion["nombreFuncion"];
                    $imagenFuncion = $funcion["refImagen"];
                    $paginaFuncion = $funcion["refPagina"];

                echo 
                    "
                    <div class='col-lg-4 col-md-6 mb-4' >
                        <div class='card h-100' >
                        <img class='card-img-top imagen' src='$imagenFuncion' alt='' oncontextmenu='return false'>
                            <div class='card-body'>
                                <h4 class='card-title'>".$nombreFuncion."</h4>
                                <h5 class='font-weight-normal'></h5>
                            </div>
                            <div class='card-footer'>
                                <a href='$paginaFuncion' class='btn btn-primary'><i class='fa fa-chevron-circle-right mr-1'></i>Ingresar</a>
                            </div>
                        </div>
                    </div>";
                    $contador++;
                }
                
                echo "</div>";
            }else{
               echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>El rol asignado, actualmente no tiene funciones disponibles.</h5>
            </div>";
            }
                
        }else{
             echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No tiene rol asignado.</h5>
            </div>";
        }

        ?>

    </div>

</div>

<script src="usuario.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>

<script>
    window.onload = function(){
        verificarPermisoNotificaciones();
        $.ajax({
            url: '/DayClass/Administrador/Justificativos/buscarJustificativos.php',
            type: 'POST',
            success: function(datosRecibidos) {
                //alert(datosRecibidos);
                if(datosRecibidos!=0){
                    //alert("Entra al if");
                    $('.myPopover').popover({
                        placement: 'bottom',
                        title: 'Justificativos',
                        html: true,
                        content: '<a href="/DayClass/Administrador/Justificativos/validar_justificativos.php"><i class="fa fa-exclamation-circle mr-1"></i>Hay justificativos pendientes de revisión ('+datosRecibidos+')</a>'
                    });
                    document.getElementById("nroNoti").innerHTML = datosRecibidos;
                    $('#nroNoti').removeAttr("hidden");
                } else {
                    $('.myPopover').popover({
                        //trigger: 'focus',
                        placement: 'bottom',
                        title: 'Justificativos',
                        html: true,
                        content: '<i class="fa fa-info-circle mr-1"></i>No hay justificativos pendientes de revisión.'
                    });
                }           
            }
        })
    }

    function verificarPermisoNotificaciones(){
        $.ajax({
            url:'verificarPermisoNotificaciones.php',
            type: 'POST',
            async: false,
            //data: datos,
            success:function(datosRecibidos) { 
                json = JSON.parse(datosRecibidos);
                //alert(datosRecibidos);
                if(json.resultado == 1){
                    document.getElementById("notificacionJustificativos").hidden = false;
                }                               
            }
        })
    }
    
    document.getElementById("btnCampana").onclick = function(){
        $("#nroNoti").attr("hidden", "hidden" );
        document.getElementById("nroNoti").innerHTML = 0;
    }

</script>

<?php
include "../footer.html";
?>