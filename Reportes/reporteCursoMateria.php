    <?php
include "../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$currentDateTime = date('Y-m-d H:i:s');
$currentYear = date('Y');

$id_curso = "18";
$fechaDesdeReporte = '2020-08-01';
$fechaHastaReporte = '2020-09-30';

$selectFechas = $con->query("SELECT DISTINCT asistenciadia.fechaHoraAsisDia FROM `asistencia`, asistenciadia, curso WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND asistenciadia.asistencia_id = asistencia.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' ORDER BY `fechaHoraAsisDia` ASC");

//Datos asistencias en el periodo seleccionado 
$selectAsistenciasAlumnoCurso = $con->query("SELECT asistencia.id AS idAsistencia, alumno.id, alumno.nombreAlum, alumno.apellidoAlum, alumno.legajoAlumno FROM alumno, asistencia, curso WHERE curso.id = 18 AND curso.id = asistencia.curso_id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistencia.alumno_id = alumno.id ORDER BY alumno.apellidoAlum ASC");


//Datos curso
$selectCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$id_curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL");
$curso = $selectCurso->fetch_assoc();
$nombreCurso = $curso["nombreCurso"]; 

//cambiar formato fechas 
$fechaDesdeReporteC =date_create($fechaDesdeReporte);
$fechaDesdeReporteC =  date_format($fechaDesdeReporteC,"d/m/Y");
$fechaHastaReporteC =date_create($fechaHastaReporte);
$fechaHastaReporteC =  date_format($fechaHastaReporteC,"d/m/Y");



require_once( "../fpdf/fpdf.php" );

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );

$reportName = "Reporte de asistencias de un curso";
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
$pdf->Cell( 0 ,25, "$nombreCurso - $currentYear ",0,0, 'C' );
$pdf->Ln();
//$pdf->Cell( 0 ,15, "$nombreAlumno $apellidoAlumno",0,0, 'C' );


/**
  Create the page header, main heading, and intro text
**/

$pdf->AddPage('L', 'Legal');
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 15 );



$numero = utf8_decode("número");


$pdf->Ln(16);
$pdf->Write(10, "Reporte $numero: AHE86589" );
$pdf->Ln(6);
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write(10, "Fecha: $currentDateTime" );

$pdf->Ln(5);


$pdf->SetFont( 'Arial', '', 12 );


$pdf->Ln(5);
$pdf->Write( 6, "Curso: $nombreCurso" );
$pdf->Ln(5);
$pdf->Write( 6, "Fechas Reporte: $fechaDesdeReporteC - $fechaHastaReporteC" );


$pdf->Ln(10);

//cabecera de la tabla del reporte
//$pdf->SetFillColor(148, 112, 220);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 6, 'Fecha', 1, 0, 'L', 0);

$pdf->SetFont('Arial', '', 7);
while($fechasAsistencia = $selectFechas->fetch_assoc()){
   $fecha = $fechasAsistencia["fechaHoraAsisDia"];
    $fecha =date_create($fecha);
    $fecha = date_format($fecha,"d/m/Y");
    
    $fechaCorta = substr($fecha, 0, 5);
            
    $pdf->Cell(9, 6, $fechaCorta, 1, 0, 'C', 0);
}
$pdf->Ln(6);

$pdf->SetFont('Arial', '', 7);

while($alumnosAsistencia = $selectAsistenciasAlumnoCurso->fetch_assoc()){
    
    $id_asistencia = $alumnosAsistencia["idAsistencia"];
    
    $selectAlumno = $con->query("SELECT alumno.legajoAlumno, alumno.apellidoAlum, alumno.nombreAlum FROM `asistencia`, alumno WHERE asistencia.id = '$id_asistencia' AND asistencia.alumno_id = alumno.id");
    
    $alumno = $selectAlumno->fetch_assoc();
    
    $nombreAlumno = $alumno["nombreAlum"];
    $apellidoAlumno = $alumno["apellidoAlum"];
    $legajoAlumno = $alumno["legajoAlumno"];
    
    $nombreLista = "$legajoAlumno - $nombreAlumno $apellidoAlumno";
    
    $pdf->Cell(40, 6, $nombreLista , 1, 0, 'L', 0);

    $fechas = $con->query("SELECT DISTINCT asistenciadia.fechaHoraAsisDia FROM `asistencia`, asistenciadia, curso WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND asistenciadia.asistencia_id = asistencia.id AND asistencia.fechaDesdeFichaAsis = curso.fechaDesdeCursado AND asistencia.fechaHastaFichaAsis = curso.fechaHastaCursado AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' ORDER BY `fechaHoraAsisDia` ASC");
    

        while($fechasAsistencia = $fechas->fetch_assoc()){
            $fecha = $fechasAsistencia["fechaHoraAsisDia"];
            $fechaCorta = substr($fecha, 0, 10);
            
            $selectAsistenciasDiaAlumno = $con->query("SELECT tipoasistencia.nombreTipoAsistencia FROM asistenciadia, tipoasistencia WHERE asistenciadia.asistencia_id = '$id_asistencia' AND asistenciadia.fechaHoraAsisDia LIKE '$fechaCorta%' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id");

            $selectAsistenciasAlumnoCurso2= $selectAsistenciasDiaAlumno->fetch_assoc();
            $tipoAsistencia = $selectAsistenciasAlumnoCurso2['nombreTipoAsistencia'];

                switch($tipoAsistencia){
                    case "PRESENTE":
                        $pdf->Cell(9, 6, 'P', 1, 0, 'C', 0);
                        break;

                    case "AUSENTE":
                        $pdf->Cell(9, 6, 'A', 1, 0, 'C', 0);
                        break;

                    case "JUSTIFICADO":
                        $pdf->Cell(9, 6, 'J', 1, 0, 'C', 0);
                        break;

                    default:
                        $pdf->Cell(9, 6, '-', 1, 0, 'C', 0);
                        break;

                    }
                }
    
    
    $pdf->Ln(6);
}





/***
  Serve the PDF
***/

$pdf->Output("report.pdf", "I");

?>