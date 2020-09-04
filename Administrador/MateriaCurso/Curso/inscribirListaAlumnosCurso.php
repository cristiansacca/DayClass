<?php
include "../../../databaseConection.php";
include "../../class.upload.php"; //libreria para subir el archivo excel al servidor

date_default_timezone_set('America/Argentina/Buenos_Aires');
$id_curso = $_POST["cursoId"];

$consulta1 = $con->query("SELECT * FROM `curso` WHERE id = '$id_curso'");
$resultado1 = $consulta1->fetch_assoc();
$fchDesde = $resultado1['fechaDesdeCursado'];
$fchHasta = $resultado1['fechaHastaCursado'];

$correcto = [];
$yaInscriptos = [];
$inexistente = [];

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
                    $consultaAlumID = $con->query("SELECT id FROM `alumno` WHERE (dniAlum = '$dniA' AND legajoAlumno = '$legajoA') AND fechaBajaAlumno IS NULL");

                    if (mysqli_num_rows($consultaAlumID) == 0) {
                        //si la cosnulta es vacia, el alumno no existe o esta dado de baja, error 2 = alumno inexistente o dado de baja 

                        array_push($inexistente, $legajoA);
                        //echo "entra al de no existe ese alumno";
                    } else {
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
                            $resultadoInsertAsist = $con->query("INSERT INTO `asistencia`( `alumno_id`, `curso_id`, `fechaHastaFichaAsis`) VALUES ($id_alumno,$id_curso,'$fchHasta')");

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
                echo "<script> alert('Error en el formato del archivo, por favor cambielo') </script>";
            }

            unlink($archivo);
        }
    }
}
include "../../../header.html";
?>


<div class="container">
<?php
if(count($inexistente) > 0){
    echo "<div class='alert alert-danger mt-4' role='alert'>
        <h5>Alumnos inexistentes</h5>
    <ul>";
    
    for ($i=0; $i < count($inexistente) ; $i++) { 
        echo "<li>Legajo: ".$inexistente[$i]." </li>";
    }

    echo "</ul>
    </div>";
}

if(count($yaInscriptos) > 0){
    echo "<div class='alert alert-warning mt-4' role='alert'>
        <h5>Alumnos inscriptos anteriormente</h5>
    <ul>";
    
    for ($i=0; $i < count($yaInscriptos) ; $i++) { 
        $consultaIns = $con->query("SELECT * FROM alumno WHERE legajoAlumno = '".$yaInscriptos[$i]."'")->fetch_assoc();
        echo "<li>".$consultaIns['apellidoAlum'].", ".$consultaIns['nombreAlum']."</li>";
    }

    echo "</ul>
    </div>";
}

if(count($correcto) > 0){
    echo "<div class='alert alert-success mt-4' role='alert'>
        <h5>Alumnos inscriptos satisfactoriamente</h5>
    <ul>";
    
    for ($i=0; $i < count($correcto) ; $i++) { 
        $consultaCorrecto = $con->query("SELECT * FROM alumno WHERE legajoAlumno = '".$correcto[$i]."'")->fetch_assoc();
        echo "<li>".$consultaCorrecto['apellidoAlum'].", ".$consultaCorrecto['nombreAlum']."</li>";
    }

    echo "</ul>
    </div>";
}
?>

<a class="btn btn-primary" <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso'" ?> ><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>

</div>
<?php
include "../../../footer.html";
?>
