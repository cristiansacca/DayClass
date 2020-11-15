<?php
include "../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');


$id_temaAnt = $_POST["idTema"];

$comentario = $_POST["comentario"];
$id_curso = $_POST["id_curso"];
//$id_prof = $_POST["idProfesor"];
//$fechaHoy = date('Y-m-d H:i:s');


if(isset($_POST["nombreTema"])){
    $id_tema = $_POST["nombreTema"];
    if(isset($comentario)){
        $insert = $con->query("UPDATE `temadia` SET `comentarioTema`= '$comentario', `temasMateria_id`= '$id_tema' WHERE `id` = '$id_temaAnt'");
    } else {
        $insert = $con->query("UPDATE `temadia` SET `comentarioTema`= NULL, `temasMateria_id`= '$id_tema' WHERE `id` = '$id_temaAnt'");
    }

}else{
    if(isset($_POST["idTemaEspecial"]) && ($_POST["idTemaEspecial"]) != ""){
        $id_tema = $_POST["idTemaEspecial"];
        
        if(isset($comentario)){
            $insert = $con->query("UPDATE `temadia` SET `comentarioTema`= '$comentario', `temasMateria_id`= '$id_tema' WHERE `id` = '$id_temaAnt'");
        } else {
            $insert = $con->query("UPDATE `temadia` SET `comentarioTema`= NULL, `temasMateria_id`= '$id_tema' WHERE `id` = '$id_temaAnt'");
        } 
    }else{
       if(isset($comentario)){
            $insert = $con->query("UPDATE `temadia` SET `comentarioTema`= '$comentario' WHERE `id` = '$id_temaAnt'");
        } else {
            $insert = $con->query("UPDATE `temadia` SET `comentarioTema`= NULL WHERE `id` = '$id_temaAnt'");
        }  
    }
   
}

if($insert){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
   header("location: /DayClass/Profesor/TemaDia/verTemaDiaAnt.php?id_curso=$id_curso&&resultado=1");
} else {
    header("location: /DayClass/Profesor/TemaDia/verTemaDiaAnt.php?id_curso=$id_curso&&resultado=2");
}

?>