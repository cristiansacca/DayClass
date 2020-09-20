<?php
include "../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$currentDateTime = date('Y-m-d H:i:s');
$currentYear = date('Y');

$id_materia = "4";
$fechaDesdeReporte = '2020-08-01';
$fechaHastaReporte = '2020-09-30 23:59:59';


//Cursos vigentes y con cursado actualemnte, relacionado a la materia a buscar 
$selectCursosMateria = $con->query("SELECT curso.id AS idCurso, curso.nombreCurso FROM curso, materia WHERE materia.id = '$id_materia' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate'");


$selectCountCursosMateria = $con->query("SELECT COUNT(curso.id) AS cantCursos FROM curso, materia WHERE materia.id = '$id_materia' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate'")->fetch_assoc();
$cantCursosMateria = $selectCountCursosMateria["cantCursos"];

//cambiar formato fechas 
$fechaDesdeReporteC =date_create($fechaDesdeReporte);
$fechaDesdeReporteC =  date_format($fechaDesdeReporteC,"d/m/Y");
$fechaHastaReporteC =date_create($fechaHastaReporte);
$fechaHastaReporteC =  date_format($fechaHastaReporteC,"d/m/Y");


//BUSCAR TODOS LOS DATOS  
//Datos alumno
$selectMateria = $con->query("SELECT * FROM `materia` WHERE materia.id = '$id_materia' AND materia.fechaAltaMateria <= '$currentDate' AND materia.fechaBajaMateria IS NULL");
$materia = $selectMateria->fetch_assoc();
$nombreMateria = $materia["nombreMateria"];
$nivelMateria = $materia["nivelMateria"];


require_once( "../fpdf/fpdf.php" );

//Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );

$reportName = "Reporte de asistencias de materia";
$reportNameYPos = 160;

$logoFile = "logoDayclass.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;


/*Create the title page*/

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
$pdf->Cell( 0 ,25, "$nombreMateria $nivelMateria - $currentYear",0,0, 'C' );



/*Create the page header, main heading*/
$pdf->AddPage('P', 'A4');
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 15 );


//datos del reporte 
$codigo = utf8_decode("Código");
$pdf->Ln(2);
$numeroReporte = generateReportNumber();//generar automaticamente el codigo del reporte
$pdf->Ln(16);
$pdf->Write(10, "$codigo reporte: $numeroReporte" );
$pdf->Ln(6);
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write(10, "Fecha: $currentDateTime" );
$pdf->Ln(5);


$pdf->SetFont( 'Arial', '', 12 );
$pdf->Ln(5);
$pdf->Write( 6, "Nombre Materia: $nombreMateria" );
$pdf->Ln(5);
$pdf->Write( 6, "Nivel materia: $nivelMateria" );
$pdf->Ln(5);
$pdf->Write( 6, "Cantidad de cursos de esa materia: $cantCursosMateria" );
$pdf->Ln(5);
$pdf->Write( 6, "Fechas Reporte: $fechaDesdeReporteC - $fechaHastaReporteC" );


$pdf->Ln(10);


if($cantCursosMateria !=0){
    
//cabecera de la tabla del reporte
$pdf->SetFillColor(148, 112, 220);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 6, 'Curso', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'Presentes', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Ausentes', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Justificados', 1, 0, 'C', 1);
$pdf->Ln(6);

//codigo que va llenando la tabla 
while($cursosMateria= $selectCursosMateria->fetch_assoc()){
    
    $id_curso = $cursosMateria["idCurso"]; 
    $nombreCurso = $cursosMateria["nombreCurso"]; 
    
    $selectCantPresentes = $con->query("SELECT COUNT(asistenciadia.id) AS cantPresentes FROM asistenciadia, asistencia, curso, tipoasistencia WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistencia.id = asistenciadia.asistencia_id AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'PRESENTE'")->fetch_assoc();
    
    $selectCantAusentes = $con->query("SELECT COUNT(asistenciadia.id) AS cantAusentes FROM asistenciadia, asistencia, curso, tipoasistencia WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistencia.id = asistenciadia.asistencia_id AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'AUSENTE'")->fetch_assoc();
    
    $selectCantJustificados = $con->query("SELECT COUNT(asistenciadia.id) AS cantJustificados FROM asistenciadia, asistencia, curso, tipoasistencia WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistencia.id = asistenciadia.asistencia_id AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'JUSTIFICADO'")->fetch_assoc();
    
    $cantPresntes = $selectCantPresentes["cantPresentes"];
    $cantAusentes = $selectCantAusentes["cantAusentes"];
    $cantJustificados = $selectCantJustificados["cantJustificados"];
    
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(80, 6, $nombreCurso, 1, 0, 'L', 0);
        $pdf->Cell(30, 6, $cantPresntes, 1, 0, 'C', 0);
        $pdf->Cell(30, 6, $cantAusentes, 1, 0, 'C', 0);
        $pdf->Cell(30, 6, $cantJustificados, 1, 0, 'C', 0);
        $pdf->Ln( 6 );
            
            
}
}else{
    $mensaje = "No se registran cursos asociados a esa materia."; 
    
    $mensaje = utf8_decode($mensaje);
    $pdf -> SetTextColor(255, 0,0);
    $pdf->SetFont( 'Arial', 'B', 15 );
    $pdf->Write(15, $mensaje);
    $pdf->Ln(10); 
}

/*Serve the PDF*/
$pdf->Output( "reporteAsistencias.pdf", "I" );


//generador del codigo del reporte 
function generateReportNumber(){
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $reportNumber = substr(str_shuffle($permitted_chars), 0, 8);
    return $reportNumber;
}
?>