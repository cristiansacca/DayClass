<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

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
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 11")->fetch_assoc(); // <-- Cambia
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

$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'].' 23:59:59';
date_default_timezone_set('America/Argentina/Buenos_Aires');
$hoy = date('Y-m-d');

$ausente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();

$ausentes = 0;

foreach($_POST['materias'] as $id_curso){
    $consulta1 = $con->query("SELECT id FROM asistencia WHERE alumno_id ='".$_SESSION['usuario']['id']."' AND curso_id = '$id_curso'");
    $asistencia = $consulta1->fetch_assoc();   
    
    $consulta2 = $con->query("SELECT * FROM asistenciadia 
    WHERE tipoasistencia_id ='".$ausente['id']."' AND asistencia_id = '".$asistencia['id']."' AND 
    fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'");
    
    $ausentes = $ausentes + ($consulta2->num_rows);
}

$obj = array(
    'ausentes' => $ausentes,
);

$myJSON = json_encode($obj);

echo $myJSON;

?>