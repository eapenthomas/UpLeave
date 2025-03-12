<!DOCTYPE html>
<html lang="en">
<?php
include 'conn.php';
if(isset($_SESSION['empid'])) {
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];
$leaveSuccessMessage = '';
$leaveFailureMessage = '';
if(isset($_POST['submit'])){
    
    $lid=6;
    $fromd=$_POST['from_date'];
    $tod=$_POST['to_date'];
    $reason=$_POST['reason'];
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
        $tod= $fromd;
    }
    $currentDateTime = date("Y-m-d H:i:s");
    $session="Full Day";
     $fileDestination="";

    // Check if start date is Sunday
    if (date('D', strtotime($fromd)) === 'Sun') {
        $leaveFailureMessage = 'Leaves cannot be applied on Sundays. Please select another date.';
    } elseif(empty($lid) || empty($fromd) || empty($tod)) {
        $leaveFailureMessage = 'Leave type, start date, and end date cannot be empty.';
    } elseif(strtotime($fromd) < strtotime(date('Y-m-d'))) {
        $leaveFailureMessage = 'Cannot apply leave for previous dates.';
    } elseif(strtotime($tod) < strtotime($fromd)) {
        $leaveFailureMessage = 'End date cannot be earlier than start date.';
    } else {
        $sql = "INSERT INTO tbl_leave (emp_id, l_id,session,st_date, to_date, document,reason,status,appliedtime,daydiff) VALUES ('$empid', '$lid', '$session', '$fromd', '$tod', '$fileDestination','$reason','0','$currentDateTime','$daysDiff ');";
        if($conn->query($sql) == true){
            $leaveSuccessMessage = 'Leave applied successfully';
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
                     <li class="sidebar-item ">
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
                     <li class="sidebar-item active">
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
                                <div class="d-lg-inline-block">
                                    <i data-feather="bell"></i><span class="badge bg-info"></span>
                                </div>
                            </a>
                             <!-- notification ends here-->
                            <!-- <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                                <h6 class="py-2 px-4">Notifications</h6>
                                <ul class="list-group rounded-none">
                                    <li class="list-group-item border-0 align-items-start">
                                        <div class="row mb-2">
                                            <div class="col-md-12 notif">
                                                <a href="leave_details.html">
                                                    <h6 class="text-bold">John Doe</h6>
                                                    <p class="text-xs">
                                                        applied for leave at 05-21-2021
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-md-12 notif">
                                                <a href="leave_details.html">
                                                    <h6 class="text-bold">Jane Doe</h6>
                                                    <p class="text-xs">
                                                        applied for leave at 05-21-2021
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div> -->
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
                            <h3>Apply for Long Leave</h3>
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
<form class="form" name="submit" action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <!-- Number of Days -->
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="no-of-days">Number of Days</label>
                <input type="number" class="form-control" name="no_of_days" id="no-of-days" oninput="updateDateFields()">
                <span id="noOfDaysValidation" style="color: red;"></span>
            </div>
        </div>
    </div>

    <!-- Date Fields -->
    <div class="row">
        <div class="col-md-6 col-6">
            <div class="form-group has-icon-left">
                <label for="from-date" id="from-date-label">Select Date</label>
                <input type="date" class="form-control" name="from_date" id="from-date" min="2024-02-19" oninput="validateFromDate()">
                <span id="fromDateValidation" style="color: red;"></span>
            </div>
        </div>
        <div class="col-md-6 col-6" id="toDateCol" style="display: none;">
            <div class="form-group has-icon-left">
                <label for="to-date">To Date</label>
                <input type="date" class="form-control" name="to_date" id="to-date" oninput="validateToDate()">
                <span id="toDateValidation" style="color: red;"></span>
            </div>
        </div>
    </div>

    <!-- Date Of Resumption and Select Leave Option -->
    <div class="row">
        <div class="col-md-6 col-6">
            <div class="form-group has-icon-left">
                <label for="assignment-duty">Date Of Resumption</label>
                <input type="Date" class="form-control" name="assignment_duty" id="assignment-duty" style="width: 490px;"  oninput="validateAssignmentDuty()">
                <span id="assignmentDutyValidation" style="color: red;"></span>
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="form-group has-icon-left">
                <label for="additional-options">Select Leave Option</label>
                <div class="position-relative">
                    <fieldset class="form-group">
                        <select class="form-select custom-width" name="reason" id="additionalOptions" onchange="toggleReasonTextArea()">
                            <option value="Personal development" selected>Personal Development</option>
                            <option value="Travel">Travel</option>
                            <option value="Family Matters">Family Matters</option>
                            <option value="">Others</option>
                        </select>
                    </fieldset>
                </div>
                <span id="additionalOptionsValidation" style="color: red;"></span>
            </div>
        </div>
    </div>

    <!-- Reason Text Area (Initially Hidden) -->
    <div class="row" id="reasonTextAreaRow" style="display: none;">
        <div class="col-12">
            <div class="form-group has-icon-left">
                <label for="reason">Reason</label>
                <textarea class="form-control" name="reason" id="reason" rows="4"></textarea>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
        </div>
    </div>

    <!-- Leave Status Messages -->
    <span style="color: green;"><?php echo $leaveSuccessMessage; ?></span>
    <span style="color: red;"><?php echo $leaveFailureMessage; ?></span>

    <script>
        function toggleReasonTextArea() {
            var additionalOptions = document.getElementById("additionalOptions");
            var reasonTextAreaRow = document.getElementById("reasonTextAreaRow");

            if (additionalOptions.value === "") {
                reasonTextAreaRow.style.display = "block";
            } else {
                reasonTextAreaRow.style.display = "none";
            }
        }

     
    function updateDateFields() {
        var noOfDays = document.getElementById('no-of-days').value;
        var toDateCol = document.getElementById('toDateCol');
        var fromDateLabel = document.getElementById('from-date-label');

        if (noOfDays > 1) {
            toDateCol.style.display = 'block';
            fromDateLabel.textContent = 'From Date';
        } else {
            toDateCol.style.display = 'none';
            fromDateLabel.textContent = 'Select Date';
        }
    }


        function validateFromDate() {
            var fromDate = document.getElementById('from-date').value;
            var fromDateValidation = document.getElementById('fromDateValidation');
            var today = new Date().toISOString().split('T')[0];
            if (fromDate < today) {
                fromDateValidation.textContent = 'From date cannot be in the past.';
            } else {
                fromDateValidation.textContent = '';
            }
        }

        function validateToDate() {
            var toDate = document.getElementById('to-date').value;
            var fromDate = document.getElementById('from-date').value;
            var toDateValidation = document.getElementById('toDateValidation');
            if (toDate < fromDate) {
                toDateValidation.textContent = 'To date cannot be before from date.';
            } else {
                var date1 = new Date(fromDate);
                var date2 = new Date(toDate);
                var difference = Math.abs(date2 - date1);
                var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24));
                document.getElementById('no-of-days').value = daysDifference;
                toDateValidation.textContent = '';
            }
        }

        function validateAssignmentDuty() {
            var assignmentDuty = document.getElementById('assignment-duty').value;
            var assignmentDutyValidation = document.getElementById('assignmentDutyValidation');
            if (assignmentDuty.trim() === '') {
                assignmentDutyValidation.textContent = 'Date of Resumption cannot be empty.';
            } else {
                assignmentDutyValidation.textContent = '';
            }
        }

    

        function validateForm() {
            updateDateFields();
            validateFromDate();
            validateToDate();
            validateAssignmentDuty();

            var noOfDaysValidation = document.getElementById('noOfDaysValidation').textContent;
            var fromDateValidation = document.getElementById('fromDateValidation').textContent;
            var toDateValidation = document.getElementById('toDateValidation').textContent;
            var assignmentDutyValidation = document.getElementById('assignmentDutyValidation').textContent;
            // var fileValidation = document.getElementById('fileValidation').textContent;

            if (noOfDaysValidation !== '' || fromDateValidation !== '' || toDateValidation !== '' || assignmentDutyValidation !== '') {
                return false;
            }

            return true;
        }
    </script>
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
    <!-- <script>
    document.getElementById('no-of-days').addEventListener('change', handleNumberOfDaysChange);

    function handleNumberOfDaysChange() {
        var numberOfDays = document.getElementById('no-of-days').value;
        var selectDayLabel = document.querySelector('label[for="select-day"]');
        var toDateRow = document.getElementById('toDateRow');

        if (numberOfDays > 1) {
            selectDayLabel.textContent = 'From Date';
            toDateRow.style.display = 'block';
        } else {
            selectDayLabel.textContent = 'Select Day';
            toDateRow.style.display = 'none';
        }
    }
</script> -->
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php
    }else{
        header("Location: login.php");
        exit();
    }
    ?>