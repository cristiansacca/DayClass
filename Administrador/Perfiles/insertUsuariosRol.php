<?php
//Se inicia o restaura la sesión
session_start();

include "../../databaseConection.php";
include "../class.upload.php"; //libreria para subir el archivo excel al servidor
include "../../header.html";

//-----------------------------------------------------------------------------------------------------------------------------

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 22")->fetch_assoc(); // <-- Cambia
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


  
?>

<div class="container" hidden>
<?php
include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$id_permiso = $_POST["permisoId"];

$correcto = [];
$yaInscriptos = [];
$inexistente = [];
$cambioRol = [];

//echo "llega al archivo";

if (isset($_FILES["inpGetFile"])) {
    
    $up = new Upload($_FILES["inpGetFile"]);

    if ($up->uploaded) {
        $up->Process("./uploads/");
        if ($up->processed) {
            /// leer el archivo excel
            require_once '../PHPExcel/Classes/PHPExcel.php'; //incluimos la librería PHPExcel con la cual leeremos el archivo y tipo de archivo.
            $archivo = "uploads/" . $up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo); //abrimos/identificamos el archivo.
            $objReader = PHPExcel_IOFactory::createReader($inputFileType); //creamos un objeto tipo Reader 
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $colNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);

            $currentDateTime = date('Y-m-d H:i:s');
            
            $first_row = 1;

            $dni = $sheet->getCell("A" . $first_row)->getValue();
            $legajo = $sheet->getCell("B" . $first_row)->getValue();
            $apellido = $sheet->getCell("C" . $first_row)->getValue();
            $nombre = $sheet->getCell("D" . $first_row)->getValue();

            $contador = 0;

            //valido que la primera fila de la tabla excel sea
            //dni, legajo, apellido nombre, en ese orden, sino esta asi no importa la lista 

            $dni_p = strtolower($dni);
            $legajo_p = strtolower($legajo);
            $nombre_p = strtolower($nombre);
            $apellido_p = strtolower($apellido);

            if (($dni_p == "dni" || $dni_p == "Documento") && $legajo_p == "legajo" && $nombre_p == "nombre" && $apellido_p == "apellido") {
                for ($row = 2; $row <= $highestRow; $row++) {

                    $dniA = $sheet->getCell("A" . $row)->getValue();
                    $legajoA = $sheet->getCell("B" . $row)->getValue();
                    
                    

                    //consultar existencia del usuario(habilitado = fecha de baja null) en la BD  de dayclass
                    $consultaAlumID = $con->query("SELECT * FROM `usuario` WHERE dniUsuario = '$dniA' AND legajoUsuario = '$legajoA' AND fechaBajaUsuario IS NULL");

                    if (($consultaAlumID->num_rows) == 0) {
                        //si la cosnulta es vacia, el usuario no existe o esta dado de baja

                        array_push($inexistente, $legajoA);
                        //echo "entra al de no existe ese alumno";
                    } else {
                        $resultado3 = $consultaAlumID->fetch_assoc();
                        $id_usuario = $resultado3["id"];
                        $id_permisoUsuario = $resultado3["id_permiso"];
                        
                        if($id_permisoUsuario != NULL || $id_permisoUsuario != ""){
                            if($id_permisoUsuario != $id_permiso){
                                array_push($cambioRol, $legajoA);
                            }else{
                                array_push($yaInscriptos, $legajoA);
                            }
                        }else{
                            array_push($correcto, $legajoA);
                        }

                            //se actualiza el rol del alumno
                            $updateRolUsuario = $con->query("UPDATE `usuario` SET `id_permiso`='$id_permiso' WHERE usuario.id = '$id_usuario'");
                        
                    }
                }
            } else {
                 echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en el formato del archivo, por favor cambielo.</h5>
                     </div>";
                //echo "<script> alert('') </script>";
            }

            unlink($archivo);
        }
    }
}
?>
</div>


<div class="container">
<div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo $nombreRol ?></p>
        <h1>Alta de usuarios en rol</h1>
        <a <?php echo "href='/DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso'" ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
<?php
if(count($inexistente) > 0){
    echo "<div class='alert alert-danger mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios inexistentes</h5>
    <ul>";
    
    for ($i=0; $i < count($inexistente) ; $i++) { 
        echo "<li>Legajo: ".$inexistente[$i]." </li>";
    }

    echo "</ul>
    </div>";
}

if(count($cambioRol) > 0){
    echo "<div class='alert alert-warning mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios a los que se les cambio el rol</h5>
    <ul>";
    
    for ($i=0; $i < count($cambioRol) ; $i++) { 
        $consultaIns = $con->query("SELECT * FROM usuario WHERE legajoUusuario = '".$cambioRol[$i]."'")->fetch_assoc();
        echo "<li>".$consultaIns['apellidoUsuario'].", ".$consultaIns['nombreUsuario']."</li>";
    }

    echo "</ul>
    </div>";
}
    
if(count($yaInscriptos) > 0){
    echo "<div class='alert alert-warning mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios que ya poseen este rol</h5>
    <ul>";
    
    for ($i=0; $i < count($yaInscriptos) ; $i++) { 
        $consultaIns = $con->query("SELECT * FROM usuario WHERE legajoUsuario = '".$yaInscriptos[$i]."'")->fetch_assoc();
        echo "<li>".$consultaIns['apellidoUsuario'].", ".$consultaIns['nombreUsuario']."</li>";
    }

    echo "</ul>
    </div>";
}
   


if(count($correcto) > 0){
    echo "<div class='alert alert-success mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios agregados exitosamente</h5>
    <ul>";
    
    for ($i=0; $i < count($correcto) ; $i++) { 
        $consultaCorrecto = $con->query("SELECT * FROM usuario WHERE legajoUsuario = '".$correcto[$i]."'")->fetch_assoc();
        echo "<li>".$consultaCorrecto['apellidoUsuario'].", ".$consultaCorrecto['nombreUsuario']."</li>";
    }

    echo "</ul>
    </div>";
}
?>

<a <?php echo "href='/DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso'" ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>

</div>

<script src="../administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>

<?php
include "../../footer.html";
?>