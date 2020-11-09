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

$codigoFuncion = $_GET['codFn'];

if(isset($codigoFuncion)){
    $href = "";
    switch ($codigoFuncion) {
        case 4:
            $href = "/DayClass/Profesor/TemaDia/temaDelDia.php";
            break;
        case 5:
            $href = "/DayClass/Profesor/Asistencia/habilitar_autoasistencia.php";
            break;
        case 6:
            $href = "/DayClass/Profesor/Asistencia/tradicional.php";
            break;
        case 15:
            $href = "/DayClass/Profesor/PizarraNovedades/pizarra.php";
            break;
        case 16:
            $href = "/DayClass/Profesor/Estadisticas/estadistica_curso.php";
            break;
        case 23:
            $href = "/DayClass/Profesor/Reportes/reporte_curso.php";
            break;
        case 24:
            $href = "/DayClass/Profesor/verDatosCurso.php";
            break;
        
        
        default:
            $href = "/DayClass/Profesor/seleccionCurso.php?error=1";
            break;
    }
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
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
        <p><b>Rol: </b><?php echo $nombreRol; ?></p>
        <h1>Selección de curso</h1>
        <a href="/DayClass/Usuario/inicioSesion.php" class="btn btn-info"><i class="fa fa-arrow-alt-circle-left mr-1"></i>Volver</a>
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
    
    
    <h3 class="font-weight-normal">Cursos que dicta actualmente:</h3><br>
    <!-- Page Features -->
    <div class="row text-center">


        <?php
        
        $id_prof = $_SESSION['usuario']['id'];
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');
        $consultaCargo = $con->query("SELECT * FROM cargoprofesor WHERE profesor_id= '$id_prof' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL");
        
            
        if(mysqli_num_rows($consultaCargo)>0){
            $contador = 0;
            while ($cargos = $consultaCargo->fetch_assoc()) {
                if ($contador == 4) {
                    $contador = 0;
                }

                $consultaCursos = $con->query("SELECT * FROM curso WHERE id='" . $cargos['curso_id'] . "' AND fechaHastaCurActul IS NULL ORDER BY nombreCurso ASC");
                $resultadoCursos = $consultaCursos->fetch_assoc();
                $cargoProf = $con->query("SELECT * FROM cargo WHERE id='" . $cargos['cargo_id'] . "'")->fetch_assoc();

                echo "<div class='col-lg-6 col-md-3 mb-4' >
                    <div class='card color$contador' >
                        <div class='card-body'>
                            <h4 class='card-title'>".$resultadoCursos["nombreCurso"]."</h4>
                            <h5 class='font-weight-normal'>".$cargoProf['nombreCargo']."</h5>
                        </div>
                        <div class='card-footer'>
                            <a href='".$href."?id_curso=".$resultadoCursos['id']."' class='btn btn-primary btn-lg'>Ingresar</a>
                        </div>
                    </div>
                </div>";

                $contador++;
            }

        }else{
             echo "<div class='alert alert-warning text-left' role='alert'  style='width: 100%;'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no lo han asignado a un curso.</h5>
            </div>";
        }

        ?>

    </div>

</div>

<script src="profesor.js"></script>
<script>
    $("#temaDia").attr("hidden", "hidden");
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>

<?php
include "../footer.html";
?>