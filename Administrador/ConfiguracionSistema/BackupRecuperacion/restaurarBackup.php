<?php

$lines = null;

//comprobar si hay q returar de un archivo externo o de el que esta guadado en el serverr
if(is_uploaded_file($_FILES['inputSQL']['tmp_name'])){
    //archivo externo
    $filename = $_FILES['inputSQL']['name'];
    move_uploaded_file($_FILES['inputSQL']['tmp_name'],'upload/' . $filename);
    $lines = 'upload/' . $filename;
    $lines = file($lines);
    
}else{
   //archivo guardado en el server 
    $file = glob('backupDB/*');
    if(count($file) !== 0){
        foreach($file as $file){
            if(is_file($file))
                $lines = file($file);
        }
    }else{
        //error de cuando se continua sin haber cargado archivo y no habia copia guardada
        echo 'No hay copia guadada en el sistema, no se ha restaurado.';
        header("Location:/DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=5");
    }
}

if($lines !== null){
    //conectarse como administrador al administrador de BD 
    $enlace = new mysqli("localhost","root","");
    if ($enlace) {
        //tirar la base de datos original
        $dropDB = 'DROP DATABASE dayclass';
        if ($enlace->query($dropDB)){
            echo "La base de datos mi_bd fue eliminada con éxito\n";
            //levantar la nueva base de datos que se llama igual que la que se tiró
            $createDB = 'CREATE DATABASE dayclass';
            if ($enlace->query($createDB)) {
                echo 'La base de datos mi_bd fue creada con éxito\n';
                
                //conectarse a la nueva base de datos creada 
                $conn = new mysqli("localhost","root","","dayclass");
                
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
                    
                    //eliminar todos los archivos que se crearon en la carpeta upload
                    $files = glob('upload/*');
                    foreach($files as $file){ // iterate files
                    if(is_file($file))
                        unlink($file); // delete file
                        echo "eliminado el archivo";
                    }
                    
                    if(!$output['error']){
                        //se restauró correctamente la BD
                        header("Location:/DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=3");
                    }else{
                        //error en la restauracion de la BD
                       //echo $output['message'];
                        header("Location:/DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=4");
                       
                    }
                   
                    
                }else{
                    //error al conectarse a la BD recien creada 
                    //echo 'Error al conectarse a la nueva base de datos';
                    header("Location:/DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=6");
                }

            }else{
               //echo 'Error al crear la base de datos';
                header("Location:/DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=6");
            }
            
        }else{
            //echo 'Error al eliminar la base de datos \n';
            header("Location:/DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=6");
        }

        
    }else{
        //error de conexion a la BD 
        //echo 'Error al conectarse al sistema';
        header("Location:/DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=6");
    }
}

//fuente: http://facturacionweb.site/blog/como-restaurar-una-base-de-datos-mysql-usando-php/
?>