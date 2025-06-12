<!DOCTYPE html>
<html lang="en">
<?php
include 'conn.php';
if(isset($_SESSION["empid"])){
        
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];
$leaveSuccessMessage = '';
$leaveFailureMessage = '';
if(isset($_POST['submit'])){

    $lid=$_POST['ltype'];
    $fromd=$_POST['fromd'];
    $tod=$_POST['tod'];
    if($tod){
        $date2 = new DateTime($tod);
        $date1 = new DateTime($fromd);
    $interval = $date1->diff($date2);
    $daysDiff = $interval->format('%a');
    if($daysDiff == 0){
        $daysDiff = 1;
    }
    }else{
        $daysDiff = 0.5;
        $tod = $fromd;
    }
    
    $reason=$_POST['reason'];
    $currentDateTime = date("Y-m-d H:i:s");
    $session=$_POST['session'] ;
   
//$file1=$_FILES['file1'];
     $fileDestination="";
 if(isset($_FILES['file1']) && $_FILES['file1']['error'] === UPLOAD_ERR_OK) {
    $filename = $_FILES['file1']['name'];
    $tempFilePath = $_FILES['file1']['tmp_name'];
         $fileDestination = 'docu/' . $filename;

    
    if(move_uploaded_file($tempFilePath, $fileDestination)) {
      
    } else {
        $leaveFailureMessage = 'Failed to upload file.';
    }
} 
    if (date('D', strtotime($fromd)) === 'Sun') {
        $leaveFailureMessage = 'Leaves cannot be applied on Sundays. Please select another date.';
    } 
 
    elseif(strtotime($fromd) < strtotime(date('Y-m-d'))) {
        $leaveFailureMessage = 'Cannot apply leave for previous dates.';
    } 
    // elseif(strtotime($tod) < strtotime($fromd)) {
    //     $leaveFailureMessage = 'End date cannot be earlier than start date.';
    // } 
    else {
        $sql = "INSERT INTO tbl_leave (emp_id, l_id, session, st_date, to_date, document, reason, status, appliedtime, daydiff) 
                VALUES (
                    '" . mysqli_real_escape_string($conn, $empid) . "', 
                    '" . mysqli_real_escape_string($conn, $lid) . "', 
                    '" . mysqli_real_escape_string($conn, $session) . "', 
                    '" . mysqli_real_escape_string($conn, $fromd) . "', 
                    '" . mysqli_real_escape_string($conn, $tod) . "', 
                    '" . mysqli_real_escape_string($conn, $fileDestination) . "', 
                    '" . mysqli_real_escape_string($conn, $reason) . "', 
                    '0', 
                    '" . mysqli_real_escape_string($conn, $currentDateTime) . "', 
                    '" . mysqli_real_escape_string($conn, $daysDiff) . "'
                )";
        
        if($conn->query($sql) == true){
           // $leaveSuccessMessage = 'Leave applied successfully';

           ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Apply</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
    $(document).ready(function() {
        $('#enhance-btn').on('click', function () {
            const reason = $('#reason').val().trim();
            if (!reason) {
                alert("Enter a reason first");
                return;
            }

            $.ajax({
                url: 'enhance_reason.php',
                type: 'POST',
                data: { reason: reason },
                success: function (response) {
                    let parsed;
                    try {
                        parsed = typeof response === 'string' ? JSON.parse(response) : response;
                    } catch (e) {
                        alert('Invalid JSON response');
                        return;
                    }

                    if (parsed.error) {
                        alert('Error: ' + parsed.error);
                    } else if (parsed.enhanced_text) {
                        $('#reason').val(parsed.enhanced_text);
                    } else {
                        alert('Unexpected response from API');
                    }
                },
                error: function () {
                    alert('Failed to reach enhancement service.');
                }
            });
        });
    });
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
            </head>
            <body>
            <script>
                    Swal.fire({
        text: "Leave Applied successfully!",
        icon: "success",
          showConfirmButton: false,
        timer:2000
    }).then(() => {
        // Redirect to another page
        window.location.href = "apply_leave.php";
    }); 
            </script>
            </body>
            </html>
           <?php
        } else{
            $leaveFailureMessage = 'Leave application failed';
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Apply</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        .custom-width {
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                    <i class="fa fa-users text-success me-4"></i>
                    <span id="span01" style="font-size: smaller;">UPLeave</span>

                </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li class="sidebar-item ">
                        <a href="employee.php" class='sidebar-link'>
                        <i class="fa fa-home text-success"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item active">
                        <a href="apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="cancel_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Cancel Leave Request</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="leave_status.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Leave Status</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="leavelist.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Permissions</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="leavehistory.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Leave history</span>
                        </a>
                     </li>
                      <li class="sidebar-item ">
                        <a href="notifications.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Notifications <?php echo $_SESSION['not'];?></span>
                        </a>
                     </li>
                  </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <!-- 3 lines portion-->
            <nav class="navbar navbar-header navbar-expand navbar-light">
              <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                 <!-- 3 lines portion ends here-->
                  <!-- notification-->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                
                            </a>
                           
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="" />
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">
                                <?php echo $x."<br>".$empid ?>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="evacc.php"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>  
            </nav>
            
            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Apply for Leave</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="employee.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Leave Application</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                      <form class="form" name="submit" action="#" method="POST" onsubmit="return validateForm()">
    <!-- Leave Type -->
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="leave-type">Select Leave Type</label>
                <div class="position-relative">
                    <fieldset class="form-group">
                        <select class="form-select custom-width" name="ltype" id="leaveType" onblur=>
                            <option selected>Select Leave Type</option>
                            <?php
                            if($_SESSION['casualcount'] >= 0){
                                ?>
                                <option value="1">Casual Leave</option>
                                <?php
                            }
                            
                            if($_SESSION['vacationcount'] >= 0){
                                ?>
                                <option value="2">Vacation Leave</option>
                                <?php
                            }
                           
                            ?>
                            
                            <option value="7">Compensatory Leave</option>
                        </select>
                    </fieldset>
                </div>
                <span id="leaveTypeValidation" style="color: red;"></span>
            </div>
        </div>
    </div>
    <!-- Additional Select Box for leave types other than "Vacation Leave" -->
    <div class="row" id="additionalOptionsRow" style="display: none;">
        <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="additional-options">Select Session</label>
                <div class="position-relative">
                    <fieldset class="form-group">
                        <select class="form-select custom-width" name="session" id="additionalOptions">
                            
                            <option value="Full Day" selected>Full Day</option>
                            <option value="FN">FN</option>
                            <option value="AN">AN</option>
                            <!-- Options will be dynamically added using JavaScript -->
                        </select>
                    </fieldset>
                </div>
                <span id="additionalOptionsValidation" style="color: red;"></span>
            </div>
        </div>
    </div>
    <!-- From Date -->
    <div class="row">
        <?php
        $currentDate = date('d-m-Y');
        ?>
        <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="from-date">From Date</label>
                <div class="position-relative">
                    <input type="date" class="form-control" name="fromd" id="from-date" min="2024-02-19" onkeydown="return false">
                    <div class="form-control-icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <span id="fromDateValidation" style="color: red;"></span>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="to-date">To Date</label>
                <div class="position-relative">
                    <input type="date" class="form-control"  name="tod" id="to-date" onkeydown="return false">
                    <div class="form-control-icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <span id="toDateValidation" style="color: red;"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group has-icon-left">
                <label for="absence-reason">* Reason for Absence</label>
                <textarea class="form-control" required name="reason" id="reason" rows="4" style="width: 70%; max-width: 70%;" required></textarea>
                <div class="mt-2">
                    <button type="button" class="btn btn-secondary" id="enhance-btn">
                        <i class="fas fa-magic me-1"></i> Enhance Reason with AI
                    </button>
                    <div id="enhance-loading" class="spinner-border text-primary ms-2" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span id="enhance-status" class="ms-2" style="display: none;">Enhancing your reason...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit Request</button>
        </div>
    </div>
    <span style="color: green;"><?php echo $leaveSuccessMessage; ?></span>
    <span style="color: red;"><?php echo $leaveFailureMessage; ?></span>
</form>

                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic multiple Column Form section end -->
            </div>
        </div>
    </div>
    <script>
    function displayAdditionalOptions() {
        const leaveType = document.getElementById("leaveType").value;
        document.getElementById("additionalOptionsRow").style.display = (leaveType !== "2") ? "block" : "none";
    }

    function handleLeaveOptionChange() {
        const option = document.getElementById("additionalOptions").value;
        const toDateInput = document.getElementById("to-date").parentNode.parentNode;
        document.querySelector("label[for='from-date']").textContent = (option === "FN" || option === "AN") ? "Select Date" : "From Date";
        toDateInput.style.display = (option === "FN" || option === "AN") ? "none" : "block";
    }

    function validateLeaveType() {
        const leaveType = document.getElementById('leaveType').value;
        document.getElementById('leaveTypeValidation').textContent = (leaveType === "Select Leave Type") ? "Please select a leave type." : "";
    }

    function validateFromDate() {
        const fromDate = document.getElementById('from-date').value;
        document.getElementById('fromDateValidation').textContent = (!fromDate) ? "Please select a start date." : "";
    }

    function validateToDate() {
        const fromDate = document.getElementById('from-date').value;
        const toDate = document.getElementById('to-date').value;
        let message = "";
        if (!toDate) message = "Please select an end date.";
        else if (toDate < fromDate) message = "End date cannot be earlier than start date.";
        document.getElementById('toDateValidation').textContent = message;
    }

    function validateForm() {
        validateLeaveType();
        validateFromDate();
        validateToDate();
        const leaveType = document.getElementById('leaveType').value;
        const fromDate = document.getElementById('from-date').value;
        if (leaveType === "Select Leave Type" || !fromDate) return false;
        if (new Date(fromDate) < new Date()) return false;
        return true;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById("additionalOptions").addEventListener("change", handleLeaveOptionChange);
        document.getElementById("leaveType").addEventListener("change", displayAdditionalOptions);
        document.getElementById("leaveType").addEventListener("blur", validateLeaveType);
        document.getElementById("from-date").addEventListener("blur", validateFromDate);
        document.getElementById("to-date").addEventListener("blur", validateToDate);

        
    });
</script>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/enhance-reason.js"></script>

    <script>
        $(document).ready(function() {
            const enhanceBtn = $('#enhance-btn');
            const loadingSpinner = $('#enhance-loading');
            const statusText = $('#enhance-status');
            const reasonTextarea = $('#reason');

            function resetLoadingState() {
                enhanceBtn.prop('disabled', false);
                loadingSpinner.hide();
                statusText.hide();
                enhanceBtn.html('<i class="fas fa-magic me-1"></i> Enhance Reason with AI');
            }

            enhanceBtn.on('click', function() {
                const reason = reasonTextarea.val().trim();
                
                if (!reason) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Empty Reason',
                        text: 'Please enter a reason first before enhancing.',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                // Show loading state
                enhanceBtn.prop('disabled', true);
                loadingSpinner.show();
                statusText.show();
                enhanceBtn.html('<i class="fas fa-spinner fa-spin me-1"></i> Enhancing...');

                $.ajax({
                    url: 'reason_enhancer.php',
                    type: 'POST',
                    data: { reason: reason },
                    dataType: 'json',
                    success: function(response) {
                        resetLoadingState(); // Reset loading state before processing response
                        
                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Enhancement Failed',
                                text: response.error,
                                confirmButtonColor: '#3085d6'
                            });
                        } else if (response.enhanced_text) {
                            reasonTextarea.val(response.enhanced_text);
                            Swal.fire({
                                icon: 'success',
                                title: 'Reason Enhanced',
                                text: 'Your leave reason has been professionally enhanced!',
                                confirmButtonColor: '#3085d6',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        resetLoadingState(); // Reset loading state on error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to enhance reason. Please try again later.',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php
    }else{
        header("Location:login.php");
        exit();
    }
    ?>