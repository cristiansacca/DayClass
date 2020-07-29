<?php
include "../databaseConection.php";
include "class.upload.php";//libreria para subir el archivo excel al servidor

if(isset($_FILES["inpGetFile"])){
    
	$up = new Upload($_FILES["inpGetFile"]);
	
    if($up->uploaded){
		$up->Process("./uploads/");
		if($up->processed){
            /// leer el archivo excel
            require_once 'PHPExcel/Classes/PHPExcel.php';//incluimos la librería PHPExcel con la cual leeremos el archivo y tipo de archivo.
            $archivo = "uploads/".$up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);//abrimos/identificamos el archivo.
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);//creamos un objeto tipo Reader 
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $colNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);
            
            $currentDateTime = date('Y-m-d H:i:s');
            $consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "ALUMNO"');
            $resultado1 = $consulta1->fetch_assoc();
            $id_permiso = $resultado1['id'];
            
            for ($row = 2; $row <= $highestRow; $row++){ 
            
                $dni = $sheet->getCell("A".$row)->getValue();
                $legajo = $sheet->getCell("B".$row)->getValue();
                $apellido = $sheet->getCell("C".$row)->getValue();
                $nombre = $sheet->getCell("D".$row)->getValue();
                $x_row = $row-1;
                
                
                $consulta2 = $con->query("SELECT nombreAlum FROM alumno WHERE dniAlum = '$dni' AND legajoAlumno = '$legajo'");
                $resultado2 = $consulta2->fetch_assoc();
                
                if(mysqli_num_rows($consulta2) == 0){
                    $sql = 'INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`, `permiso_id`) VALUES ("'.$nombre.'","'.$apellido.'", "'.$dni.'","'.$currentDateTime.'","'.$legajo.'",'.$id_permiso.');';
                    $rtdo = $con->query($sql);
                }
                
            }    
    	unlink($archivo);  	
    }
}
}
echo "<script> window.location = 'config_alumno.php' </script>";
////fuente:https://evilnapsis.com/2019/03/20/importar-datos-de-un-excel-a-una-base-de-datos-mysql-con-php/
?>
