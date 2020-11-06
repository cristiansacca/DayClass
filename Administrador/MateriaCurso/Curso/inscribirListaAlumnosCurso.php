<?php
//Se inicia o restaura la sesión
session_start();

include "../../../databaseConection.php";
include "../../class.upload.php"; //libreria para subir el archivo excel al servidor
include "../../../header.html";

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 1")->fetch_assoc(); // <-- Cambia
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
include "../../../databaseConection.php";
//include "../../class.upload.php"; //libreria para subir el archivo excel al servidor

date_default_timezone_set('America/Argentina/Buenos_Aires');
$id_curso = $_POST["cursoId"];

$consulta1 = $con->query("SELECT * FROM `curso` WHERE id = '$id_curso'");
$resultado1 = $consulta1->fetch_assoc();
$fchDesde = $resultado1['fechaDesdeCursado'];
$fchHasta = $resultado1['fechaHastaCursado'];

$correcto = [];
$yaInscriptos = [];
$inexistente = [];
$sinPermiso = [];

//echo "llega al archivo";

if (isset($_FILES["inpGetFile"])) {
    
   // echo "entra al if";

    $up = new Upload($_FILES["inpGetFile"]);

    if ($up->uploaded) {
        $up->Process("./uploads/");
        if ($up->processed) {
            /// leer el archivo excel
            require_once '../../PHPExcel/Classes/PHPExcel.php'; //incluimos la librería PHPExcel con la cual leeremos el archivo y tipo de archivo.
            $archivo = "uploads/" . $up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo); //abrimos/identificamos el archivo.
            $objReader = PHPExcel_IOFactory::createReader($inputFileType); //creamos un objeto tipo Reader 
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $colNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);

            $currentDateTime = date('Y-m-d H:i:s');
            $consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "ALUMNO"');
            $resultado1 = $consulta1->fetch_assoc();
            $id_permiso = $resultado1['id'];

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


                    //consultar existencia del alumno (habilitado = fecha de baja null) en la BD  de dayclass
                    $consultaAlumID = $con->query("SELECT * FROM `usuario` WHERE dniUsuario = '$dniA' AND legajoUsuario = '$legajoA' AND fechaBajaUsuario IS NULL");

                    if (mysqli_num_rows($consultaAlumID) == 0) {
                        //si la cosnulta es vacia, el alumno no existe o esta dado de baja, error 2 = alumno inexistente o dado de baja 

                        array_push($inexistente, $legajoA);
                        //echo "entra al de no existe ese alumno";
                    }else{
                        
                        $resultado3 = $consultaAlumID->fetch_assoc();
                        
                        $id_alumno = $resultado3["id"];

                        //verificar que el alumno no vaya a estar inscripto en el ese curso 
                        $consultaAlumCursAct = $con->query("SELECT id FROM `alumnocursoactual` WHERE fechaDesdeAlumCurAc = '$fchDesde' AND fechaHastaAlumCurAc = '$fchHasta' AND alumno_id = $id_alumno AND curso_id = $id_curso");

                        if (mysqli_num_rows($consultaAlumCursAct) == 0) {
                            //si la consulta es vacia, no hay una inscripcion de ese alumno en ese curso en estas fechas actuales
                            
                            //echo "entra al de inscribir";

                            //se crea la instancia de inscripcion del alumno
                            $resultadoInsertAlumCursAct = $con->query("INSERT INTO `alumnocursoactual`(`fechaDesdeAlumCurAc`, `fechaHastaAlumCurAc`, `alumno_id`, `curso_id`) VALUES ('$fchDesde','$fchHasta','$id_alumno','$id_curso')");
                            
                            
                            //se crea la instancia de planilla de asistencia que llevara la cuenta de las asistencias de los alumnos 
                            $resultadoInsertAsist = $con->query("INSERT INTO `asistencia`( `alumno_id`, `curso_id`, `fechaHastaFichaAsis`,`fechaDesdeFichaAsis`) VALUES ('$id_alumno','$id_curso','$fchHasta','$fchDesde')");
                            
                            //se crea la instancia de alumnocursoestado
                                //traigo la instanccia recien creada de AlumnoCursoActual
                            $consultaAlumCurAct = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fchDesde' AND `fechaHastaAlumCurAc` = '$fchHasta' AND `alumno_id` = '$id_alumno' AND `curso_id` = '$id_curso'");
                            $alumnoCursoActual = $consultaAlumCurAct->fetch_assoc();
                            $id_alumnoCursoActual = $alumnoCursoActual['id'];

                                //traigo la instancia de EstadoAlumno con nombre INSCRIPTO
                            $consultaEstadoAlumno = $con->query("SELECT * FROM `cursoestadoalumno` WHERE `nombreEstado` = 'INSCRIPTO'");
                            $estadoAlumno = $consultaEstadoAlumno->fetch_assoc();
                            $id_estadoAlumno = $estadoAlumno['id'];
                            
                                //Creo la instancia de alumnocursoestado
                            $resultadoInsertAlumCursoEstado = $con->query("INSERT INTO `alumnocursoestado`(`fechaFinEstado`, `fechaInicioEstado`, `alumnoCursoActual_id`, `cursoEstadoAlumno_id`) VALUES ('$fchHasta','$fchDesde','$id_alumnoCursoActual','$id_estadoAlumno')");
                            

                            //Se inscribe correctamente
                            array_push($correcto, $legajoA);
                        } else {
                            //error 3 = alumno ya inscripto en esa materia, en ese ciclo lectivo
                            
                           // echo "entra al de agregar ya inscriptos";

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
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Inscripción a curso</h1>
        <a class="btn btn-info" <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso'" ?> ><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
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
    
if(count($sinPermiso) > 0){
    echo "<div class='alert alert-danger mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios sin rol de alumno</h5>
    <ul>";
    
    for ($i=0; $i < count($sinPermiso) ; $i++) { 
       $consultaSinPer = $con->query("SELECT * FROM usuario WHERE legajoUsuario = '".$sinPermiso[$i]."'")->fetch_assoc();
        echo "<li>".$consultaSinPer['apellidoUsuario'].", ".$consultaSinPer['nombreUsuario']."</li>";
    }

    echo "</ul>
    </div>";
}

if(count($yaInscriptos) > 0){
    echo "<div class='alert alert-warning mt-4' role='alert'>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios ya inscriptos</h5>
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
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios inscriptos satisfactoriamente</h5>
    <ul>";
    
    for ($i=0; $i < count($correcto) ; $i++) { 
        $consultaCorrecto = $con->query("SELECT * FROM usuario WHERE legajoUsuario = '".$correcto[$i]."'")->fetch_assoc();
        echo "<li>".$consultaCorrecto['apellidoUsuario'].", ".$consultaCorrecto['nombreUsuario']."</li>";
    }

    echo "</ul>
    </div>";
}
?>

<a class="btn btn-primary" <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso'" ?> ><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>

</div>

<script src="../../administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>

<?php
include "../../../footer.html";
?>
