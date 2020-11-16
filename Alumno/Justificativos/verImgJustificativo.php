<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../header.html"; // <-- Cambia
include "../../databaseConection.php"; // <-- Cambia

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 11")->fetch_assoc(); // <-- Cambia
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
setlocale(LC_ALL, 'Spanish');

if($imagen['fechaRevision'] == null){
    $fechaRevision = 'NO REVISADO';
    $estado = 'NO REVISADO';
    $color = 'font-weight-bold text-dark';
  } else {
    $fechaRevision = strftime("%d/%m/%Y", strtotime($imagen['fechaRevision']));
    if($imagen['aprobado']==1){
        $estado = 'APROBADO';
        $color = 'font-weight-bold text-success';
    }else{
        $estado = 'RECHAZADO';
        $color = 'font-weight-bold text-danger';
    }
  }
?>

<div class="container">
    <div class="py-4 my-3 jumbotron bg-light">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Justificativo cargado</h1>
        <a class="btn btn-info" href="/DayClass/Alumno/Justificativos/justificativos.php"><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
    </div>

    <div class="table-responsive">
        <table class="table bg-light table-bordered">
            <tr>
                <td class="font-weight-bold">Fecha de presetación:</td>
                <td><?php echo strftime("%d/%m/%Y", strtotime($imagen['fechaPresentacion'])) ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Periodo a justificar:</td>
                <td><?php echo strftime("%d/%m/%Y", strtotime($imagen['fechaDesdeJustificativo']))." - ".strftime("%d/%m/%Y", strtotime($imagen['fechaHastaJustificativo'])) ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Fecha de revisión:</td>
                <td><?php echo $fechaRevision ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Estado:</td>
                <td class="<?php echo $color ?>"><?php echo $estado ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Comentario:</td>
                <td class="font-italic"><?php echo $imagen['comentarioJustificativo']==''? 'Sin comentario':$imagen['comentarioJustificativo'].""; ?></td>
            </tr>
        </table>
    </div>

    <div class="my-2">
        <h4>Imagen:</h4>
        <div class="text-center">
            <?php echo "<img class='img-thumbnail rounded p-2 my-2' src='data:image/$mime;base64,".base64_encode($contenido)."'/>"; ?>
        </div>
    </div>
</div>

<script src="../alumno.js"></script>

<script>
  <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>