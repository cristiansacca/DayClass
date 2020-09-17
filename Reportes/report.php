<?php

$materia = "Lengua";
$curso = "Lengua - 4K10";
$anio = 2020;

require_once( "fpdf/fpdf.php" );

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );

$reportName = "Reporte de asistencias";
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
$pdf->SetFont( 'Arial', 'B', 24 );
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->Ln();
$pdf->Cell( 0 ,19, "$curso - $anio",0,0, 'C' );


/**
  Create the page header, main heading, and intro text
**/

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 20 );
$pdf->Write( 19, "Cantidades Totales de asistencias" );
$pdf->Ln( 16 );
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write( 6, "Se presenta a continuacion la cantidad total de asistencias que han tenido los alumnos en la materia, en las fechas: Fecha Desde - Fecha hasta" );

$pdf->Ln(10);



$row_height = 6;
$y_axis = 66;
//$pdf->SetFillColor(232, 232, 232);
$pdf->SetFillColor(148, 112, 220);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, 'Legajo', 1, 0, 'L', 1);
$pdf->Cell(65, 6, 'Alumno', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'Presentes', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Ausentes', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Justificados', 1, 0, 'C', 1);
$pdf->Ln(6);


//codigo que va llenando la tabla 
include "databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$id_curso = 18;

$selectAsistenciasAlumnoCurso = $con->query("SELECT asistencia.id, asistencia.alumno_id FROM asistencia, curso WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND curso.fechaDesdeCursado = asistencia.fechaDesdeFichaAsis AND curso.fechaHastaCursado = asistencia.fechaHastaFichaAsis");

while($selectAsistenciasAlumnoCurso2= $selectAsistenciasAlumnoCurso->fetch_assoc()){
$id_alumno = $selectAsistenciasAlumnoCurso2["alumno_id"];
                   
$selectCantInasistenciasAlumno = $con->query("SELECT COUNT(asistenciadia.tipoAsistencia_id) AS cantAusentes FROM asistencia, asistenciadia, tipoasistencia WHERE asistencia.alumno_id = '$id_alumno' AND asistenciadia.asistencia_id = asistencia.id AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'AUSENTE'")->fetch_assoc();
    
$selectCantAsistenciasAlumno = $con->query("SELECT COUNT(asistenciadia.tipoAsistencia_id) AS cantPresentes FROM asistencia, asistenciadia, tipoasistencia WHERE asistencia.alumno_id = '$id_alumno' AND asistenciadia.asistencia_id = asistencia.id AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'PRESENTE'")->fetch_assoc();
    
$selectCantJustificadosAlumno = $con->query("SELECT COUNT(asistenciadia.tipoAsistencia_id) AS cantJustificados FROM asistencia, asistenciadia, tipoasistencia WHERE asistencia.alumno_id = '$id_alumno' AND asistenciadia.asistencia_id = asistencia.id AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'JUSTIFICADO'")->fetch_assoc();

    $presentes = $selectCantAsistenciasAlumno['cantPresentes'];
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
   // $y_axis = $y_axis + $row_height;

}



/***
  Serve the PDF
***/

$pdf->Output( "reporteAsistencias$curso.pdf", "I" );

?>