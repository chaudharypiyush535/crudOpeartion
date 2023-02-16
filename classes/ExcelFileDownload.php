<?php
include 'connection.php';

class ExcelFileDownload{
    private $conn;

    public function __construct(){
        $this->conn = new ConnPDO();
    }

    public function action(){
        $this->downloadExcelFile();
    }

    function downloadExcelFile(){

        require_once 'PHPExcel/Classes/PHPExcel.php';
        require_once 'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

        $fromDate = $_POST['fromDateValue'];
        $toDate = $_POST['toDateValue'];

        $query = "SELECT `studentdetails`.`id`,`name`,`mobile`,`email`,`entry_datetime`,`english`,`hindi`,`maths`,`science`,`grade` FROM `studentdetails` LEFT JOIN `studentmarks` ON `studentdetails`.`id` = `studentmarks`.`id` where (DATE(entry_datetime) BETWEEN '$fromDate' AND '$toDate') AND `status`='ACTIVE' ORDER BY `id` ";
        $result = $this->conn->Execute($query);
        $data = $result->fetchAll();

        $objPHP = new PHPExcel();
        $objPHP->setActiveSheetIndex(0);

        $rowcount = 1;
        $objPHP->getActiveSheet()->mergeCells("A" . $rowcount . ":J" . $rowcount);
        $objPHP->getActiveSheet()->setCellValue('A' . $rowcount, "STUDENT DETAILS");
        $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHP->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHP->getActiveSheet()->getRowDimension($rowcount)->setRowHeight(20);
        $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getFont()->setName('Cambria')
                ->setSize(15)
                ->setBold(true);
        $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
        $rowcount++;

        $objPHP->getActiveSheet()->mergeCells("A" . $rowcount . ":J" . $rowcount);
        $objPHP->getActiveSheet()->setCellValue('A' . $rowcount, "(From  " . date("d-m-Y", strtotime($fromDate)) . "  To  " . date("d-m-Y", strtotime($toDate)) . ")");
        $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHP->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
        $rowcount++;

        $objPHP->getActiveSheet()->setCellValue('A' . $rowcount, "ID");
        $objPHP->getActiveSheet()->setCellValue('B' . $rowcount, "Name");
        $objPHP->getActiveSheet()->setCellValue('C' . $rowcount, "Mobile");
        $objPHP->getActiveSheet()->setCellValue('D' . $rowcount, "Email");
        $objPHP->getActiveSheet()->setCellValue('E' . $rowcount, "Entry DateTime");
        $objPHP->getActiveSheet()->setCellValue('F' . $rowcount, "English Marks");
        $objPHP->getActiveSheet()->setCellValue('G' . $rowcount, "Hindi Marks");
        $objPHP->getActiveSheet()->setCellValue('H' . $rowcount, "Maths Marks");
        $objPHP->getActiveSheet()->setCellValue('I' . $rowcount, "Science Marks");
        $objPHP->getActiveSheet()->setCellValue('J' . $rowcount, "Grade");
        
        $objPHP->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHP->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        
        //Freezing columns and Setting Background Color and text align = center
        $objPHP->getActiveSheet()->freezePane('C' . $rowcount);
        $objPHP->getActiveSheet()->getStyle('A3:J3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffccccff');
        $objPHP->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rowcount++;
        
        foreach ($data as $rows){
            $objPHP->getActiveSheet()->setCellValue('A' . $rowcount, $rows['id']);
            $objPHP->getActiveSheet()->setCellValue('B' . $rowcount, $rows['name']);
            $objPHP->getActiveSheet()->setCellValue('C' . $rowcount, $rows['mobile']);
            $objPHP->getActiveSheet()->setCellValue('D' . $rowcount, $rows['email']);
            $date=date_create($rows['entry_datetime']);
            $date=date_format($date,"d-m-Y H:i:s");
            $objPHP->getActiveSheet()->setCellValue('E' . $rowcount, $date);
            if($rows['english']==""||$rows['english']==null)
                       $rows['english']="-";
            $objPHP->getActiveSheet()->setCellValue('F' . $rowcount, $rows['english']);
            if($rows['hindi']==""||$rows['hindi']==null)
                       $rows['hindi']="-";
            $objPHP->getActiveSheet()->setCellValue('G' . $rowcount, $rows['hindi']);
            if($rows['maths']==""||$rows['maths']==null)
                       $rows['maths']="-";
            $objPHP->getActiveSheet()->setCellValue('H' . $rowcount, $rows['maths']);
            if($rows['science']==""||$rows['science']==null)
                       $rows['science']="-";
            $objPHP->getActiveSheet()->setCellValue('I' . $rowcount, $rows['science']);
            if($rows['grade']==""||$rows['grade']==null)
                       $rows['grade']="-";
            $objPHP->getActiveSheet()->setCellValue('J' . $rowcount, $rows['grade']);
            
            // Setting background color and text align = right, center
            $objPHP->getActiveSheet()->getStyle("A" . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHP->getActiveSheet()->getStyle("C" . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHP->getActiveSheet()->getStyle("E" . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHP->getActiveSheet()->getStyle("B" . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("D" . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("J" . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("F" . $rowcount . ":I" . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffdeeeff');
            $objPHP->getActiveSheet()->getStyle('C' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffdeeeff');
            $objPHP->getActiveSheet()->getStyle('E' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffdeeeff');
            $objPHP->getActiveSheet()->getStyle('G' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffdeeeff');
            $objPHP->getActiveSheet()->getStyle('I' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffdeeeff');
            $objPHP->getActiveSheet()->getStyle('B' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffffeef8');
            $objPHP->getActiveSheet()->getStyle('D' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffffeef8');
            $objPHP->getActiveSheet()->getStyle('F' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffffeef8');
            $objPHP->getActiveSheet()->getStyle('H' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffffeef8');
            $objPHP->getActiveSheet()->getStyle('J' . $rowcount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffffeef8');
            $rowcount++;
        }

        $writer = new PHPExcel_Writer_Excel2007($objPHP);
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=Student_Data.xls");
        $writer->save('php://output');
        exit;
    }
}

$xls = new ExcelFileDownload();
$xls->action();

?>