<?php
include 'connection.php';

class PdfFileDownload{
    private $conn;
    
    public function __construct(){
        $this->conn = new ConnPDO();
    }
    public function action(){
        $this->downloadPdfFile();
    }

    function downloadPdfFile(){
        require __DIR__ . '../../vendor/autoload.php';
        
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $fromDate = $_POST['fromDateValue'];
        $toDate = $_POST['toDateValue'];

        $query = "SELECT `studentdetails`.`id`,`name`,`mobile`,`email`,`entry_datetime`,`english`,`hindi`,`maths`,`science`,`grade` FROM `studentdetails` LEFT JOIN `studentmarks` ON `studentdetails`.`id` = `studentmarks`.`id` where (DATE(entry_datetime) BETWEEN '$fromDate' AND '$toDate') AND `status`='ACTIVE' ORDER BY `id` ";
        $result = $this->conn->Execute($query);
        $data = $result->fetchAll();

        // Set font and add table
        $pdf->setPrintHeader(false);
        $pdf->AddPage();
        
        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->Cell(190, 10, 'Student Details', 0, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(190, 10, "(From " .date("d-m-Y", strtotime($fromDate)). " To " . date("d-m-Y", strtotime($toDate)) . ")", 0, 0, 'C', 0, '', 0);
        $pdf->Ln();
        
        
        $pdf->SetFont('helvetica', '', 9);
        //Table Headers
        $pdf->Cell(6, 10, 'ID', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(30, 10, 'Name', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(20, 10, 'Mobile', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(50, 10, 'Email', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(35, 10, 'Entry Date and Time', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(12, 10, 'English', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(10, 10, 'Hindi', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(11, 10, 'Maths', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(13, 10, 'Science', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(10, 10, 'Grade', 1, 0, 'C', 0, '', 0);
        $pdf->Ln();

        // Table data
        foreach($data as $row) {
            $pdf->Cell(6, 10, $row['id'], 1, 0, 'C', 0, '', 0);
            $pdf->Cell(30, 10, $row['name'], 1, 0, 'C', 0, '', 0);
            $pdf->Cell(20, 10, $row['mobile'], 1, 0, 'C', 0, '', 0);
            $pdf->Cell(50, 10, $row['email'], 1, 0, 'C', 0, '', 0);
            $date=date_create($row['entry_datetime']);
            $date=date_format($date,"d-m-Y H:i:s");
            $pdf->Cell(35, 10, $date, 1, 0, 'C', 0, '', 0);
            if($row['english']==""||$row['english']==null)
                       $row['english']="-";
            $pdf->Cell(12, 10, $row['english'], 1, 0, 'C', 0, '', 0);
            if($row['hindi']==""||$row['hindi']==null)
                       $row['hindi']="-";
            $pdf->Cell(10, 10, $row['hindi'], 1, 0, 'C', 0, '', 0);
            if($row['maths']==""||$row['maths']==null)
                       $row['maths']="-";
            $pdf->Cell(11, 10, $row['maths'], 1, 0, 'C', 0, '', 0);
            if($row['science']==""||$row['science']==null)
                       $row['science']="-";
            $pdf->Cell(13, 10, $row['science'], 1, 0, 'C', 0, '', 0);
            if($row['grade']==""||$row['grade']==null)
                       $row['grade']="-";
            $pdf->Cell(10, 10, $row['grade'], 1, 0, 'C', 0, '', 0);
            $pdf->Ln();
        }

        // Output the PDF document
        $pdf->Output('Student Data.pdf', 'D');

    }
}

$pdf = new PdfFileDownload();
$pdf->action();

?>