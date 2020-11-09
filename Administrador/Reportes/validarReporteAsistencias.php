<?php
include "../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');



$fechaDesdeReporte = $_POST['fchDesde'];
$fechaHastaReporte = $_POST['fchHasta'];

$materia = $_POST['materia'];

$resultado = null;

if ($materia == "Todas") {
    //reporte de toda la institucion 
    $resultado = planillaInstitucion($fechaDesdeReporte, $fechaHastaReporte);
} else {
    $curso = $_POST["curso"];
    if ($curso != "vacio") {
        
            $alumno = $_POST["alumno"];

            if ($alumno == "vacio") {
                $resultado = planillaCurso($curso, $fechaDesdeReporte, $fechaHastaReporte);
            } else {
                $resultado = planillaAlumno($curso, $alumno, $fechaDesdeReporte, $fechaHastaReporte);
            }
        
    } else {
        //reporte de todos los cursos de cierta materia
        $resultado = planillaMateria($materia, $fechaDesdeReporte, $fechaHastaReporte);
    }
}


$myJSON = json_encode($resultado);

echo $myJSON;


function planillaAlumno($id_curso, $id_alumno, $fechaDesde, $fechaHasta)
{
    include "../../databaseConection.php";

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentYear = date('Y');

    $fechaDesdeReporte = $fechaDesde;
    $fechaHastaReporte = $fechaHasta . " 23:59:59";


    //Datos asistencias en el periodo seleccionado 
    $selectAsistenciasDiaAlumnoCurso = $con->query("SELECT asistenciadia.id, asistenciadia.fechaHoraAsisDia, tipoasistencia.nombreTipoAsistencia FROM `asistenciadia`, asistencia, usuario, curso, tipoasistencia WHERE usuario.id = '$id_alumno'  AND curso.id = '$id_curso' AND usuario.id = asistencia.alumno_id AND curso.id = asistencia.curso_id AND asistenciadia.asistencia_id = asistencia.id AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id ORDER BY `fechaHoraAsisDia` ASC");
    
    
    if (($selectAsistenciasDiaAlumnoCurso->num_rows) == 0) {
        return false;
    }else{
        return true;
    }       
}


function planillaCurso($id_curso, $fechaDesde, $fechaHasta)
{
    include "../../databaseConection.php";

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentYear = date('Y');

    $fechaDesdeReporte = $fechaDesde;
    $fechaHastaReporte = $fechaHasta . ' 23:59:59';

    //seleccionar todas las fechas de asistencia ese curso 
    $selectFechas = $con->query("SELECT DISTINCT asistenciadia.fechaHoraAsisDia FROM `asistencia`, asistenciadia, curso WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND asistenciadia.asistencia_id = asistencia.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' ORDER BY `fechaHoraAsisDia` ASC");
    
    //verificar que haya alumnos y fechas para generar la tabla 
    if (($selectFechas->num_rows) == 0) {
        return false;
    } else {
        return true;
    }

    
}

function planillaMateria($id_materia, $fechaDesde, $fechaHasta){
    include "../../databaseConection.php";

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentYear = date('Y');


    $fechaDesdeReporte = $fechaDesde;
    $fechaHastaReporte = $fechaHasta . ' 23:59:59';


    //Cursos vigentes y con cursado actualemnte, relacionado a la materia a buscar 
    $selectCursosMateria = $con->query("SELECT curso.id AS idCurso, curso.nombreCurso FROM curso, materia WHERE materia.id = '$id_materia' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate'");

    //cantidad de cursos asociados a esa materia
    $selectCountCursosMateria = $con->query("SELECT COUNT(curso.id) AS cantCursos FROM curso, materia WHERE materia.id = '$id_materia' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate'")->fetch_assoc();
    $cantCursosMateria = $selectCountCursosMateria["cantCursos"];


    $selectAsistenciasMateria = $con->query("SELECT * FROM curso, materia, asistencia, asistenciadia, tipoasistencia WHERE materia.id = '$id_materia' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '2020-11-06' AND asistencia.curso_id = curso.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistencia.id = asistenciadia.asistencia_id AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte'");
    
 
        
    if ($cantCursosMateria == 0 || ($selectAsistenciasMateria->num_rows) == 0) {
        return false;

    } else {
        return true;
    }
    

    
}

function planillaInstitucion($fechaDesde, $fechaHasta){
    include "../../databaseConection.php";

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentYear = date('Y');



    $fechaDesdeReporte = $fechaDesde;
    $fechaHastaReporte = $fechaHasta . ' 23:59:59';

    //cambiar formato fechas 
    $fechaDesdeReporteC = date_create($fechaDesdeReporte);
    $fechaDesdeReporteC =  date_format($fechaDesdeReporteC, "d/m/Y");
    $fechaHastaReporteC = date_create($fechaHastaReporte);
    $fechaHastaReporteC =  date_format($fechaHastaReporteC, "d/m/Y");


    //BUSCAR TODOS LOS DATOS  
    $selectMateria = $con->query("SELECT * FROM `materia` WHERE materia.fechaAltaMateria <= '$currentDate' AND materia.fechaBajaMateria IS NULL ORDER BY materia.nombreMateria ASC");


    
    
    $selectAsistenciasInstitucion = $con->query("SELECT * FROM asistenciadia WHERE asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte'");
    
    
    
        
    if (($selectMateria->num_rows) == 0 && ($selectAsistenciasInstitucion->num_rows) == 0) {

        return false;
    } else {
        return true;
    }

}




?>