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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 12")->fetch_assoc(); // <-- Cambia
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
$alumno = $con->query("SELECT * FROM usuario WHERE id = '".$imagen['alumno_id']."'")->fetch_assoc();
setlocale(LC_ALL, 'Spanish');

include "../../header.html";
?>

<div class='container'>
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo $nombreRol ?></p>
        <h1>Datos del justificativo</h1>
        <a href="/DayClass/Administrador/Justificativos/validar_justificativos.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div class="jumbotron mb-4 py-4">
        <h5>Evaluación</h5>
        <input class="form-control mb-2" id="txtComentario" type="text" name="txtComentario" placeholder="Comentario (Opcional)">
        <button class="btn btn-danger" id="btnRechazar"><i class="fa fa-times-circle mr-1"></i>Rechazar</button>
        <button class="btn btn-success" id="btnValidar"><i class="fa fa-check-circle mr-1"></i>Validar</button>
        <input type="text" id="idJustificativo" <?php echo "value='$idImagen'"; ?> hidden>   
    </div>

    <div class="table-responsive">
        <table class="table bg-light table-bordered">
            <tr>
                <td class="font-weight-bold">Alumno:</td>
                <td><?php echo "".$alumno['apellidoUsuario'].", ".$alumno['nombreUsuario']."" ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Legajo:</td>
                <td><?php echo "".$alumno['legajoUsuario']."" ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Fecha de presetación:</td>
                <td><?php echo strftime("%d de %B del %Y", strtotime($imagen['fechaPresentacion'])) ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Periodo a justificar:</td>
                <td><?php echo strftime("%d/%m/%Y", strtotime($imagen['fechaDesdeJustificativo']))." - ".strftime("%d/%m/%Y", strtotime($imagen['fechaHastaJustificativo'])) ?></td>
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

<script src="../administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>


<script>
    document.getElementById("btnValidar").onclick = function () {
        setValidacion(1);
    }

    document.getElementById("btnRechazar").onclick = function () {
        setValidacion(0);
    }

    function setValidacion(valor) {
        var idJust = document.getElementById("idJustificativo").value;
        var comentario = document.getElementById("txtComentario").value;
        var validacion = valor;
        var datos = {
            id_justificativo: idJust,
            comentario: comentario,
            validacion: validacion
        }
        $.ajax({
            url: 'cargaValidacion.php',
            type: 'POST',
            data: datos,
            success: function(datosRecibidos) {
                location.href="/DayClass/Administrador/Justificativos/validar_justificativos.php?resultado="+datosRecibidos;
            }
        })
    }

</script>

<?php
include "../../footer.html";
?>