<?php
include 'classes/connection.php';
require __DIR__ . '../vendor/autoload.php';
$conn = new connPDO;

$query = "SELECT * from result where lotcode  = 1175 ";
$result = $conn->Execute($query);
$data = $result->fetchAll();

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf->SetFont('helvetica', '', 9);

$pdf->setPrintHeader(false);
$pdf->AddPage();
$border_color = array(0, 0, 0);
$pdf->Rect(5, 5, 200, 287, 'D', '', $border_color);

$pdf->SetFont('helvetica', 'B', 30);
$pdf->Cell(190, 10, "Prize Winners", 0, 0, 'C', 0, '', 0);
$pdf->Ln();

$k=0;
$v=1;

$pdf->SetFont('helvetica', 'B', 17);
$val=$data[$k]['result_no'];
$array = explode(":", $val);
$pdf->Cell(95, 10, "1st Prize  Rs.10000/-", 1, 0, 'L', 0, '', 0);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(95, 10, $array[$v], 1, 0, 'C', 0, '', 0);
$k++;
$pdf->Ln();

$pdf->SetFont('helvetica', 'B', 15);
$val=$data[$k]['result_no'];
$array = explode(":", $val);
$pdf->Cell(95, 10, "2nd Prize  Rs.1000/-", 1, 0, 'L', 0, '', 0);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(95, 10, $array[$v], 1, 0, 'C', 0, '', 0);
$k++;
$pdf->Ln();

$pdf->SetFont('helvetica', 'B', 13);
$val=$data[$k]['result_no'];
$array = explode(":", $val);
$pdf->Cell(95, 10, "3rd Prize  Rs.500/-", 1, 0, 'L', 0, '', 0);
while($v<count($array)-1){
    $w = 95/(count($array)-2);
    $pdf->SetFont('helvetica', 'B', 13);
    $pdf->Cell($w, 10, $array[$v], 1, 0, 'C', 0, '', 0);
    $v++;
}
$pdf->Ln();
$k++;
$v=1;

$pdf->SetFont('helvetica', 'B', 12);
$val=$data[$k]['result_no'];
$array = explode(":", $val);
$pdf->Cell(95, 10, "4th Prize  Rs.200/-", 1, 0, 'L', 0, '', 0);
while($v<count($array)-1){
    $w = 95/(count($array)-2);
    $pdf->SetFont('helvetica', 'B', 13);
    $pdf->Cell($w, 10, $array[$v], 1, 0, 'C', 0, '', 0);
    $v++;
}
$pdf->Ln();

$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(190, 10, "5th Prize  Rs.100/-", 1, 0, 'C', 0, '', 0);
$pdf->Ln();

$i=0;
while($i<count($data)){
    if($i==4){
        $num=$data[$i]['result_no'];
        $array = explode(":", $num);
        $j = 1;
        $l = 0;
        while($j<count($array)-1){
            $pdf->SetFont('helvetica', 'B', 13);
            $pdf->Cell(19, 8, $array[$j], 1, 0, 'C', 0, '', 0);
            $j++;
            $l++;
            if($l%10==0){
                $pdf->Ln();
            }
        }
    }
    $i=$i+1;
}

$html =  '<br>';
$pdf->writeHTML($html, True, False, True, False, '');

$pdf->Image('images\winners.webp', $x = '55', $y = '', 100, 30);

$pdf->Output('table.pdf', 'I');
?>