<?php
include "../../databaseConection.php";

$tipos = $_POST["arregloTipos"];



$arrayLimpio = json_decode($tipos, true);
$tamanioArreglo = count($arrayLimpio);

$primerElem = $arrayLimpio[0];


$insertParametro = $con->query("INSERT INTO `parametrolegajo`(`id`) VALUES (1)");

if($primerElem == "DNI"){
    $update = $con->query("UPDATE `parametrolegajo` SET `esDNI`= '1',`cantTotalCaracteres`= '8'  WHERE id = '1'");
    
    
}else{
    
    $total =0;
    
    for($i = 0; $i < $tamanioArreglo; $i++ ){
        
        $tipo = $arrayLimpio[$i][0];
        $cantidad = $arrayLimpio[$i][1];
        
        
        if($tipo == "letras"){
            $update = $con->query("UPDATE `parametrolegajo` SET `tieneLetras`= '1',`cantLetras`= '$cantidad' WHERE id = '1'");
        }else{
            $update = $con->query("UPDATE `parametrolegajo` SET `tieneNumeros`= '1',`cantNumeros`= '$cantidad' WHERE id = '1'");
        }
        
        $total = $total + $cantidad;
        
    }
    
   $update = $con->query("UPDATE `parametrolegajo` SET `esDNI`= '0',`cantTotalCaracteres`= '$total' WHERE id = '1'"); 
}

 header("location: /DayClass/Administrador/Parametros/config_parametros.php?resultado=7");

    
?>