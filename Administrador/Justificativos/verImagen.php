<?php
//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
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
$alumno = $con->query("SELECT * FROM alumno WHERE id = '".$imagen['alumno_id']."'")->fetch_assoc();
setlocale(LC_ALL, 'Spanish');


include "../../header.html";
?>

<div class='container'>
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Datos del justificativo</h1>
        <a href="/DayClass/Administrador/Justificativos/validar_justificativos.php" class="btn btn-secondary"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <button class="btn btn-info"><i class="fa fa-check-square-o mr-1"></i>Validar o rechazar</button>
    </div>

    <table class="table bg-light table-bordered table-sm">
        <tr>
            <td class="font-weight-bold">Alumno:</td>
            <td><?php echo "".$alumno['apellidoAlum'].", ".$alumno['nombreAlum']."" ?></td>
        </tr>
        <tr>
            <td class="font-weight-bold">Legajo:</td>
            <td><?php echo "".$alumno['legajoAlumno']."" ?></td>
        </tr>
        <tr>
            <td class="font-weight-bold">Fecha de presetación:</td>
            <td><?php echo strftime("%d de %B del %Y", strtotime($imagen['fechaPresentacion'])) ?></td>
        </tr>
        <tr>
            <td class="font-weight-bold">Desde:</td>
            <td><?php echo strftime("%d de %B del %Y", strtotime($imagen['fechaDesdeJustificativo'])) ?></td>
        </tr>
        <tr>
            <td class="font-weight-bold">Hasta:</td>
            <td><?php echo strftime("%d de %B del %Y", strtotime($imagen['fechaHastaJustificativo'])) ?></td>
        </tr>
    </table>

    <h4>Imágen:</h4>

    <?php echo "<img class='img-thumbnail rounded p-2 my-2' src='data:image/$mime;base64,".base64_encode($contenido)."'/>"; ?>
</div>

<script src="../administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../footer.html";
?>