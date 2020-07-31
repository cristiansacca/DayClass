<?php
include "../databaseConection.php";
include "class.upload.php";//libreria para subir el archivo excel al servidor

if(isset($_FILES["inpGetFile"])){
    echo "<script> alert('EEEEEEEENTRA AL IF') </script>";
    
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
            $consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "DOCENTE"');
            $resultado1 = $consulta1->fetch_assoc();
            $id_permiso = $resultado1['id'];
            
            $first_row = 1;
            
            $dni = $sheet->getCell("A".$first_row)->getValue();
            $legajo = $sheet->getCell("B".$first_row)->getValue();
            $apellido = $sheet->getCell("C".$first_row)->getValue();
            $nombre = $sheet->getCell("D".$first_row)->getValue();
            
            
            $contador = 0;
            
            //valido que la primera fila de la tabla excel sea
            //dni, legajo, apellido nombre, en ese orden, sino esta asi no importa la lista 
            
            $dni_p = strtolower($dni);
            $legajo_p = strtolower($legajo);
            $nombre_p=strtolower($nombre);
            $apellido_p = strtolower($apellido);
            
           if(( $dni_p == "dni" || $dni_p == "documento") && $legajo_p == "legajo" && $nombre_p == "nombre" && $apellido_p == "apellido"){
                for ($row = 2; $row <= $highestRow; $row++){ 
            
                $dni = $sheet->getCell("A".$row)->getValue();
                $legajo = $sheet->getCell("B".$row)->getValue();
                $apellido = $sheet->getCell("C".$row)->getValue();
                $nombre = $sheet->getCell("D".$row)->getValue();
                
                
                $consulta2 = $con->query("SELECT nombreProf FROM  profesor WHERE dniProf = '$dni' AND legajoProf = '$legajo'");
                $resultado2 = $consulta2->fetch_assoc();
                
                    if(mysqli_num_rows($consulta2) == 0 && $apellido != ""){
                        $sql = 'INSERT INTO `profesor`(`nombreProf`,`apellidoProf`, `dniProf`, `fechaAltaProf`, `legajoProf`, `permiso_id`) VALUES ("'.$nombre.'","'.$apellido.'", "'.$dni.'","'.$currentDateTime.'","'.$legajo.'",'.$id_permiso.');';
                        
                        $rtdo = $con->query($sql);
                    }else{
                       $contador = $contador + 1; 
                    }
                
                }    
            }else{
                echo "<script> alert('EEEEEEEERror en el formato de la primera fila') </script>";
        }
            
            
            
           
            
    	unlink($archivo);  	
    }
}
}
echo "<script> window.location = 'config_profesores.php' </script>";
////fuente:https://evilnapsis.com/2019/03/20/importar-datos-de-un-excel-a-una-base-de-datos-mysql-con-php/
?>
