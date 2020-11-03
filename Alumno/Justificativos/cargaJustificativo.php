<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../header.html"; // <-- Cambia
include "../../databaseConection.php"; // <-- Cambia

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."'");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 12")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if(!$funcionCorrecta){
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo'])&&isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
  
    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $_SESSION['limite'])
    {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();              
        //Redirigimos pagina.
        header("Location: /DayClass/index.php?resultado=3");
  
        exit();
    }
  }
  $_SESSION['tiempo'] = time();

//-----------------------------------------------------------------------------------------------------------------------------

$file = $_FILES['imgJust']; //Asignamos el contenido del parametro a una variable para su mejor manejo
    
$temName = $file['tmp_name']; //Obtenemos el directorio temporal en donde se ha almacenado el archivo;
$fileName = $file['name']; //Obtenemos el nombre del archivo
$fileExtension = substr(strrchr($fileName, '.'), 1); //Obtenemos la extensión del archivo.

//Comenzamos a extraer la información del archivo
$fp = fopen($temName, "rb");//abrimos el archivo con permiso de lectura
$contenido = fread($fp, filesize($temName));//leemos el contenido del archivo
//Una vez leido el archivo se obtiene un string con caracteres especiales.
$contenido = addslashes($contenido);//se escapan los caracteres especiales
fclose($fp);//Cerramos el archivo

$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'].' 23:59:59';
date_default_timezone_set('America/Argentina/Buenos_Aires');
$hoy = date('Y-m-d');

$justificativo = $con->query("INSERT INTO justificativo (fechaPresentacion, imagenJustificativo, descripcionImagen, extensionImagen, fechaDesdeJustificativo, fechaHastaJustificativo, alumno_id) VALUES ('$hoy','$contenido', '$fileName', '$fileExtension', '$fechaDesde', '$fechaHasta', '".$_SESSION['alumno']['id']."')");
$id_justificativo = $con->insert_id;
$tipoasistencia = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL");

if($justificativo && $id_justificativo!==null && ($tipoasistencia->num_rows)!==0){
    $ausente = $tipoasistencia->fetch_assoc();
    foreach($_POST['materia'] as $id_curso){
        $consulta1 = $con->query("SELECT id FROM asistencia WHERE alumno_id ='".$_SESSION['alumno']['id']."' AND curso_id = '$id_curso'");
        $asistencia = $consulta1->fetch_assoc();   
        
        $consulta2 = $con->query("SELECT * FROM asistenciadia 
        WHERE tipoasistencia_id ='".$ausente['id']."' AND asistencia_id = '".$asistencia['id']."' AND 
        fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'");
        
        while($asistenciadia = $consulta2->fetch_assoc()){

            $con->query("INSERT INTO justificativoasistenciadia (justificativo_id, asistenciaDia_id) 
            VALUES ('$id_justificativo','".$asistenciadia['id']."')");

        }
    }

    header("Location:/DayClass/Alumno/Justificativos/justificativos.php?resultado=1");
    
} else {

    header("Location:/DayClass/Alumno/Justificativos/justificativos.php?resultado=0");

}
?>