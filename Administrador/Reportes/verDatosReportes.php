<?php

$materia = $_POST["materia"];
$fechaDesdeReporte = $_POST["inputFechaDesdeReporte"];
$fechaHastaReporte = $_POST["inputFechaHastaReporte"];

if($materia == "Todas"){
    //reporte de toda la institucion 
}else{
    $curso= $_POST["curso"];
    
    if($curso == ""){
        //reporte de todos los cursos de cierta materia
    }else{
        $alumno = $_POST["alumno"];
        if($alumno == ""){
            //reporte de todos los alumnios de un curso en una materia
            //planilla de asistencia 
        }else{
             //reporte de cierto alumno en una materia en un curso
            
            planillaAlumno($curso,$alumno,$fechaDesdeReporte,$fechaHastaReporte);
        }   
    }   
}

echo "$materia - ";
echo "$curso - ";
echo "$alumno - ";


function planillaAlumno($id_curso, $id_alumno, $fechaDesde, $fechaHasta){
include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$currentDateTime = date('Y-m-d H:i:s');
$currentYear = date('Y');

/*$id_curso = "18";
$id_alumno = 1851;*/
$fechaDesdeReporte = $fechaDesde;
$fechaHastaReporte = $fechaHasta;


//Datos asistencias en el periodo seleccionado 
$selectAsistenciasDiaAlumnoCurso = $con->query("SELECT asistenciadia.id, asistenciadia.fechaHoraAsisDia, tipoasistencia.nombreTipoAsistencia FROM `asistenciadia`, asistencia, alumno, curso, tipoasistencia WHERE alumno.id = '$id_alumno' AND curso.id = '$id_curso' AND alumno.id = asistencia.alumno_id AND curso.id = asistencia.curso_id AND asistenciadia.asistencia_id = asistencia.id AND asistenciadia.fechaHoraAsisDia >= '$fechaDesdeReporte' AND asistenciadia.fechaHoraAsisDia <= '$fechaHastaReporte' AND asistenciadia.tipoAsistencia_id = tipoasistencia.id ORDER BY `fechaHoraAsisDia` ASC");


//cambiar formato fechas 
$fechaDesdeReporte =date_create($fechaDesdeReporte);
$fechaDesdeReporte =  date_format($fechaDesdeReporte,"d/m/Y");
$fechaHastaReporte =date_create($fechaHastaReporte);
$fechaHastaReporte =  date_format($fechaHastaReporte,"d/m/Y");


//BUSCAR TODOS LOS DATOS  
//Datos alumno
$selectAlumno = $con->query("SELECT * FROM `alumno` WHERE alumno.id = '$id_alumno' AND alumno.fechaAltaAlumno <= '$currentDate' AND alumno.fechaBajaAlumno IS NULL");
$alumno = $selectAlumno->fetch_assoc();
$nombreAlumno = $alumno["nombreAlum"];
$apellidoAlumno = $alumno["apellidoAlum"];
$legajoAlumno = $alumno["legajoAlumno"];
$dniAlumno = $alumno["dniAlum"];


//Datos curso
$selectCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$id_curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL");
$curso = $selectCurso->fetch_assoc();
$nombreCurso = $curso["nombreCurso"]; 


require_once( "../../fpdf/fpdf.php" );

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );

$reportName = "Reporte de asistencias de alumno";
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
$pdf->Cell( 0 ,25, "$nombreCurso - $currentYear ",0,0, 'C' );
$pdf->Ln();
$pdf->Cell( 0 ,15, "$nombreAlumno $apellidoAlumno",0,0, 'C' );


/*Create the page header, main heading, and intro text*/

$pdf->AddPage('P', 'A4');
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
$pdf->Write( 6, "Alumno: $nombreAlumno $apellidoAlumno" );
$pdf->Ln(5);
$pdf->Write( 6, "Legajo: $legajoAlumno" );
$pdf->Ln(5);
$pdf->Write( 6, "Curso: $nombreCurso" );
$pdf->Ln(5);
$pdf->Write( 6, "Fechas Reporte: $fechaDesdeReporte - $fechaHastaReporte" );

$pdf->Ln(10);

//cabecera de la tabla del reporte
$pdf->SetFillColor(148, 112, 220);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, 'Fecha', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'Presente', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Ausente', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Justificado', 1, 0, 'C', 1);
$pdf->Ln(6);

//codigo que va llenando la tabla 
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

}

/*Serve the PDF*/

$pdf->Output( "reporteAsistencias$nombreAlumno$apellidoAlumno$nombreCurso$currentDateTime.pdf", "I" );
 
}

?>