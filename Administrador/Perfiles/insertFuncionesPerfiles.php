<?php
include "../../databaseConection.php";


$id_permiso = $_POST["permisoId"];
$funciones = $_POST["arregloFunciones"];

echo $funciones;

$arrayLimpio = json_decode($funciones, true);
$tamanioArreglo = count($arrayLimpio);

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$selectPermiso = $con->query("SELECT * FROM permiso WHERE permiso.id = '$id_permiso'");
$selectFuncionesPermiso = $con->query("SELECT * FROM `permisofuncion` WHERE `id_permiso` = '$id_permiso' AND `fechaDesdePermisoFuncion` <= '$currentDate' AND `fechaHastaPermisoFuncion` IS NULL");

echo "SELECT * FROM `permisofuncion` WHERE `id_permiso` = '$id_permiso' AND `fechaDesdePermisoFuncion` <= '$currentDate' AND `fechaHastaPermisoFuncion` IS NULL";

if(($selectFuncionesPermiso->num_rows) == 0){
    //el permiso no tenia funciones asociadas, crear permisoFuncion
   for($i = 0; $i < $tamanioArreglo; $i++){
       $id_funcion = $arrayLimpio[$i];
       $insertPermisoFuncion = $con->query("INSERT INTO `permisofuncion`(`id_permiso`, `id_funcion`, `fechaDesdePermisoFuncion`) VALUES ('$id_permiso','$id_funcion','$currentDate')");
    }
    
    header("location: /DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=1");	
    
}else{
    //bajar las funciones existentes y levantar las nuevas 
    echo "entra a else de existente";
    
    while($funcionesPermiso = $selectFuncionesPermiso->fetch_assoc()){
        $id_permisoFuncion = $funcionesPermiso["id"];
        echo $id_permisoFuncion;
        $updatePermisoFuncion = $con->query("UPDATE `permisofuncion` SET `fechaHastaPermisoFuncion`= '$currentDate' WHERE permisofuncion.id = '$id_permisoFuncion'");
    }
    
    for($i = 0; $i < $tamanioArreglo; $i++){
       $id_funcion = $arrayLimpio[$i];
       $insertPermisoFuncion = $con->query("INSERT INTO `permisofuncion`(`id_permiso`, `id_funcion`, `fechaDesdePermisoFuncion`) VALUES ('$id_permiso','$id_funcion','$currentDate')");
    }
    
    header("location: /DayClass/Administrador/Perfiles/verPerfil.php?id_permiso=$id_permiso&&resultado=1");
    
}
    
   //header("location: /DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=$id_materia&&resultado=1");	
?>