<?php
include "../../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$id = $_GET['id'];

//verificar la cantidad de administrativos disponibles en el sistema 
$selectAdminExistentes = $con->query("SELECT * FROM `administrativo` WHERE administrativo.fechaBajaAdm IS NULL");

//si hay mas de un admin en el sistema se procede a la baja 
if(($selectAdminExistentes->num_rows) > 1){
        
	$consulta = $con->query("UPDATE `administrativo` SET `fechaBajaAdm`=' $currentDateTime' WHERE `id`= ".$id);

    if($consulta){
      header("Location:/DayClass/Administrador/ConfiguracionSistema/Administradores/configAdmin.php?resultado=3");

    }else{
        header("Location:/DayClass/Administrador/ConfiguracionSistema/Administradores/configAdmin.php?resultado=4");

    }


    }else{
        //si solo hay un docente asociado al curso, no se lo da de baja  
         header("Location:/DayClass/Administrador/ConfiguracionSistema/Administradores/configAdmin.php?resultado=7");
    }




?>