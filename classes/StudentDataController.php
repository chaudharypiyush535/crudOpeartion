<?php 

include('connection.php');

class StudentDataController{
    private $conn;
    public function __construct(){
        $this->conn = new ConnPDO();
        if(isset($_REQUEST['action']) && $_REQUEST['action']=='studentList'){
                $this->displayStudentData();
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='documentList'){
                $this->displayStudentDocument();
        }
    }
    
    public function action(){
        if(isset($_REQUEST['action']) && $_REQUEST['action']=='addStudent'){
            $this->addStudentData();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='deleteStudent'){
            $this->deleteStudentData();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='editStudent'){
            $this->editStudentData();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='viewStudentData'){
            $this->viewStudentData();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='addStudentMarks'){
            $this->addStudentMarks();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='viewStudentGrade'){
            $this->viewStudentGrade();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='viewAadhaarFront'){
            $this->viewAadhaarFront();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='viewAadhaarBack'){
            $this->viewAadhaarBack();   
        }
        elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='viewPANCard'){
            $this->viewPANCard();   
        }
    }

    function addStudentData(){
        $name =  $_POST['name' ];
        $mobile =  $_POST['mobile' ]; 
        $email =  $_POST['email' ];
        $status = 'ACTIVE'; 
        $sql=  "INSERT  INTO `studentdetails`(`name` , `mobile` , `email`, `entry_datetime`, `status` )
        VALUE  (' {$name} ' , ' {$mobile } ' , ' {$email } ' , NOW() , '{$status}' )" ; 
        $this->conn->Execute($sql);

        $query = "SELECT LAST_INSERT_ID()";
        $result = $this->conn->Execute($query); 
        if($result->rowCount()>0){
            $data = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                $data[] = $row;
            }
        }
        $last_id = $data[0]["LAST_INSERT_ID()"];

        $img1 = $_POST['img1'];
        $img2 = $_POST['img2'];
        $img3 = $_POST['img3'];

        // Insert the images into the database
        $sql = "INSERT INTO studentdocuments (id, file1, file2, file3) VALUES ('$last_id', '$img1', '$img2', '$img3')";
        if ($this->conn->Execute($sql)) {
        echo "Images stored successfully";
        } else {
        echo "Error storing images";
        }

    }

    function deleteStudentData(){
        $id =$_GET['id' ];  
        $status = 'INACTIVE';
        $sql= "UPDATE `studentdetails` SET `status` = '$status' WHERE `id`  =  $id " ; 
        
        if($this->conn->Execute($sql)){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record deleted succesfully!'
            ];
            exit(json_encode($response));
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record deleted failed!'
            ];
            exit(json_encode($response));
        } 
    }

    function editStudentData(){
        $name= $_POST['name' ];
        $mobile= $_POST['mobile' ];
        $email= $_POST['email' ];
        $id= $_POST['student_id' ];
        $sql1= "UPDATE `studentdetails`  SET  `name` = '". $name."'  , 
        `mobile`  =  '".$mobile ."' , `email`  ='".$email ."' WHERE `id` = $id " ;
        $this->conn->Execute($sql1);

        $img1 = $_POST['img1'];
        $img2 = $_POST['img2'];
        $img3 = $_POST['img3'];
        if($img1!=null){
            $sql= "UPDATE `studentdocuments`  SET  `file1` = '". $img1."' WHERE `id` = $id " ;
            $this->conn->Execute($sql);
        }
        if($img2!=null){
            $sql= "UPDATE `studentdocuments`  SET  `file2` =  '".$img2."' WHERE `id` = $id " ;
            $this->conn->Execute($sql);
        }
        if($img3!=null){
            $sql= "UPDATE `studentdocuments`  SET  `file3`  = '".$img3."' WHERE `id` = $id " ;
            $this->conn->Execute($sql);
        }
    }

    function displayStudentData(){
        $sql= "SELECT *  FROM `studentdetails` where `status` = 'ACTIVE' " ;
        $result = $this->conn->Execute($sql); 
        if($result->rowCount()>0){
            $data = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                $data[] = $row;
            }
            exit(json_encode($data));
        }
    }

    function displayStudentDocument(){
        $sql= "SELECT *  FROM `studentdocuments` LEFT JOIN `studentdetails` ON `studentdocuments`.`id` = `studentdetails`.`id` WHERE `studentdetails`.`status`='ACTIVE' " ; 
        $result = $this->conn->Execute($sql); 
        if($result->rowCount()>0){
            $data = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                $data[] = $row;
            }
            exit(json_encode($data));
        }
    }

    function viewStudentData(){ 
        $id= $_GET['id' ];
        $sql= "SELECT *  FROM `studentdetails`  WHERE  `id` =   $id";
        $result= $this->conn->Execute($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT) ;
        exit(json_encode($row));
    }

    function addStudentMarks(){
        $english =  $_POST['english']; 
        $hindi =  $_POST['hindi'];
        $maths =  $_POST['maths'];
        $science =  $_POST['science'];
        $id = $_POST['student_id'];

        $totalmarks = $english+$hindi+$maths+$science;

        $avg = $totalmarks/4;

        $grade = "";
        if($avg>=90){
            $grade = $grade."A";
        }
        elseif($avg>=80){
            $grade = $grade."B";
        }
        else{
            $grade = $grade."C";
        }


        $sql=  "INSERT  INTO `studentmarks`(`id` , `english` , `hindi` , `maths` , `science` , `grade` , `total_marks` )
        VALUES  (' {$id} ' , ' {$english} ' , ' {$hindi} ' , ' {$maths} ' , ' {$science} ' , ' {$grade} ' , ' {$totalmarks} ' )" ; 

        if($this->conn->Execute($sql)){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Marks entered succesfully!'
            ];
            exit(json_encode($response));
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Marks not entered'
            ];
            exit(json_encode($response));
        } 
    }

    function viewStudentGrade(){
        $id= $_GET['id' ];
        $sql= "SELECT *  FROM `studentmarks`  WHERE  `id` =   $id";
        $result= $this->conn->Execute($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT) ;
        exit(json_encode($row));
    }

    function viewAadhaarFront(){
        $id= $_POST['id' ];
        $sql = "SELECT file1 FROM studentdocuments WHERE id = $id";
        $result = $this->conn->Execute($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        exit(json_encode($row));
    }

    function viewAadhaarBack(){
        $id= $_POST['id' ];
        $sql = "SELECT file2 FROM studentdocuments WHERE id = $id";
        $result = $this->conn->Execute($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        exit(json_encode($row));
    }

    function viewPANCard(){
        $id= $_POST['id' ];
        $sql = "SELECT file3 FROM studentdocuments WHERE id = $id";
        $result = $this->conn->Execute($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        exit(json_encode($row));
    }
    
}

$sdc= new StudentDataController();
$sdc->action();

?>