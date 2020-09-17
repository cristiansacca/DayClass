<?php

$materia = "Lengua";
$curso = "Lengua - 4K10";
$anio = 2020;

require_once( "../fpdf/fpdf.php" );

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );

$reportName = "Reporte de asistencias de alumno";
$reportNameYPos = 160;

$logoFile = "logoDayclass.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;


/**
  Create the title page
**/

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// Logo
$pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );

// Report Name
$pdf->SetFont( 'Arial', 'B', 20);
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->Ln();
$pdf->Cell( 0 ,25, "$curso - $anio",0,0, 'C' );
$pdf->Ln();
$pdf->Cell( 0 ,15, "NombreAlumno ApellidoAlumno",0,0, 'C' );


/**
  Create the page header, main heading, and intro text
**/

$pdf->AddPage('P', 'A4');
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 20 );
$pdf->Write( 19, "Planilla de asistencia de alumno" );
$pdf->Ln( 16 );
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write( 6, "Se presenta a continuacion la planilla de asistencias del alumno : NombreAlumno, ApellidoAlumno, en el curso: NombreCurso, en las fechas: FechaDesdeEnviada - FechaHastaEnviada" );

$pdf->Ln(10);



$row_height = 6;
$y_axis = 66;
//$pdf->SetFillColor(232, 232, 232);
$pdf->SetFillColor(148, 112, 220);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, 'Fecha', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'Presente', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Ausente', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Justificado', 1, 0, 'C', 1);
$pdf->Ln(6);


//codigo que va llenando la tabla 
include "../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$id_curso = 18;




$selectAsistenciasDiaAlumnoCurso = $con->query("SELECT asistenciadia.id, asistenciadia.fechaHoraAsisDia, tipoasistencia.nombreTipoAsistencia FROM `asistenciadia`, asistencia, alumno, curso, tipoasistencia WHERE alumno.id = 1851 AND curso.id = 18 AND alumno.id = asistencia.alumno_id AND curso.id = asistencia.curso_id AND asistenciadia.asistencia_id = asistencia.id AND asistenciadia.fechaHoraAsisDia >= '2020-08-01' AND asistenciadia.fechaHoraAsisDia <= '2020-09-17' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id ORDER BY `fechaHoraAsisDia` ASC");



while($selectAsistenciasAlumnoCurso2= $selectAsistenciasDiaAlumnoCurso->fetch_assoc()){
    
    $fechas = $selectAsistenciasAlumnoCurso2['fechaHoraAsisDia'];
    $fechas = substr($fechas, 0, 10);
    $fechas =date_create($fechas);
    $fechas =  date_format($fechas,"d/m/Y");
    
    
    $tipoAsistencia = $selectAsistenciasAlumnoCurso2['nombreTipoAsistencia'];
    
    
    switch($tipoAsistencia){
        case "PRESENTE":
            $pdf->Cell(30, 6, $fechas, 1, 0, 'L', 0);
            $pdf->Cell(30, 6, "X", 1, 0, 'C', 0);
            $pdf->Cell(30, 6, "-", 1, 0, 'C', 0);
            $pdf->Cell(30, 6, "-", 1, 0, 'C', 0);
            $pdf->Ln( 6 );
            break;
        
        case "AUSENTE":
            $pdf->Cell(30, 6, $fechas, 1, 0, 'L', 0);
            $pdf->Cell(30, 6, "-", 1, 0, 'C', 0);
            $pdf->Cell(30, 6, "X", 1, 0, 'C', 0);
            $pdf->Cell(30, 6, "-", 1, 0, 'C', 0);
            $pdf->Ln( 6 );
            break;
            
        case "JUSTIFICADO":
            $pdf->Cell(30, 6, $fechas, 1, 0, 'L', 0);
            $pdf->Cell(30, 6, "-", 1, 0, 'C', 0);
            $pdf->Cell(30, 6, "-", 1, 0, 'C', 0);
            $pdf->Cell(30, 6, "X", 1, 0, 'C', 0);
            $pdf->Ln( 6 );
            break;
    }
    
    

    /*$presentes = $selectCantAsistenciasAlumno['cantPresentes'];
    $ausentes = $selectCantInasistenciasAlumno['cantAusentes'];
    $justificados = $selectCantJustificadosAlumno['cantJustificados'];

    
    //$pdf->SetY($y_axis);
    $pdf->Cell(30, 6, $id_alumno, 1, 0, 'L', 0);
    $pdf->Cell(65, 6, "Pepe Hongo", 1, 0, 'L', 0);
    $pdf->Cell(30, 6, $presentes, 1, 0, 'C', 0);
    $pdf->Cell(30, 6, $ausentes, 1, 0, 'C', 0);
    $pdf->Cell(30, 6, $justificados, 1, 0, 'C', 0);
    
    //$row_height = 6;
    $pdf->Ln( 6 );
    //Go to next row
   // $y_axis = $y_axis + $row_height;*/

}



/***
  Serve the PDF
***/

$pdf->Output( "reporteAsistencias$curso.pdf", "I" );

?>