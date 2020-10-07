<?php
$materia = $_POST["materia"];
$curso= $_POST["curso"];
$fechaDesdeReporte = $_POST["inputFechaDesdeReporte"];
$fechaHastaReporte = $_POST["inputFechaHastaReporte"];

include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$currentDateTime = date('Y-m-d H:i:s');
$currentYear = date('Y');


$fechaHastaReporte = $fechaHastaReporte." 23:59:59";


$selectTemasDia = $con->query("SELECT temadia.fechaTemaDia, temasmateria.nombreTema, profesor.nombreProf, profesor.apellidoProf, temadia.comentarioTema FROM `temadia`, curso, temasmateria, profesor WHERE curso.id = '$curso' AND temadia.curso_id = curso.id AND temadia.fechaTemaDia >= '$fechaDesdeReporte' AND temadia.fechaTemaDia <= '$fechaHastaReporte' AND temadia.temasMateria_id = temasmateria.id AND temadia.profesor_id = profesor.id ORDER BY temadia.fechaTemaDia ASC");


//cambiar formato fechas 
$fechaDesdeReporte = date_create($fechaDesdeReporte);
$fechaDesdeReporte = date_format($fechaDesdeReporte,"d/m/Y");
$fechaHastaReporte = date_create($fechaHastaReporte);
$fechaHastaReporte = date_format($fechaHastaReporte,"d/m/Y");


//Datos curso
$selectCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL");
$curso = $selectCurso->fetch_assoc();
$nombreCurso = utf8_decode($curso["nombreCurso"]); 


require_once( "../../fpdf/fpdf.php" );

// Begin configuration
$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );

$reportName = "Reporte de temas dados.";
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



/*Create the page header, main heading, and intro text*/

$pdf->AddPage('L', 'A4');
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 15 );


$pdf->Ln(16);
//$pdf->Write(10, "$codigo reporte: $numeroReporte" );

$pdf->SetFont( 'Arial', '', 12 );

$fechaArchivo = date_create($currentDateTime);
$fechaArchivo = date_format($fechaArchivo, "d/m/Y H:i:s");

$pdf->Write(10, "Fecha reporte: $fechaArchivo" );
$pdf->Ln(7);
$pdf->Write( 6, "Curso: $nombreCurso" );
$pdf->Ln(5);
$pdf->Write( 6, "Periodo reporte: $fechaDesdeReporte - $fechaHastaReporte" );

$pdf->Ln(10);

   
if(($selectTemasDia->num_rows) != 0){
//cabecera de la tabla del reporte
$pdf->SetFillColor(148, 112, 220);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 6, 'Fecha', 1, 0, 'L', 1);
$pdf->Cell(150, 6, 'Tema', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Docente', 1, 0, 'C', 1);
$pdf->Cell(70, 6, 'Comentario', 1, 0, 'C', 1);

$pdf->Ln(6);

    
$pdf->SetFont( 'Arial', '', 10);
//codigo que va llenando la tabla 
while($temaDia = $selectTemasDia->fetch_assoc()){
    
    $fechas = $temaDia['fechaTemaDia'];
    $fechas = substr($fechas, 0, 10);
    $fechas =date_create($fechas);
    $fechas =  date_format($fechas,"d/m/Y");
    
    
    $tema = utf8_decode($temaDia['nombreTema']);
    
    $docente = $temaDia['apellidoProf'] .", ". $temaDia['nombreProf'];
    $comentario = utf8_decode($temaDia['comentarioTema']);
    
    if($comentario == "" || $comentario == null){
        $comentario = "-";    
    }
    
    $pdf->Cell(20, 6, $fechas, 1, 0, 'L', 0);
    $pdf->Cell(150, 6, $tema, 1, 0, 'C', 0);
    $pdf->Cell(40, 6, $docente, 1, 0, 'C', 0);
    $pdf->Cell(70, 6, $comentario, 1, 0, 'C', 0);
    $pdf->Ln( 6 );      

}
    
}else{
    $mensaje = "No se registra información de que se hayan registrado temas en el periodo seleccionado"; 
    
    $mensaje = utf8_decode($mensaje);
    $pdf -> SetTextColor(255, 0,0);
    $pdf->SetFont( 'Arial', 'B', 15 );
    $pdf->Write(15, $mensaje);
    $pdf->Ln(10); 
}

/*Serve the PDF*/
$pdf->Output( "reporteTemasDados$nombreCurso.pdf", "I" );

?>