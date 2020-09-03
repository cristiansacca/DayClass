<?php
include "../databaseConection.php";

include "class.upload.php";
//Obtengo los datos del programa
date_default_timezone_set('America/Argentina/Buenos_Aires');

$anioprograma = $_POST["inputAnioPrograma"];
$cargahoraria = $_POST["inputCargaHoraria"];
$descripcion = $_POST["inputDescripPrograma"];
$currentDateTime = date('Y-m-d H:i:s');
$id_materia = $_POST["selectmaterias"];

//Si existe, se borra la instancia del programa existente relacionado a esa materia
$con->query("DELETE FROM `programamateria` WHERE `programamateria`.`materia_id` = '$id_materia'");

// Se crea el la instancia del programa par despues asociarle los temas
$rtdo1 = $con->query('INSERT INTO `programamateria`(`anioPrograma`,`cargaHorariaMateria`, `descripcionPrograma`, `fechaVigentePrograma`, `materia_id`) VALUES ("' . $anioprograma . '","' . $cargahoraria . '", "' . $descripcion . '","' . $currentDateTime . '","' . $id_materia . '");');
$consulta = $con->query("SELECT id FROM programamateria WHERE materia_id = '$id_materia'");
$resultado2 = $consulta->fetch_assoc();
$id_programa = $resultado2["id"];


if (isset($_FILES["inpGetFile"])) {

    $up = new Upload($_FILES["inpGetFile"]);

    if ($up->uploaded) {
        $up->Process("./uploads/");
        if ($up->processed) {
            /// leer el archivo excel
            require_once 'PHPExcel/Classes/PHPExcel.php'; //incluimos la librería PHPExcel con la cual leeremos el archivo y tipo de archivo.
            $archivo = "uploads/" . $up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo); //abrimos/identificamos el archivo.
            $objReader = PHPExcel_IOFactory::createReader($inputFileType); //creamos un objeto tipo Reader 
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $colNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);

            $first_row = 1;

            $nombreTema = $sheet->getCell("A" . $first_row)->getValue();

            $contador = 0;

            //Tomo la primer columna solamente
            $nombreTema_p = strtolower($nombreTema);
            for ($row = 2; $row <= $highestRow; $row++) {
                $nombreTema = $sheet->getCell("A" . $row)->getValue();
                $sql2 = 'INSERT INTO `temasmateria`(`fechaDesdeTemMat`, `nombreTema`, `programaMateria_id`) VALUES ("' . $currentDateTime . '", "' . $nombreTema . '","' . $id_programa . '");';
                $rtdo2 = $con->query($sql2);
            }

            unlink($archivo);
        }
    }
}

header("location: /DayClass/Administrador/administrar-materia.php");

?>