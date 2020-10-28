<?php
include "../../databaseConection.php";

$funciones = $_POST["arregloFunciones"];

echo $funciones;

$nombrePermiso = $_POST["inputNombrePermiso"];
$nombrePermiso = strtoupper($nombrePermiso);
echo $nombrePermiso;

$arrayLimpio = json_decode($funciones, true);
$tamanioArreglo = count($arrayLimpio);

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = '$nombrePermiso'");

if(($selectPermiso->num_rows) == 0){
    //no existe ese permiso, crear
   $crearPermiso = $con->query("INSERT INTO `permiso`(`fechaDesdePer`, `nombrePermiso`) VALUES ('$currentDateTime','$nombrePermiso')");
    
    if($crearPermiso){
        $selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = '$nombrePermiso' AND fechaDesdePer = '$currentDateTime'");
        
        if($selectPermiso){
            $permiso = $selectPermiso->fetch_assoc();
            $id_permiso = $permiso["id"];
            echo "id permiso creado: $id_permiso";
            
            for($i = 0; $i < $tamanioArreglo; $i++){
        
                $id_funcion = $arrayLimpio[$i];
                
                $insertPermisoFuncion = $con->query("INSERT INTO `permisofuncion`(`id_permiso`, `id_funcion`, `fechaDesdePermisoFuncion`) VALUES ('$id_permiso','$id_funcion','$currentDateTime')");
                
            }
        }
        
    }
    
}else{
    //ya existe ese permiso hay q modificar existente
    echo "entra a else de existente";
}
    
   //header("location: /DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=$id_materia&&resultado=1");	
?>