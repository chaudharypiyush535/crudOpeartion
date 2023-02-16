<?php
include 'classes/connection.php';
$conn = new connPDO;

$query = "SELECT * FROM `studentmarks` ";
$result = $conn->Execute($query);
$data = $result->fetchAll();

$gradeA = 0;
$gradeB = 0;
$gradeC = 0;

foreach ($data as $row){
    if($row['percentage']=="" || $row['percentage']==null){
        $id = $row['id'];
        $percentage = $row['total_marks']/4;
        $percentage = $percentage."% ";
        $query = " UPDATE `studentmarks` SET `percentage` = '$percentage' where id = $id ";
        $result = $conn->Execute($query);
    }

    $grade = $row['grade'];
    if($grade==" A "){
        $gradeA++;
    }
    elseif($grade==" B "){
        $gradeB++;
    }
    elseif($grade==" C "){
        $gradeC++;
    }
}

echo "<h1>Percentage calculated successfully.</h1>";
echo "<h2>Number of times A grade occured : $gradeA</h2>";
echo "<h2>Number of times B grade occured : $gradeB</h2>";
echo "<h2>Number of times C grade occured : $gradeC</h2>";
echo "<BR> <BR>";

$query2 = "SELECT `studentdetails`.`id`, `name` FROM `studentdetails` LEFT JOIN `studentdocuments` ON `studentdetails`.`id` = `studentdocuments`.`id` WHERE `studentdocuments`.`id` IS NULL ";
$result2 = $conn->Execute($query2);
$data2 = $result2->fetchAll();

echo "<h2> Following students have not submitted documents :-</h2>";
echo "<table border = 8> <tr> <th>ID</th> <th>Name</th> </tr>";

foreach($data2 as $row){
    $id = $row['id'];
    $name = $row['name'];
    echo "<tr> <td> $id </td> <td> $name </td> </tr>";
}
echo "</table>";

?>