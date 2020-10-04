<?php
echo "<div hidden>";
include "../../../databaseConection.php";

include "../../class.upload.php";
//Obtengo los datos del programa
date_default_timezone_set('America/Argentina/Buenos_Aires');

$anioprograma = $_POST["inputAnioPrograma"];
$descripcion = $_POST["inputDescripPrograma"];
$currentDateTime = date('Y-m-d');
$id_materia = $_POST["idMateria"];

$consProgramaAnt = $con->query("SELECT * FROM `programamateria` WHERE programamateria.materia_id = '$id_materia' AND fechaHastaPrograma IS NULL");

//si existe otro programa asociado a esa materia, se lo da de baja 
if(($consProgramaAnt->num_rows) != 0){
    
    $programaAnt = $consProgramaAnt->fetch_assoc();
    $id_programaAnt =  $programaAnt["id"];
    $finalizarProgramaAnt = $con->query("UPDATE `programamateria` SET `fechaHastaPrograma`= '$currentDateTime' WHERE programamateria.materia_id = '$id_materia' AND fechaHastaPrograma IS NULL AND programamateria.id = '$id_programaAnt'");
}

// Se crea la instancia del programa para despues asociarle los temas
$rtdo1 = $con->query("INSERT INTO `programamateria`(`anioPrograma`, `descripcionPrograma`, `fechaDesdePrograma`, `materia_id`) VALUES ('$anioprograma','$descripcion','$currentDateTime','$id_materia');");

$consulta = $con->query("SELECT id FROM programamateria WHERE materia_id = '$id_materia' AND fechaHastaPrograma IS NULL");
$resultado2 = $consulta->fetch_assoc();
$id_programa = $resultado2["id"];


if (isset($_FILES["inpGetFile"])) {

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

            $first_row = 1;

            $unidad = $sheet->getCell("A" . $first_row)->getValue();
            $tema = $sheet->getCell("B" . $first_row)->getValue();

            $contador = 0;

            //Tomo la primer columna solamente
            $unidad_p = strtolower($unidad);
            $tema_p = strtolower($tema);
            
            echo $unidad_p;
            echo $tema_p;
            
            if($unidad_p == "unidad" && $tema_p == "tema"){
                $rtdo2 = false;
                for ($row = 2; $row <= $highestRow; $row++) {
                    $unidadPrograma = $sheet->getCell("A" . $row)->getValue();
                    $temaPrograma = $sheet->getCell("B" . $row)->getValue();
                    
                    if(($unidadPrograma != "" || $unidadPrograma != null) && ($temaPrograma != "" || $temaPrograma != null)){
                        $sql2 = "INSERT INTO `temasmateria`(`nombreTema`, `programaMateria_id`, `unidadTema`) VALUES ('$temaPrograma','$id_programa','$unidadPrograma')";
                        $rtdo2 = $con->query($sql2);
                    }
                    
                }
                
                if($rtdo2){
                    //insercion correcta del tema 
                    //header("Location:/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$id_materia&&resultado=1");
                    echo "<script>location.href='/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$id_materia&&resultado=1'</script>";
                }else{
                    //fallo en la insercion
                    //header("Location:/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$id_materia&&resultado=2");
                    echo "<script>location.href='/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$id_materia&&resultado=2'</script>";
                }
                
            }else{
               //falla en el formato de la hoja de calculo 
                //header("Location:/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$id_materia&&resultado=3");
                echo "<script>location.href='/DayClass/Administrador/MateriaCurso/Materia/verMateria.php?id=$id_materia&&resultado=3'</script>";
            }
            
            unlink($archivo);
        }
    }
}
echo "</div>";
?>