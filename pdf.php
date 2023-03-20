
<?php 
require('../../fpdf/fpdf185/fpdf.php');

/**
 * Summary of PDF
 */
class PDF extends FPDF{
   

    // dados
/**
 * Summary of LoadData
 * @param mixed $file
 * @return array
 */
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
        //unset($data[0]);
    return $data;
}
 public function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''){
       $txt = utf8_decode($txt);
       parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);}
       

// Colored table
function FancyTable($header, $data){
    // Colors, line width and bold font
    $this->SetFillColor(255,69,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 20, 105, 20);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
    }
    
}

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
