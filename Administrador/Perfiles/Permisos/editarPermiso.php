<?php
include "../../../databaseConection.php";

//Si se quiere subir una imagen
if (isset($_POST['editarNombre']) && isset($_POST['editarCodigo']) && isset($_POST['editarLink'])) {
    $nombrePermiso = $_POST['editarNombre'];
    $linkPermiso = $_POST['editarLink'];
    $codigoPermiso = $_POST['editarCodigo'];
    $idPermiso = $_POST['idPermisoEditar'];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');

    $consultaNombreFuncion = $con->query("SELECT * FROM funcion WHERE fechaHastaFuncion IS NULL AND nombreFuncion = '$nombrePermiso'");
    $nombreAnterior = $consultaNombreFuncion->fetch_assoc()['nombreFuncion'];
    
    if ((($consultaNombreFuncion->num_rows) == 0) || ($nombrePermiso == $nombreAnterior)) {
        if($_FILES['editarImagen']['name']!=""){
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['editarImagen']['name'];
            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES['editarImagen']['type'];
                $tamano = $_FILES['editarImagen']['size'];
                $temp = $_FILES['editarImagen']['tmp_name'];
                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    echo "Error";
                    header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=3");
                } else {
                    //Si la imagen es correcta en tamaño y tipo
                    //Se intenta subir al servidor
                    if (move_uploaded_file($temp, '../../../images/' . $archivo)) {
                        //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                        chmod('../../../images/' . $archivo, 0777);

                        $update = $con->query("UPDATE funcion 
                        SET nombreFuncion = '$nombrePermiso', refImagen = '/DayClass/images/$archivo', refPagina = '$linkPermiso'
                        WHERE id = '$idPermiso'");

                        if ($update) {
                            echo "Bien";
                            header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=7");
                        } else {
                            echo "Error";
                            header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=8");
                        }
                    } else {
                        echo "Error";
                        header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=8");
                    }
                }
            } else {
                echo "Error";
                header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=8");
            }
        } else {
            $update = $con->query("UPDATE funcion 
            SET nombreFuncion = '$nombrePermiso', refPagina = '$linkPermiso'
            WHERE id = '$idPermiso'");

            if ($update) {
                echo "Bien";
                header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=7");
            } else {
                echo "Error";
                header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=8");
            }
        }
    } else {
        echo "Error";
        header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=4");
    }
} else {
    echo "Error";
    header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=8");
}

?>