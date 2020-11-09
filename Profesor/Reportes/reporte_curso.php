<?php

include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$currentDateTime = date('Y-m-d H:i:s');
$currentYear = date('Y');

$id_curso = $_GET["id_curso"];

//Datos curso
$selectCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$id_curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate'");
$curso = $selectCurso->fetch_assoc();
$nombreCurso = utf8_decode($curso["nombreCurso"]);

$fechaDesdeReporte = $curso["fechaDesdeCursado"];
$fechaHastaReporte = $currentDate . ' 23:59:59';

//seleccionar todas las fechas de asistencia ese curso 
$selectFechas = $con->query("SELECT DISTINCT asistenciadia.fechaHoraAsisDia FROM `asistencia`, asistenciadia, curso WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND asistenciadia.asistencia_id = asistencia.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' ORDER BY `fechaHoraAsisDia` ASC");

//Datos asistencias, de los alumnos en el periodo seleccionado
$selectAsistenciasAlumnoCurso = $con->query("SELECT asistencia.id AS idAsistencia, usuario.id, usuario.nombreUsuario, usuario.apellidoUsuario, usuario.legajoUsuario FROM usuario, asistencia, curso WHERE curso.id = '$id_curso' AND curso.id = asistencia.curso_id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistencia.alumno_id = usuario.id ORDER BY usuario.apellidoUsuario ASC");


//cambiar formato fechas 
$fechaDesdeReporteC =date_create($fechaDesdeReporte);
$fechaDesdeReporteC =  date_format($fechaDesdeReporteC,"d/m/Y");
$fechaHastaReporteC =date_create($fechaHastaReporte);
$fechaHastaReporteC =  date_format($fechaHastaReporteC,"d/m/Y");


//crear un arreglo con todas las fechas y horas de asistencia 
$arregloFechasHoras = [];
while($row = $selectFechas ->fetch_assoc()){
    
    $fechaHora = $row["fechaHoraAsisDia"];
    array_push($arregloFechasHoras, $fechaHora);
    
}

//crear un arreglo con todos los ID de las planillas de asistencia de ese curso 
$arregloIdAsistencias = [];
while($alumnosAsistencia = $selectAsistenciasAlumnoCurso->fetch_assoc()){

    $id_asistencia = $alumnosAsistencia["idAsistencia"];
    array_push($arregloIdAsistencias, $id_asistencia);
    
}

//verificar que haya alumnos y fechas para generar la tabla 
if(count($arregloFechasHoras) != 0 && count($arregloIdAsistencias) != 0){

//libreria de FPDF 
require_once( "../../fpdf/fpdf.php" );

// Begin configuration
$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );

$reportName = "Reporte de asistencias de un curso.";
$reportNameYPos = 160;

$logoFile = "logoDayclass.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;


/*Create the title page PORTADA*/
$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// Logo
$pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );

//Report Name
$pdf->SetFont( 'Arial', 'B', 20);
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->Ln();
$pdf->Cell( 0 ,25, "$nombreCurso - $currentYear ",0,0, 'C' );
$pdf->Ln();


/*Create the page header, main heading, and intro text*/
//se crea la hoja que va a llevar la tabla 
$pdf->AddPage('L', 'Legal');
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 12 );


//datos del reporte 

$pdf->Ln(2);

$pdf->Ln(16);

$pdf->SetFont( 'Arial', '', 12 );
$currentDateTime = date_create($currentDateTime);
$currentDateTime =  date_format($currentDateTime,"d/m/Y H:i:s");
$pdf->Write(10, "Fecha: $currentDateTime" );
$pdf->Ln(7);
$pdf->Write( 6, "Curso: $nombreCurso" );
$pdf->Ln(5);
$pdf->Write( 6, "Fechas Reporte: $fechaDesdeReporteC - $fechaHastaReporteC" );
$pdf->Ln(5);
$pdf->Write( 6, "Referencias:" );
$pdf->Ln(5);
$pdf->Write( 6, "P = Presente, A = Ausente, J = Justificado, N = No Registra asistencia" );
$pdf->Ln(10);



    
//calcular el tamaño de las celdas en funcion de la cantidad de registros 
$anchoCol = 9.5;
$cantColumnas = $selectFechas->num_rows;

if($cantColumnas <= 15){
    $anchoCol = 18;
}else{
    if($cantColumnas > 15 && $cantColumnas <= 20){
        $anchoCol = 15;
    }
}



$cantFechas = count($arregloFechasHoras);
$cont = 0;
while($cont < $cantFechas){
    $nroOrden = $cantFechas - $cont;
    
    if($nroOrden <= 30){
        //cabecera de la tabla del reporte
        $pdf->SetFillColor(148, 112, 220);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 6, 'Alumnos | Fecha', 1, 0, 'L', 1);

        $pdf->SetFont('Arial', '', 7);
        
        for($i = $cont; $i < $cantFechas; $i++){
            $fecha = $arregloFechasHoras[$i];
            $fecha = date_create($fecha);
            $fecha = date_format($fecha,"d/m/Y");

            $fechaCorta = substr($fecha, 0, 5);

            $pdf->Cell($anchoCol, 6, $fechaCorta, 1, 0, 'C', 0);
        }
        $pdf->Ln(6);

        $pdf->SetFont('Arial', '', 7);

        for($j = 0; $j < count($arregloIdAsistencias); $j ++){
            
            $id_asistencia = $arregloIdAsistencias[$j];
            
            $selectAlumno = $con->query("SELECT usuario.legajoUsuario, usuario.apellidoUsuario, usuario.nombreUsuario FROM `asistencia`, usuario WHERE asistencia.id = '$id_asistencia' AND asistencia.alumno_id = usuario.id");

            $alumno = $selectAlumno->fetch_assoc();

            $nombreAlumno = utf8_decode($alumno["nombreUsuario"]);
            $apellidoAlumno = utf8_decode($alumno["apellidoUsuario"]);
            $legajoAlumno = $alumno["legajoUsuario"];
            $index = $j +1;

            $nombreLista = "$index) $legajoAlumno - $nombreAlumno $apellidoAlumno";

            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(40, 6, $nombreLista , 1, 0, 'L', 0);

            for($i = $cont; $i < $cantFechas; $i++){
                    $fecha = $arregloFechasHoras[$i];
                    $fechaCorta = substr($fecha, 0, 10);

                    $selectAsistenciasDiaAlumno = $con->query("SELECT tipoasistencia.nombreTipoAsistencia FROM asistenciadia, tipoasistencia WHERE asistenciadia.asistencia_id = '$id_asistencia' AND asistenciadia.fechaHoraAsisDia LIKE '$fechaCorta%' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id");

                    $selectAsistenciasAlumnoCurso2= $selectAsistenciasDiaAlumno->fetch_assoc();

                    if(($selectAsistenciasDiaAlumno->num_rows)!=0){
                        $tipoAsistencia = $selectAsistenciasAlumnoCurso2['nombreTipoAsistencia'];
                    } else {
                        $tipoAsistencia = "";
                    }

                        switch($tipoAsistencia){
                            case "PRESENTE":
                                $pdf->SetTextColor(0,183,6);
                                $pdf->Cell($anchoCol, 6, 'P', 1, 0, 'C', 0);
                                break;

                            case "AUSENTE":
                                $pdf->SetTextColor(250,78,58);
                                $pdf->Cell($anchoCol, 6, 'A', 1, 0, 'C', 0);
                                break;

                            case "JUSTIFICADO":
                                $pdf->SetTextColor(228,207,0);
                                $pdf->Cell($anchoCol, 6, 'J', 1, 0, 'C', 0);
                                break;

                            default:
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Cell($anchoCol, 6, 'N', 1, 0, 'C', 0);
                                break;

                            }

            }
            $pdf->Ln(6);
        }
 
    }else{
        $contAux = $cont + 30;
        //cabecera de la tabla del reporte
        $pdf->SetFillColor(148, 112, 220);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 6, 'Alumnos | Fecha', 1, 0, 'L', 1);

        $pdf->SetFont('Arial', '', 7);
        for($i = $cont; $i < $contAux; $i++){
            $fecha = $arregloFechasHoras[$i];
            $fecha = date_create($fecha);
            $fecha = date_format($fecha,"d/m/Y");

            $fechaCorta = substr($fecha, 0, 5);

            $pdf->Cell($anchoCol, 6, $fechaCorta, 1, 0, 'C', 0);
        }
        $pdf->Ln(6);

        $pdf->SetFont('Arial', '', 7);

         for($j = 0; $j < count($arregloIdAsistencias); $j ++){
            
            $id_asistencia = $arregloIdAsistencias[$j];

            $selectAlumno = $con->query("SELECT usuario.legajoUsuario, usuario.apellidoUsuario, usuario.nombreUsuario FROM `asistencia`, usuario WHERE asistencia.id = '$id_asistencia' AND asistencia.alumno_id = usuario.id");

            $alumno = $selectAlumno->fetch_assoc();

            $nombreAlumno = utf8_decode($alumno["nombreUsuario"]);
            $apellidoAlumno = utf8_decode($alumno["apellidoUsuario"]);
            $legajoAlumno = $alumno["legajoUsuario"];
            $index = $j +1;

            $nombreLista = "$index) $legajoAlumno - $nombreAlumno $apellidoAlumno";

            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(40, 6, $nombreLista , 1, 0, 'L', 0);

            for($i = $cont; $i < $contAux; $i++){
                    $fecha = $arregloFechasHoras[$i];
                    $fechaCorta = substr($fecha, 0, 10);

                    $selectAsistenciasDiaAlumno = $con->query("SELECT tipoasistencia.nombreTipoAsistencia FROM asistenciadia, tipoasistencia WHERE asistenciadia.asistencia_id = '$id_asistencia' AND asistenciadia.fechaHoraAsisDia LIKE '$fechaCorta%' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id");

                    $selectAsistenciasAlumnoCurso2= $selectAsistenciasDiaAlumno->fetch_assoc();
                    $tipoAsistencia = $selectAsistenciasAlumnoCurso2['nombreTipoAsistencia'];

                        switch($tipoAsistencia){
                            case "PRESENTE":
                                $pdf->SetTextColor(0,183,6);
                                $pdf->Cell($anchoCol, 6, 'P', 1, 0, 'C', 0);
                                break;

                            case "AUSENTE":
                                $pdf->SetTextColor(250,78,58);
                                $pdf->Cell($anchoCol, 6, 'A', 1, 0, 'C', 0);
                                break;

                            case "JUSTIFICADO":
                                $pdf->SetTextColor(228,207,0);
                                $pdf->Cell($anchoCol, 6, 'J', 1, 0, 'C', 0);
                                break;

                            default:
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Cell($anchoCol, 6, 'N', 1, 0, 'C', 0);
                                break;

                            }

            }
            $pdf->Ln(6);
        }
    }
    $cont = $cont + 30;
    
    //si para la proxima ejecuicion del while quedan fechas que registrar se crea una hoja nueva 
    if($cont <= $cantFechas){
        $pdf->AddPage('L', 'Legal');
        
    }
    
}
    
/*Serve the PDF*/
$pdf->Output("report.pdf", "I");
    
    
}else{
    //$mensaje = null;
    if(count($arregloFechasHoras) == 0 && count($arregloIdAsistencias) == 0){
        //$mensaje = "El curso no registra información de alumnos inscriptos, ni de asistencias.";
        header("location:/DayClass/Profesor/seleccionCurso.php?codFn=23&&error=6");
        
     
    }else{
        if(count($arregloFechasHoras) == 0){
          //$mensaje = "El curso no registra información de asistencias en el periodo seleccionado."; 
            header("location:/DayClass/Profesor/seleccionCurso.php?codFn=23&&error=7");
        }else{
          // $mensaje = "El curso no registra información alumnos inscriptos en el periodo seleccionado." ; 
            header("location:/DayClass/Profesor/seleccionCurso.php?codFn=23&&error=8");
        }
    }
    
    
    
}





//generador del codigo del reporte 
function generateReportNumber(){
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $reportNumber = substr(str_shuffle($permitted_chars), 0, 8);
    return $reportNumber;
}

?>