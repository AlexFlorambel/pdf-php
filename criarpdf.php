<?php 
require('pdf.php');

$pdf = new PDF();
// Column headings
$header = array('Nome', 'Curso', 'Disciplina', 'Média');
// Data loading
$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();




?>