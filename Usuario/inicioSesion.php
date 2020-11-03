<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

$nombreRol = "Sin rol asignado";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}else{
    
    //echo $_SESSION["usuario"]["id"];
    
    $selectPermiso = $con->query("select id_permiso from usuario where id = ".$_SESSION["usuario"]["id"]);
    $permiso = $selectPermiso->fetch_assoc();
    $id_permiso = $permiso["id_permiso"];
    
   if( $id_permiso!= NULL || $id_permiso != ""){
       $selectRol = $con->query("SELECT * FROM permiso WHERE permiso.id = '".$id_permiso."'");
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
        <a href="editar_perfil.php" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Editar perfil</a>
    </div>
    
    <h3 class="font-weight-normal">Accesos asignados:</h3><br>
    <!-- Page Features -->
    <div class="row text-center">
        <?php
    
        if($id_permiso != NULL || $id_permiso != ""){
            $contador = 0;
            
            $selectFuncionPermiso = $con->query("SELECT id_funcion FROM `permisofuncion`, funcion WHERE permisofuncion.id_permiso = '$id_permiso' AND permisofuncion.fechaDesdePermisoFuncion <= '$currentDateTime' AND permisofuncion.fechaHastaPermisoFuncion IS NULL AND funcion.id = permisofuncion.id_funcion ORDER BY nombreFuncion ASC");
            
            if(($selectFuncionPermiso->num_rows) != 1){
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
                    "<div class='col-lg-4 col-md-6 mb-4' >
                        <div class='card h-100' >
                        <img class='card-img-top imagen' src='$imagenFuncion' alt='' oncontextmenu='return false'>
                            <div class='card-body'>
                                <h4 class='card-title'>".$nombreFuncion."</h4>
                                <h5 class='font-weight-normal'></h5>
                            </div>
                            <div class='card-footer'>
                                <a href='$paginaFuncion' class='btn btn-success'>Ingresar</a>
                            </div>
                        </div>
                    </div>";
                    $contador++;
                }
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

<?php
include "../footer.html";
?>