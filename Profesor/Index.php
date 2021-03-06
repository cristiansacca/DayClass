<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
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
        <h1><?php echo "$saludo, " . $_SESSION["profesor"]["nombreProf"] /*. " " . $_SESSION["profesor"]["apellidoProf"]*/ ?></h1>
        <a href="editar_perfil.php" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Editar Perfil</a>
    </div>
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

                $consultaCursos = $con->query("SELECT * FROM curso WHERE id='" . $cargos['curso_id'] . "' AND fechaHastaCurActul IS NULL");
                $resultadoCursos = $consultaCursos->fetch_assoc();
                $cargoProf = $con->query("SELECT * FROM cargo WHERE id='" . $cargos['cargo_id'] . "'")->fetch_assoc();

                echo "<div class='col-lg-6 col-md-3 mb-4' >
                    <div class='card color$contador' >
                        <div class='card-body'>
                            <h4 class='card-title'>".$resultadoCursos["nombreCurso"]."</h4>
                            <h5 class='font-weight-normal'>".$cargoProf['nombreCargo']."</h5>
                        </div>
                        <div class='card-footer'>
                            <a href='indexCurso.php?id_curso=".$resultadoCursos["id"]."' class='btn btn-primary btn-lg'>Ingresar</a>
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