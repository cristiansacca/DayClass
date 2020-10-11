<?php
include "../../databaseConection.php";

$id_justificativo = $_POST['id_justificativo'];
$comentario = $_POST['comentario'];
$validacion = $_POST['validacion'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');
$currentDate = date('Y-m-d');
$tipoJustificado = $con->query("SELECT * FROM tipoasistencia WHERE UPPER(nombreTipoAsistencia) = 'JUSTIFICADO' AND fechaBajaTipoAsistencia IS NULL")->fetch_assoc();

//seleccionar el alumno del justificativo
$selectJustificativo = $con->query("SELECT * FROM justificativo WHERE id = '$id_justificativo'");
$justificativo = $selectJustificativo->fetch_assoc();
$alumno_id = $justificativo["alumno_id"];

$consulta1 = $con->query("SELECT * FROM justificativoasistenciadia WHERE justificativo_id = '$id_justificativo'");

if ($validacion == 1) {
    //registrar que el justificativo esta aprobado
    $update = $con->query("UPDATE `justificativo` SET `aprobado`= 1,`fechaRevision`= '$currentDateTime',
    `comentarioJustificativo`= '$comentario' WHERE id = '$id_justificativo'");
} elseif ($validacion == 0) {
    //registrar que el justificativo fue rechazado
    $update = $con->query("UPDATE `justificativo` SET `aprobado`= 0,`fechaRevision`= '$currentDateTime',
    `comentarioJustificativo`= '$comentario' WHERE id = '$id_justificativo'");
}

if ($update) {
    if ($validacion == 1) {
        //si se aprueba el justificativo, justificar todas las faltas del alumno asociadas al justificativo
        while ($justAsistDia = $consulta1->fetch_assoc()) {
            $con->query("UPDATE asistenciadia SET tipoAsistencia_id = '" . $tipoJustificado['id'] . "' WHERE id = '" . $justAsistDia['asistenciaDia_id'] . "'");
        }

        //INICIO DEL CAMBIO DE ESTADO DEL ALUMNO EN EL CURSO
        //ver si el alumno esta libre en alguna materia
        $selectCursoAlumnoLibre = $con->query("SELECT cursoestadoalumno.nombreEstado, alumnocursoestado.id AS idAlumnoCursoEstado, alumnocursoestado.alumnoCursoActual_id, alumnocursoestado.fechaFinEstado, alumnocursoestado.fechaInicioEstado, curso.id AS idCurso FROM alumnocursoactual, alumno, curso, alumnocursoestado, cursoestadoalumno WHERE alumno.id = '$alumno_id' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDate' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDate' AND (alumnocursoactual.fechaDesdeAlumCurAc <= alumnocursoestado.fechaInicioEstado) AND (alumnocursoactual.fechaHastaAlumCurAc >= alumnocursoestado.fechaFinEstado) AND alumnocursoestado.fechaInicioEstado <= '$currentDate' AND alumnocursoestado.fechaFinEstado > '$currentDate' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'LIBRE'");

        //el alumno esta libre en algun curso en el que esta inscripto
        if (($selectCursoAlumnoLibre->num_rows) != 0) {
            //traer el parametro minimo de asistencia
            $selectParamMinimoAsistencia = $con->query("SELECT * FROM `paramminimoasistencia` WHERE paramminimoasistencia.fechaAltaMinimoAsistencia <= '$currentDate' AND paramminimoasistencia.fechaBajaMinimoAsistencia IS NULL")->fetch_assoc();
            $porcentajeMinAsistencia = $selectParamMinimoAsistencia["porcentajeAsistencia"];

            //traer datos del estado del alumno
            $cursoAlumnoLibre = $selectCursoAlumnoLibre->fetch_assoc();
            $id_curso = $cursoAlumnoLibre["idCurso"];
            $id_alumnoCursoEstado = $cursoAlumnoLibre["idAlumnoCursoEstado"];
            $fechaFinAlumnoCursoEstado = $cursoAlumnoLibre["fechaFinEstado"];
            $id_alumnoCursoActual = $cursoAlumnoLibre["alumnoCursoActual_id"];

            //calcular los dias de cursado del curso en el que el alumno esta libre
            $totalDiasCursado = calcularDiasCursado($id_curso);

            if ($totalDiasCursado != null) {
                $selectCantInasistenciasAlumno = $con->query("SELECT COUNT(asistenciadia.tipoAsistencia_id) AS cantAusentes FROM asistencia, asistenciadia, tipoasistencia WHERE asistencia.alumno_id = '$alumno_id' AND asistencia.curso_id = '$id_curso' AND asistenciadia.asistencia_id = asistencia.id AND asistencia.fechaDesdeFichaAsis <= asistenciadia.fechaHoraAsisDia AND asistencia.fechaHastaFichaAsis >= asistenciadia.fechaHoraAsisDia AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'AUSENTE'");

                $selectCantInasistenciasAlumno2 = $selectCantInasistenciasAlumno->fetch_assoc();
                $cantAusentes = $selectCantInasistenciasAlumno2["cantAusentes"];
                $rtdoCompararDias = compararDias($porcentajeMinAsistencia, $totalDiasCursado, $cantAusentes);

                switch ($rtdoCompararDias) {
                    case "REINCORPORAR":
                        $resultado = reincorporarAlumnoCurso($id_alumnoCursoEstado, $fechaFinAlumnoCursoEstado, $id_alumnoCursoActual);
                        if ($resultado) {
                            //el alumno es reincoporado
                            echo 1;
                        } else {
                            //error al reincorporar al alumno, tratar manualmente
                            echo 2;
                        }
                        break;

                    default:
                        //el alumno sigue estando libre, con la justificacion no alcanza para reincorporar
                        echo 1;
                        break;
                }
            }
        } else {
            //el alumno no esta libre en ninguna materia
            echo 1;
        }
    }
} else {
    //error al cargar la validacion del justificativo
    echo 0;
}

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
        $selectDiasSinClases = $con->query("SELECT diassinclases.fechaDiaSinClases FROM diassinclases,curso WHERE curso.id = '$idCurso' AND diassinclases.fechaDiaSinClases >= curso.fechaDesdeCursado AND diassinclases.fechaDiaSinClases <= curso.fechaHastaCursado AND diassinclases.fechaBajaDiaSinClases IS NULL");

        $cantDiaSinClases = 0;

        if (($selectDiasSinClases->num_rows) != 0) {

            while ($diaSinClases = $selectDiasSinClases->fetch_assoc()) {
                $noClasesDay = $diaSinClases["fechaDiaSinClases"];

                $nombreDiaSinClases = date('l', strtotime($noClasesDay));

                //echo "Nombre dia sin clases: ".$nombreDiaSinClases;
                for ($i = 0; $i < count($arregloDiasClasePorSemana); $i++) {

                    $nombreDiaClases = $arregloDiasClasePorSemana[$i];

                    //echo "Nombre dia de clases: " . $nombreDiaClases;

                    //si el nombre del dia feriado/sinClases coincide un un dia de cusado se aumenta la cantidad de dias sin clases
                    if ($nombreDiaClases == $nombreDiaSinClases) {
                        $cantDiaSinClases++;
                        break;
                    }
                }
            }
        }


        //se le resta a los dias de cursado calculados (clasePorSemana * cantSemanas) los dias caen feriado o dia sin clases, de los que se cursa esa materia
        $diasEfectivosCursado = $cantDiasCursado - $cantDiaSinClases;

        return $diasEfectivosCursado;
    } else {
        //el curso no tiene definido horarios 
        return null;
    }
}


function compararDias($porcentajeMinAsistencia, $totalDiasCursado, $cantInasistenciasAlumno){
    //calculo de dias 
    $porcentajeInasistencias = 1 - $porcentajeMinAsistencia;
    $maxInasistencias = ceil($totalDiasCursado * $porcentajeInasistencias);

    if ($cantInasistenciasAlumno <= $maxInasistencias) {
        //el alumno esta en el limite, enviar informativo de que no le quedan mas inasistencias
        return "REINCORPORAR";
    } else {
        return "NADA";
    }
}

function reincorporarAlumnoCurso($id_alumnoCursoEstado, $fechaFinAlumnoCursoEstado, $id_alumnoCursoActual){
    include "../../databaseConection.php";
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d');

    //actulizar la fecha hasta del estado Libre hasta hoy 
    $updateAlumnoCursoEstado = $con->query("UPDATE `alumnocursoestado` SET `fechaFinEstado`='$currentDateTime' WHERE `id` = $id_alumnoCursoEstado");

    if ($updateAlumnoCursoEstado) {
        //crear una instancia nueva de estado, relacionada a estado = Inscripto, a partir de hoy y hasta el fin del cursado
        $insertAlumnoCursoEstado = $con->query("INSERT INTO `alumnocursoestado`(`fechaFinEstado`, `fechaInicioEstado`, `alumnoCursoActual_id`, `cursoEstadoAlumno_id`) VALUES ('$fechaFinAlumnoCursoEstado','$currentDateTime','$id_alumnoCursoActual','1')");

        if ($insertAlumnoCursoEstado) {
            //se reincorporo al alumno en el curso 
            return true;
        } else {
            //error crear la nueva instancia de estado inscripto
            return false;
        }
    } else {
        //error al finalizar el estado libre
        return false;
    }
}

?>