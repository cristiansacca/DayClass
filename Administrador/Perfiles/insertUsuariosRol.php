<?php
//Se inicia o restaura la sesión
session_start();

include "../../databaseConection.php";
include "../class.upload.php"; //libreria para subir el archivo excel al servidor
include "../../header.html";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
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
  
?>

<div class="container" hidden>
<?php
include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$id_permiso = $_POST["permisoId"];

$correcto = [];
$yaInscriptos = [];
$inexistente = [];

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
                    $consultaAlumID = $con->query("SELECT id FROM `usuario` WHERE (dniUsuario = '$dniA' AND legajoUsuario = '$legajoA') AND fechaBajaAlumno IS NULL");

                    if (($consultaAlumID->num_rows) == 0) {
                        //si la cosnulta es vacia, el usuario no existe o esta dado de baja

                        array_push($inexistente, $legajoA);
                        //echo "entra al de no existe ese alumno";
                    } else {
                        $resultado3 = $consultaAlumID->fetch_assoc();
                        $id_usuario = $resultado3["id"];

                            //se actualiza el rol del alumno
                            $updateRolUsuario = $con->query("UPDATE `usuario` SET `id_permiso`='$id_permiso' WHERE usuario.id = '$id_usuario'");

                        if ($updateRolUsuario) {
                            //Se asigna correctamente
                            array_push($correcto, $legajoA);
                        } else {
                            //falla en la asignacion
                            array_push($yaInscriptos, $legajoA);
                        }
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

if(count($yaInscriptos) > 0){
    echo "<div class='alert alert-warning mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Falla en la asigancion de rol</h5>
    <ul>";
    
    for ($i=0; $i < count($yaInscriptos) ; $i++) { 
        $consultaIns = $con->query("SELECT * FROM usuario WHERE legajoUusuario = '".$yaInscriptos[$i]."'")->fetch_assoc();
        echo "<li>".$consultaIns['apellidoUsuario'].", ".$consultaIns['nombreUsuario']."</li>";
    }

    echo "</ul>
    </div>";
}

if(count($correcto) > 0){
    echo "<div class='alert alert-success mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Alumnos inscriptos satisfactoriamente</h5>
    <ul>";
    
    for ($i=0; $i < count($correcto) ; $i++) { 
        $consultaCorrecto = $con->query("SELECT * FROM usuario WHERE legajoUsuario = '".$correcto[$i]."'")->fetch_assoc();
        echo "<li>".$consultaCorrecto['apellidoUsuario'].", ".$consultaCorrecto['nombreUsuario']."</li>";
    }

    echo "</ul>
    </div>";
}
?>


</div>

<script src="../administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../footer.html";
?>