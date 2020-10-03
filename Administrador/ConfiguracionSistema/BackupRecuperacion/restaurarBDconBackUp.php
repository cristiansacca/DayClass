<?php
    
    //reventar la base de datos original
    $enlace = new mysqli("localhost","root","");
    if (!$enlace) {
        die('No pudo conectarse: ' . mysql_error());
    }

    $sql = 'DROP DATABASE leandrobd';
    if ($enlace->query($sql)) {
        echo "La base de datos mi_bd fue eliminada con éxito\n";
    } else {
        echo 'Error al eliminar la base de datos \n';
    }

    //levantar la nueva base de datos 
    $sql = 'CREATE DATABASE leandrobd';
    if ($enlace->query($sql)) {
        echo 'La base de datos mi_bd fue creada con éxito\n';
    } else {
        echo 'Error al crear la base de datos\n';
    }

    
    //connection
    $conn = new mysqli("localhost","root","","leandrobd"); 
 
    //variable use to store queries from our sql file
    $sql = '';
    
    //get our sql file
    $file = glob('backupDB/*');
    $lines = null;


    if(count($file) !== 0){
        foreach($file as $file){
            if(is_file($file))
                $lines = file($file);
                echo $file;
        }
    }

   
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
            	$output['error'] = true;
                $output['message'] = $conn->error;
            }
            else{
            	$output['message'] = 'Base de datos restaurada con éxito';
            }
 
            //reset our query variable
            $sql = '';
            
        }
    }

$msjError = $output['message'];
$pos = strpos($msjError,"already exists");

if($pos !== false){
     echo "La cadena 'exists' fue encontrada en la cadena '$msjError'";
         echo " y existe en la posición $pos";
} else {
     echo "La cadena 'exists' no fue encontrada en la cadena '$msjError'";
}

 
?>