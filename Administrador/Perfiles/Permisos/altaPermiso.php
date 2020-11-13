<?php
include "../../../databaseConection.php";

//Si se quiere subir una imagen
if (isset($_POST['inputNombre']) && isset($_POST['inputLink']) && isset($_FILES['inputImagen'])) {
    $nombrePermiso = $_POST['inputNombre'];
    $linkPermiso = $_POST['inputLink'];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');

    $consultaNombreFuncion = $con->query("SELECT * FROM funcion WHERE fechaHastaFuncion IS NULL AND nombreFuncion = '$nombrePermiso'");

    if (($consultaNombreFuncion->num_rows) == 0) {
        $consultaCodigo = $con->query("SELECT MAX(codigoFuncion) as maxCodigo FROM funcion")->fetch_assoc();
        $codigoPermiso = $consultaCodigo['maxCodigo'] + 1;

        //Recogemos el archivo enviado por el formulario
        $archivo = $_FILES['inputImagen']['name'];
        //Si el archivo contiene algo y es diferente de vacio
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['inputImagen']['type'];
            $tamano = $_FILES['inputImagen']['size'];
            $temp = $_FILES['inputImagen']['tmp_name'];
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

                    $insert = $con->query("INSERT INTO funcion (nombreFuncion, codigoFuncion, refImagen, refPagina, fechaDesdeFuncion) 
                VALUES ('$nombrePermiso', '$codigoPermiso', '/DayClass/images/$archivo', '$linkPermiso', '$currentDate')");

                    if ($insert) {
                        echo "Bien";
                        header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=1");
                    } else {
                        echo "Error";
                        header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=2");
                    }
                } else {
                    echo "Error";
                    header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=2");
                }
            }
        } else {
            echo "Error";
            header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=2");
        }
    } else {
        echo "Error";
        header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=4");
    }
} else {
    echo "Error";
    header("location:/DayClass/Administrador/Perfiles/Permisos/permisos.php?resultado=2");
}

?>