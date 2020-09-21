<?php
//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

include "../../databaseConection.php";
//Funcion para recuperar el mime
function fObtenerMime($wfParamCadena){//creamos una función que recibira un parametro en este caso la extensiÃ³n del archivo
    $fsExtension = $wfParamCadena;	
    if  ($fsExtension =='bmp'){ $mime = 'image/bmp'; }
    if  ($fsExtension =='gif' ){ $mime ='image/gif' ; }
    if  ($fsExtension =='jpe' ){ $mime ='image/jpeg' ; }
    if  ($fsExtension =='jpeg'){ $mime = 'image/jpeg' ; }
    if  ($fsExtension =='jpg' ){ $mime ='image/jpeg'; }
    if  ($fsExtension =='png' ){ $mime = 'image/png'; }    
    return $mime;//en base a su extenxiÃ³n la function retornara un tipo de mime 
}

$idImagen = $_GET['id']; //Recuperamos el prametro que contiene el id de la imagen que vamos a consultar.

$result = $con->query("SELECT * FROM justificativo WHERE id = '$idImagen'");//Realizamos una consulta a la imagen seleccionada
$imagen =  $result->fetch_assoc();//recuperamos los registros de la consulta
$mime = fObtenerMime($imagen['extensionImagen']);//Obtenemos el mime del archivo.
$contenido = $imagen['imagenJustificativo'];//Obtenemos el contenido almacenado en el campo Binario.

include "../../header.html";
?>

<div class="container">
    <div class="py-4 my-3 jumbotron bg-light">
        <h1>Justificativo cargado</h1>
        <a class="btn btn-info" href="/DayClass/Alumno/Justificativos/justificativos.php"><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
    </div>
    <?php echo "<img class='img-thumbnail rounded p-2 my-2' src='data:image/$mime;base64,".base64_encode($contenido)."'/>"; ?>
</div>

<script src="../alumno.js"></script>

<?php
include "../modal-autoasistencia.php";
include "../../footer.html";
?>