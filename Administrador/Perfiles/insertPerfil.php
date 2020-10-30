<?php
include "../../databaseConection.php";

$nombrePermiso = $_POST["inputNombrePermiso"];
$nombrePermiso = strtoupper($nombrePermiso);
echo $nombrePermiso;



date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = '$nombrePermiso'");

if(($selectPermiso->num_rows) == 0){
    //no existe ese permiso, crear
   $crearPermiso = $con->query("INSERT INTO `permiso`(`fechaDesdePer`, `nombrePermiso`) VALUES ('$currentDateTime','$nombrePermiso')");
    
    if($crearPermiso){
        //creacion exitosa del permiso
         header("Location:/DayClass/Administrador/Perfiles/perfiles.php?resultado=1");
    }else{
        //falla en la creacion del permiso
         header("Location:/DayClass/Administrador/Perfiles/perfiles.php?resultado=2");
    }
    
}else{
    //ya existe ese permiso
    
    header("Location:/DayClass/Administrador/Perfiles/perfiles.php?resultado=5");
}
?>