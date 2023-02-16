<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/3cde454053.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="css\responsive.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"> -->
    <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<img src="images\bg.png" class="bg">

<!-- Student Details Table -->
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="bg-light p-2 m-2">
                    <h5 class="text-dark text-center" style="font-family: 'Berkshire Swash', cursive; font-size:40px;">Student Details</h5>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h2><button class="btn btn-dark" style="float:right; margin-right:8px;" data-target="#reportModal" data-toggle="modal"><i class="fa-solid fa-file"></i><span>Generate Report</span></button></h2>
                        <h2><a href="#addStudentModal" style="float:right; margin-right:8px;" class="btn btn-dark" data-toggle="modal"><i class="material-icons">&#xE147;</i><span>Add New Student</span></a></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Entry Date & Time</th>
                        <th>Grade</th>
                        <th>Marks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="student_data">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Student Documents Table -->
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="bg-light p-2 m-2">
                    <h5 class="text-dark text-center" style="font-family: 'Berkshire Swash', cursive; font-size:40px;">Download Documents</h5>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th colspan=3 style="text-align:center;">Download</th>
                        <th></th>
                        <th colspan=3 style="text-align:center;">View</th>
                    </tr>
                </thead>
                <tbody id="student_document">
                </tbody>
            </table>
        </div>
    </div>
</div>   

    <!-- Add Modal HTML -->
    <div id="addStudentModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addDataForm" action="student.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Student</h4>
                        <button type="button" id="cancel" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearModal()">&times;</button>
                    </div>
                    <div class="modal-body add_student">
                        <div class="form-group" id="divname">
                            <label>name</label>
                            <input type="text" id="name_input" class="form-control" required><b><span class="formerror" style="color:red; font-size:12px;"></span></b>
                        </div>
                        <div class="form-group" id="divmobile">
                            <label>mobile</label>
                            <input type="text" id="mobile_input" class="form-control" required><b><span class="formerror" style="color:red; font-size:12px;"></span></b>
                        </div>
                        <div class="form-group" id="divemail">
                            <label>email</label>
                            <input type="email" id="email_input" class="form-control" required><b><span class="formerror"></span></b>
                        </div>
                        <div class="form-group" id="divfile">
                            <label>select a file (Aadhaar Front):</label>
                            <input type="file" id="adhar_card_front" name="adhar_card_front" class="form-control" />
                            <label>select a file (Aadhaar Back):</label>
                            <input type="file" id="adhar_card_back" name="adhar_card_back" class="form-control" />
                            <label>select a file (PAN Card):</label>
                            <input type="file" id="pancard" name="pancard" class="form-control" />
                            <input type="hidden" id="student_id" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" id="cancel" class="btn btn-dark" data-dismiss="modal" value="Cancel" onclick="clearModal()">
                        <input type="submit" name="submit" class="btn btn-danger button" value="Add" id="submitBtn" onclick="addStudent()">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal HTML -->
    <div id="editStudentModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body edit_student">
                    <div class="form-group" id="divname">
                        <label>name</label>
                        <input type="text" id="name_input" class="form-control" required>
                    </div>
                    <div class="form-group" id="divmobile">
                        <label>mobile</label>
                        <input type="text" id="mobile_input" class="form-control" required><b>
                    </div>
                    <div class="form-group" id="divemail">
                        <label>email</label>
                        <input type="email" id="email_input" class="form-control" required><b>
                        <input type="hidden" id="student_id" class="form-control" required>
                        <label>select a file (Aadhaar Front):</label>
                        <input type="file" id="adhar_card_front" name="adhar_card_front" class="form-control" />
                        <label>select a file (Aadhaar Back):</label>
                        <input type="file" id="adhar_card_back" name="adhar_card_back" class="form-control" />
                        <label>select a file (PAN Card):</label>
                        <input type="file" id="pancard" name="pancard" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" data-toggle="modal" data-target="#editConfirmModal" data-dismiss="modal" aria-hidden="true" value="Save">
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Confirm Modal HTML -->
    <div id="editConfirmModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to edit these Records?</p>
                    <p class="text-danger"><small>*This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" onclick="editStudent()" value="Confirm">
                </div>
            </div>
        </div>
    </div>

    <!-- Marks Modal HTML -->
    <div id="marksModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addMarksForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Marks</h4>
                        <button type="button" id="cancel" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearModal()">&times;</button>
                    </div>
                    <div class="modal-body add_marks">
                        <div class="form-group">
                            <label>english</label>
                            <input type="number" id="english_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>hindi</label>
                            <input type="number" id="hindi_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>maths</label>
                            <input type="number" id="maths_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>science</label>
                            <input type="number" id="science_input" class="form-control" required>
                            <input type="hidden" id="student_id" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" id="cancel" class="btn btn-dark" data-dismiss="modal" value="Cancel" onclick="clearModal()">
                        <input type="submit" class="btn btn-danger" value="Add" data-toggle="modal" data-target="#marksConfirmModal" data-dismiss="modal" aria-hidden="true">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Marks Confirm Modal -->
    <div id="marksConfirmModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Marks</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to add these Marks?</p>
                    <p class="text-danger"><small>*This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" onclick="addMarks()" value="Confirm">
                </div>
            </div>
        </div>
    </div>

    <!-- Grade Modal HTML -->
    <div id="gradeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Result</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body view_grade">
                    <div class="form-group">
                        <label>Grade</label>
                        <input type="text" id="grade_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Percentage</label>
                        <input type="text" id="percentage_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Marks in English</label>
                        <input type="text" id="english_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Marks in Hindi</label>
                        <input type="text" id="hindi_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Marks in Maths</label>
                        <input type="text" id="maths_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Marks in Science</label>
                        <input type="text" id="science_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <span><b style="color:red;">Note :- </b>Grade are being calculated on percentage basis i.e.,&nbsp; A: >=90%, B: >=80%, C: <80%.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal HTML -->
    <div id="reportModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="generateReportForm" name="myForm" action="classes/PdfFileDownload.php" method="post" onsubmit="return validateReportForm()">
                    <div class="modal-header">
                        <h4 class="modal-title">Generate Report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body generate_report" id="divfromdate">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" name="fromDateValue" id="fromdate_input" class="form-control" required><b><span class="formerror" style="color:red;"></span></b>
                        </div>
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="date" name="toDateValue" id="todate_input" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <button class="btn btn-dark" type="submit" >Download PDF</button>
                            <button class="btn btn-dark" type="submit" formaction="classes/ExcelFileDownload.php">Download Excel</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-dark" data-dismiss="modal" value="Close">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteStudentModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-danger"><small>*This action cannot be undone.</small></p>
                </div>
                <input type="hidden" id="delete_id">
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" onclick="deleteStudent()" value="Delete">
                </div>
            </div>
        </div>
    </div>

    <!-- View Aadhaar Card Front Modal -->
    <div id="viewAadhaarFrontModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Aadhaar Card - Front</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="viewAadhaarFront">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                </div>
            </div>
        </div>
    </div>

    <!-- View Aadhaar Card Back Modal -->
    <div id="viewAadhaarBackModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Aadhaar Card - Back</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="viewAadhaarBack">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                </div>
            </div>
        </div>
    </div>

    <!-- View PAN Modal -->
    <div id="viewPANModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">PAN Card</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="viewPAN">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                </div>
            </div>
        </div>
    </div>

    <script>
        var img_Aadhar_Card_Front_Base64;
        var img_Aadhar_Card_Back_Base64;
        var imgPancard_Base64;
        var fileSize;
        var maxfileSize=300;
        $(document).ready(function () {
            studentList();
            documentList();
            $('input[type = file][name = adhar_card_front]').change(function() {
                fileSize = this.files[0].size / 1024;
                if (!checkImage(this.files[0].name)) {
                    alert(this.files[0].name + " :- Is Not Valid Image..");
                    $(this).val('');
                    img_Aadhar_Card_Front_Base64 = "";
                    $('#bteimgPreview').attr('src', "./images/userprofile.jpg");
                } else if (fileSize > maxfileSize) {
                    alert("File size should be less than or equal to " + maxfileSize + " kb.");
                    $(this).val('');
                    img_Aadhar_Card_Front_Base64 = "";
                } else {
                    readURLFront(this);
                }
            });
            $('input[type = file][name = adhar_card_back]').change(function() {
                fileSize = this.files[0].size / 1024;
                if (!checkImage(this.files[0].name)) {
                    alert(this.files[0].name + " :- Is Not Valid Image..");
                    $(this).val('');
                    img_Aadhar_Card_Back_Base64 = "";
                    $('#bteimgPreview').attr('src', "./images/userprofile.jpg");
                } else if (fileSize > maxfileSize) {
                    alert("File size should be less than or equal to " + maxfileSize + " kb.");
                    $(this).val('');
                    img_Aadhar_Card_Back_Base64 = "";
                } else {
                    readURLBack(this);
                }
            });
            $('input[type = file][name = pancard]').change(function() {
                fileSize = this.files[0].size / 1024;
                if (!checkImage(this.files[0].name)) {
                    alert(this.files[0].name + " :- Is Not Valid Image..");
                    $(this).val('');
                    imgPancard_Base64 = "";
                    $('#bteimgPreview').attr('src', "./images/userprofile.jpg");
                } else if (fileSize > maxfileSize) {
                    alert("File size should be less than or equal to " + maxfileSize + " kb.");
                    $(this).val('');
                    imgPancard_Base64 = "";
                } else {
                    readURLPanCard(this);
                }
            });
        });

        function checkImage(fileName) {
            var extension = ["png", "gif", "jpeg", "jpg"];
            var n = fileName.substring(fileName.lastIndexOf(".") + 1);
            var name = fileName;
            return extension.includes(n.toLowerCase());
        }

        function readURLFront(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    img_Aadhar_Card_Front_Base64= e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLBack(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    img_Aadhar_Card_Back_Base64 = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLPanCard(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgPancard_Base64 = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgPancard_Base64 = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function studentList() {
            var action = 'studentList';
            $.ajax({
                type: 'get',
                data: {
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    var tr = '';
                    for (var i = 0; i < response.length; i++) {
                        var id = response[i].id;
                        var name = response[i].name;
                        var mobile = response[i].mobile;
                        var email = response[i].email;
                        var date = new Date(response[i].entry_datetime);
                        var time = date.toLocaleTimeString();
                        var d = date.getDate();
                        var m = date.getMonth();
                        var y = date.getFullYear();
                        var datetime = d+"/"+(m+1)+"/"+y+" "+time;

                        tr += '<tr>';
                        tr += '<td>' + id + '</td>';
                        tr += '<td>' + name + '</td>';
                        tr += '<td>' + mobile + '</td>';
                        tr += '<td>' + email + '</td>';
                        tr += '<td>' + datetime + '</td>';
                        tr += '<td><div class="d-flex">';
                        tr += '<a href="" data-toggle="modal" data-target="#gradeModal" class="btn btn-primary" style="color:white;" onclick=viewGrade("' +
                        id +
                        '")>Grade</a>';
                        tr += '</div></td>';
                        tr += '<td><div class="d-flex">';
                        tr += '<a href="" data-toggle="modal" data-target="#marksModal" class="btn btn-primary" style="color:white;" onclick=viewStudent("' +
                        id +
                        '")>Marks</a>';
                        tr += '</div></td>';
                        tr += '<td><div class="d-flex">';
                        tr +=
                            '<a href="#editStudentModal" class="m-1 edit" data-toggle="modal" onclick=viewStudent("' +
                            id +
                            '")><i class="fa fa-edit" aria-hidden="true"></i></a>';
                        tr +=
                            '<a href="#deleteStudentModal" class="m-1 delete" data-toggle="modal" onclick=$("#delete_id").val("' +
                            id +
                            '")><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>';
                        tr += '</div></td>';
                        tr += '</tr>';
                    }
                    $('#student_data').html(tr);
                }
            });
        }

        function documentList() {
            var action = 'documentList';
            $.ajax({
                type: 'get',
                data: {
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    var tr = '';
                    for (var i = 0; i < response.length; i++) {
                        var id = response[i].id;
                        var filename1 = response[i].filename1;
                        var filename2 = response[i].filename2;
                        var filename3 = response[i].filename3;
                        var file1 = response[i].file1;
                        tr += '<tr>';
                        tr += '<td>' + id + '</td>';
                        tr += '<td><div class="d-flex">';
                        tr += `<a href='${response[i].file1}' download target="_blank" class="btn btn-primary" style="color:white;">Aadhaar Front</a>`;
                        tr += '</div></td>';
                        tr += '<td><div class="d-flex">';
                        tr += `<a href='${response[i].file2}' download class="btn btn-primary" style="color:white;">Aadhaar Back</a>`;
                        tr += '</div></td>';
                        tr += '<td><div class="d-flex">';
                        tr += `<a href='${response[i].file3}' download class="btn btn-primary" style="color:white;">PAN Card</a>`;
                        tr += '</div></td>';
                        tr += '<td>' + "||" +  '</td>';
                        tr += '<td><div class="d-flex">';
                        tr +=
                            '<button class="btn btn-primary" data-toggle="modal" data-target="#viewAadhaarFrontModal" style="color:white;" onclick=viewAadhaarFront("' +
                            id +
                            '")>View Aadhaar Front</button>';
                        tr += '</div></td>';
                        tr += '<td><div class="d-flex">';
                        tr +=
                            '<button class="btn btn-primary" data-toggle="modal" data-target="#viewAadhaarBackModal" style="color:white;" onclick=viewAadhaarBack("' +
                            id +
                            '")>View Aadhaar Back</button>';
                        tr += '</div></td>';
                        tr += '<td><div class="d-flex">';
                        tr +=
                            '<button class="btn btn-primary" data-toggle="modal" data-target="#viewPANModal" style="color:white;" onclick=viewPANCard("' +
                            id +
                            '")>View PAN Card</button>';
                        tr += '</div></td>';
                        tr += '</tr>';
                    }
                    $('#student_document').html(tr);
                }
            })
        }
        
        function addStudent() {
            var name = $('.add_student #name_input').val();
            var mobile = $('.add_student #mobile_input').val();
            var email = $('.add_student #email_input').val();
            var action = 'addStudent';
            
            function seterror(id, error){
                element = document.getElementById(id);
                element.getElementsByClassName('formerror')[0].innerHTML = error;
            }
            function validateForm(){
                var returnval = true;
                clearErrors();
                if(name.length<3){
                    seterror("divname", "*Name length is too short.");
                    returnval = false;
                }
                if(mobile.length!=10){
                    seterror("divmobile", "*Mobile number should be of 10 digits.");
                    returnval = false;
                }
                return returnval;
            }
            function clearErrors(){
                errors = document.getElementsByClassName('formerror');
                for(let item of errors){
                    item.innerHTML = "";
                }
            }
            var result = validateForm();
            if(result==true){
                $.ajax({
                    type: 'post',
                    data: {
                        name: name,
                        mobile: mobile,
                        email: email,
                        img1:img_Aadhar_Card_Front_Base64,
                        img2:img_Aadhar_Card_Back_Base64,
                        img3:imgPancard_Base64, 
                        action: action
                    },
                    url: "classes/StudentDataController.php",
                    success: function (data) {
                        alert("Student Added Successfully");
                        var response = JSON.parse(data);
                        $('#addStudentModal').modal('hide');
                        $('#addDataForm')[0].reset();
                        location.reload();
                        studentList();
                        documentList();
                    }
                })
            }
            
        }
        
        function checkImage(fileName) {
            var extension = ["png", "gif", "jpeg", "jpg"];
            var n = fileName.substring(fileName.lastIndexOf(".") + 1);
            var name = fileName;
            return extension.includes(n.toLowerCase());
        }

        function addMarks() {
            var english = $('.add_marks #english_input').val();
            var hindi = $('.add_marks #hindi_input').val();
            var maths = $('.add_marks #maths_input').val();
            var science = $('.add_marks #science_input').val();
            var student_id = $('.add_marks #student_id').val();
            var action = 'addStudentMarks';

            $.ajax({
                type: 'post',
                data: {
                    english: english,
                    hindi: hindi,
                    maths: maths,
                    science: science,
                    student_id: student_id,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    $('#marksModal').modal('hide');
                    studentList();
                    location.reload();
                }
            })
        }

        function editStudent() {
            var name = $('.edit_student #name_input').val();
            var mobile = $('.edit_student #mobile_input').val();
            var email = $('.edit_student #email_input').val();
            var student_id = $('.edit_student #student_id').val();
            var action = 'editStudent';
            $.ajax({
                type: 'post',
                data: {
                    name: name,
                    mobile: mobile,
                    email: email,
                    student_id: student_id,
                    img1:img_Aadhar_Card_Front_Base64,
                    img2:img_Aadhar_Card_Back_Base64,
                    img3:imgPancard_Base64,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function () {
                    // var response = JSON.parse(data);
                    $('#editStudentModal').modal('hide');
                    studentList();
                    location.reload();
                }
            })
        }

        function viewStudent(id) {
            var action = 'viewStudentData';
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    $('.edit_student #name_input').val(response.name);
                    $('.edit_student #mobile_input').val(response.mobile);
                    $('.edit_student #email_input').val(response.email);
                    $('.edit_student #student_id').val(response.id);
                    $('.add_marks #student_id').val(response.id);
                    $('.view_student #name_input').val(response.name);
                    $('.view_student #mobile_input').val(response.mobile);
                    $('.view_student #email_input').val(response.email);
                }
            })
        }

        function viewGrade(id) {
            var action = 'viewStudentGrade';
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    $('.view_grade #grade_input').val(response.grade);
                    $('.view_grade #percentage_input').val(response.percentage);
                    $('.view_grade #english_input').val(response.english);
                    $('.view_grade #hindi_input').val(response.hindi);
                    $('.view_grade #maths_input').val(response.maths);
                    $('.view_grade #science_input').val(response.science);
                }
            })
        }

        function deleteStudent() {
            var id = $('#delete_id').val();
            var action = 'deleteStudent';
            $('#deleteStudentModal').modal('hide');
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    studentList();
                }
            })
            location.reload();
        }

        function validateReportForm(){
            var returnval = true;
            clearErrors();
            var fromDateValue = $('.generate_report #fromdate_input').val();
            var toDateValue = $('.generate_report #todate_input').val();
            var fromDate = new Date(fromDateValue);
            var toDate = new Date(toDateValue);
            if (fromDate > toDate) {
                    seterror("divfromdate", "*From date must be shorter than to date.");
                    returnval = false;
                }
            return returnval;

            function seterror(id, error){
                element = document.getElementById(id);
                element.getElementsByClassName('formerror')[0].innerHTML = error;
            }

            function clearErrors(){
                errors = document.getElementsByClassName('formerror');
                for(let item of errors){
                    item.innerHTML = "";
                }
            }
        }

        function clearModal(){
            $("#cancel").click(function(){
                $('#addMarksForm')[0].reset();
                $('#addDataForm')[0].reset();
            });
        }

        function viewAadhaarFront(id){
            var action = 'viewAadhaarFront';
            $.ajax({
                type: 'post',
                data: {
                    id: id,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    var location = Object.values(response)[0];
                    $('#viewAadhaarFront').html('<img style="width:350px; height:-webkit-fill-available;" src="'+location+'">');
                }
            })
        }

        function viewAadhaarBack(id){
            var action = 'viewAadhaarBack';
            $.ajax({
                type: 'post',
                data: {
                    id: id,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    var location = Object.values(response)[0];
                    $('#viewAadhaarBack').html('<img style="width:350px; height:-webkit-fill-available;" src="'+location+'">');
                }
            })
        }

        function viewPANCard(id){
            var action = 'viewPANCard';
            $.ajax({
                type: 'post',
                data: {
                    id: id,
                    action: action
                },
                url: "classes/StudentDataController.php",
                success: function (data) {
                    var response = JSON.parse(data);
                    var location = Object.values(response)[0];
                    $('#viewPAN').html('<img style="width:350px; height:-webkit-fill-available;" src="'+location+'">');
                }
            })
        }

    </script>          

</body>
</html>