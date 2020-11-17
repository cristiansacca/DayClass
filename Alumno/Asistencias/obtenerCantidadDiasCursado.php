<?php
include "../../databaseConection.php";

$curso_id = $_POST['id_curso'];
$alumno_id = $_POST['id_alumno'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$consulta1 = $con->query("SELECT * FROM paramminimoasistencia WHERE fechaBajaMinimoAsistencia IS NULL");
$tipoPresente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'PRESENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoAusente = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'AUSENTE' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();
$tipoJustificado = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();

if(($consulta1->num_rows) != 0){
    $porcentajeMinimoAsistencias = ($consulta1->fetch_assoc())['porcentajeAsistencia'];
} else {
    $porcentajeMinimoAsistencias = 0;
}

$fichaAsistencia = $con->query("SELECT * FROM asistencia WHERE curso_id = '$curso_id' AND alumno_id = '$alumno_id' AND 
fechaDesdeFichaAsis <= '$currentDateTime' AND fechaHastaFichaAsis >= '$currentDateTime'")->fetch_assoc();

$ausentes = $con->query("SELECT id FROM asistenciadia WHERE asistencia_id = '".$fichaAsistencia['id']."' AND tipoAsistencia_id = '".$tipoAusente['id']."'");


$cantidadAusentes = ($ausentes->num_rows) /*!== 0 ? ($ausentes->num_rows) : 0*/;

$consultaEstado = $con->query("SELECT nombreUsuario, nombreEstado 
    FROM usuario, curso, alumnocursoactual, cursoestadoalumno, alumnocursoestado
    WHERE usuario.id = '$alumno_id'
        AND curso.id = '$curso_id'
        AND alumnocursoactual.alumno_id = usuario.id
        AND alumnocursoactual.curso_id = curso.id
        AND alumnocursoestado.fechaInicioEstado <= '$currentDateTime 00:00:00'
        AND alumnocursoestado.fechaFinEstado >= '$currentDateTime 23:59:59'
        AND alumnocursoestado.alumnoCursoActual_id = alumnocursoactual.id
        AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id")->fetch_assoc();

$datos = array(
    'diasCursado'=> calcularDiasCursado($curso_id),
    'ausentes' => $cantidadAusentes,
    'minimoAsistencias'=> $porcentajeMinimoAsistencias,
    'estadoAlumno' => $consultaEstado['nombreEstado']
);

$myJSON = json_encode($datos);

echo $myJSON;

function calcularDiasCursado($idCurso){
        include "../../databaseConection.php";

        //contar la cantidad de clases que se tiene por semana
        $selectCantClasesPorSemana = $con->query("SELECT COUNT(id) AS cantDias FROM `horariocurso` WHERE horariocurso.curso_id = '$idCurso'")->fetch_assoc();

        //si hay dias de la semana definidos para ese curso 
        if ($selectCantClasesPorSemana != null) {
            
            //traer todos los dias de la semana que se dicta ese curso
            $selectDiasClasePorSemana = $con->query("SELECT cursodia.dayName FROM `horariocurso`, cursodia WHERE horariocurso.curso_id = '$idCurso' AND cursodia.id = horariocurso.cursoDia_id");
            
            //armar un arreglo con los dias de cursado de la semana 
            $arregloDiasClasePorSemana = [];
            while ($row = $selectDiasClasePorSemana->fetch_assoc()) {
                $dayName = $row["dayName"];
                array_push($arregloDiasClasePorSemana, $dayName);
            }

            //leer la cantidad de clases que hay en una semana 
            $clasesPorSemana = $selectCantClasesPorSemana["cantDias"];

            //traer las fechas de cursado del curso en cuestion 
            $selectFechasCursadoCurso = $con->query("SELECT curso.fechaDesdeCursado, curso.fechaHastaCursado FROM `curso` WHERE curso.id = '$idCurso'")->fetch_assoc();
            $fechaDesdeCursado = $selectFechasCursadoCurso["fechaDesdeCursado"];
            $fechaHastaCursado = $selectFechasCursadoCurso["fechaHastaCursado"];

            //sacar la cantidad de semanas de cursado que hay entre las fechas de cursado
            $semanasCursado = (strtotime($fechaHastaCursado) - strtotime($fechaDesdeCursado)) / (60 * 60 * 24 * 7);

            //redondear el numero de semanas, al entero mas cercano
            $cantSemanasCursado = ceil($semanasCursado);

            //sacar los dias de cursado, multiplicando las semanas de cursado por la cantidad de clases semanales
            $cantDiasCursado = $cantSemanasCursado * $clasesPorSemana;

            //traer los dias sin clases que entran durante el cursado de la materia 
            $selectDiasSinClases= $con->query("SELECT diassinclases.fechaDiaSinClases FROM diassinclases,curso WHERE curso.id = '$idCurso' AND diassinclases.fechaDiaSinClases >= curso.fechaDesdeCursado AND diassinclases.fechaDiaSinClases <= curso.fechaHastaCursado AND diassinclases.fechaBajaDiaSinClases IS NULL");
            
            $cantDiaSinClases = 0;
            
            if(($selectDiasSinClases->num_rows) != 0){
                
                while($diaSinClases = $selectDiasSinClases->fetch_assoc()){
                    $noClasesDay = $diaSinClases["fechaDiaSinClases"];
                    
                    $nombreDiaSinClases = date('l', strtotime($noClasesDay));
                    
                    //echo "Nombre dia sin clases: ".$nombreDiaSinClases;
                    for($i = 0; $i < count($arregloDiasClasePorSemana); $i++){
                        
                        $nombreDiaClases = $arregloDiasClasePorSemana[$i];
                        
                        //echo "Nombre dia de clases: " . $nombreDiaClases;
                        
                        //si el nombre del dia feriado/sinClases coincide un un dia de cusado se aumenta la cantidad de dias sin clases
                        if($nombreDiaClases == $nombreDiaSinClases){
                            $cantDiaSinClases ++;
                            break;
                        }
                    }
                }
            }
            
            
            //se le resta a los dias de cursado calculados (clasePorSemana * cantSemanas) los dias caen feriado o dia sin clases, de los que se cursa esa materia
            $diasEfectivosCursado = $cantDiasCursado - $cantDiaSinClases;
            
            //echo "Cantidad dias cursado: " . $cantDiasCursado;
            
            //echo "Cantidad dias sin clases: " . $cantDiaSinClases;
            
            //echo "Cantidad total de clases: " . $diasEfectivosCursado;
            
            return $diasEfectivosCursado;
        } else {
            //el curso no tiene definido horarios 
            return null;
        }
    }
?>