<?php
//Se inicia o restaura la sesión
session_start();

include "header.html";
include "databaseConection.php";

$nombreRol = "Sin rol asignado";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}else{
    
   if( $_SESSION["usuario"]["id_permiso"] != NULL || $_SESSION["usuario"]["id_permiso"] != ""){
       $selectRol = $con->query("SELECT * FROM permiso WHERE permiso.id = '".$_SESSION["usuario"]["id_permiso"]."'");
       $rol = $selectRol->fetch_assoc();
       $nombreRol = $rol["nombrePermiso"];
   }else{
       
   }
  
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
        <h6>Rol: <?php echo "$nombreRol" ?></h6>
        <h1><?php echo "$saludo, " . $_SESSION["usuario"]["nombreUsuario"]?></h1>
        <a href="editar_perfil.php" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Editar Perfil</a>
    </div>
    
    <h3 class="font-weight-normal">Accesos asignados:</h3><br>
    <!-- Page Features -->
    <div class="row text-center">
        <?php
    
        if($_SESSION["usuario"]["id_permiso"] != NULL || $_SESSION["usuario"]["id_permiso"] != ""){
            
        $id_usuario = $_SESSION['usuario']['id'];
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');
            
        
        }else{
             echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no tiene rol asignado.</h5>
            </div>";
        }

        ?>

    </div>

</div>

<script src="profesor.js"></script>
<script>
    $("#temaDia").attr("hidden", "hidden");
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>

<?php
include "../footer.html";
?>