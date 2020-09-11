<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";


//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}
?>

<div class="container">

    <h1 class="display-4 my-3"> Validar Justificativos </h1>

    <div>
        <h4>Justificativos pendientes de evaluación</h4>
        <div id="pendientes" class="my-3">
            
           <img src="image.php?id=<?php echo 1;?>" />
        </div>

    </div>
</div>

<script src="administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>
<?php
include "../../footer.html";
?>