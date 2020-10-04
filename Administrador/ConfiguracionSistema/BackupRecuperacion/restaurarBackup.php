<?php

$lines = null;

echo is_uploaded_file($_FILES['inputSQL']['tmp_name']);

if(is_uploaded_file($_FILES['inputSQL']['tmp_name'])){
    //echo "aca esta el file: ".$_FILES["inputSQL"];
    //echo "entra a file isset";
    $filename = $_FILES['inputSQL']['name'];
    move_uploaded_file($_FILES['inputSQL']['tmp_name'],'upload/' . $filename);
    $lines = 'upload/' . $filename;
    $lines = file($lines);
    
}else{
   //get our sql file
    $file = glob('backupDB/*');
    if(count($file) !== 0){
        foreach($file as $file){
            if(is_file($file))
                $lines = file($file);
        }
    }else{
        //error continuaste sin haber copia 
        echo 'No hay copia guadada en el sistema, no se ha restaurado.';
    }
}

if($lines !== null){
    //echo $lines;
    //conectarse como administrador 
    $enlace = new mysqli("localhost","root","");
    if ($enlace) {
        //reventar la base de datos original
        $dropDB = 'DROP DATABASE leandrobd';
        if ($enlace->query($dropDB)){
            echo "La base de datos mi_bd fue eliminada con éxito\n";
            //levantar la nueva base de datos 
            $createDB = 'CREATE DATABASE leandrobd';
            if ($enlace->query($createDB)) {
                echo 'La base de datos mi_bd fue creada con éxito\n';
                
                //conectarse a la nueva base de datos creada 
                $conn = new mysqli("localhost","root","","leandrobd");
                
                if($conn){

                    //variable use to store queries from our sql file
                    $sql = '';

                    //return message
                    $output = array('error'=>false);
                    
                    //loop each line of our sql file
                    foreach ($lines as $line){
                        //skip comments
                        if(substr($line, 0, 2) == '--' || $line == ''){
                            continue;
                        }

                        //add each line to our query
                        $sql .= $line;

                        //check if its the end of the line due to semicolon
                        if (substr(trim($line), -1, 1) == ';'){
                            //perform our query
                            $query = $conn->query($sql);
                            if(!$query){
                                $msjError = $conn->error;
                                $pos = strpos($msjError,"already exists");
                                if($pos !== false){
                                    /*echo "La cadena 'exists' fue encontrada en la cadena '$msjError'";
                                    echo " y existe en la posición $pos";*/
                                    $output['message'] = 'Base de datos restaurada con éxito';
                                }else{
                                    //echo "La cadena 'exists' no fue encontrada en la cadena '$msjError'";
                                    $output['error'] = true;
                                    $output['message'] = $conn->error;
                                }
                            }else{
                                $output['message'] = 'Base de datos restaurada con éxito';
                            }
                            //reset our query variable
                            $sql = '';
                        }
                    }
                    
                    $files = glob('upload/*');
                    foreach($files as $file){ // iterate files
                    if(is_file($file))
                        unlink($file); // delete file
                        echo "eliminado el archivo";
                    }
                    
                    
                   echo $output['message'];
                    
                }else{
                   //error al conectarse a la BD recien creada 
                   echo 'Error al conectarse a la nueva base de datos\n'; 
                }

            }else{
                echo 'Error al crear la base de datos\n';
            }
            
        }else{
            echo 'Error al eliminar la base de datos \n';
        }

        //fuente: http://facturacionweb.site/blog/como-restaurar-una-base-de-datos-mysql-usando-php/
    }else{
        //error de conexion a la BD 
        echo 'Error al conectarse al sistema \n';
    }
}
?>