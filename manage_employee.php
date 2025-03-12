<?php
include 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$currentDate = date("Y-m-d");
// Load Composer's autoloader
require 'vendor/autoload.php';
if(isset($_SESSION['empid'])) {
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];

 if(isset($_POST['cancel'])){
        $ed=$_POST['empid'];
        $eql= "select empname,email from tbl_employee where emp_id = '$ed';" ;
        $rem=$conn->query($eql);
        $r=$rem->fetch_assoc();
        $name = $r['empname'];
        $email = $r['email'];

        // Display the div containing the form
        echo "<div id='disableFormContainer' style='display: block; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); z-index: 9999;'>";
        echo "<form method='post' action='#'>";
        echo $ed.' - '.$name;
        echo "<textarea name='reason' id='reason' required  class='form-control' rows='5' cols='50' placeholder='Add reason for disabling'></textarea><br>";
        echo "<input type='hidden' name='empid' value='$ed'>";
        echo "<input type='submit' name='confirm_disable' class='button button-decline' value='Confirm Disable'> &nbsp&nbsp&nbsp";
        echo "<input type='submit' name='can' class='button button-approve' value='cancel'>";
        echo "</form>";
        echo "</div>";
    }
    if(isset($_POST['confirm_disable'])){
        $ed=$_POST['empid'];
        $eql= "select empname,email from tbl_employee where emp_id = '$ed';" ;
        $rem=$conn->query($eql);
        $r=$rem->fetch_assoc();
        $name = $r['empname'];
        $email = $r['email'];
        $reason=$_POST['reason'];
        $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->SMTPDebug = 0; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth   = true; // Enable SMTP authentication
                    $mail->Username   = 'eapentkadamapuzha@gmail.com'; // SMTP username
                    $mail->Password   = 'nftl hxyt tcpe wrlu'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable explicit TLS encryption
                    $mail->Port       = 587; // Use 587 for STARTTLS, or 465 for implicit TLS (SMTPS)
                    $mail->isHTML(true);
                    // Recipients
                    $mail->setFrom('eapentkadamapuzha@gmail.com', 'UPLeave');
                    $mail->addAddress($email, 'Sample'); // Add a recipient

                    // Set email format to HTML
                    $mail->Subject = 'UPLeave Account Disabled'; 
                    $mail->Body = '
                        <html>
                        <body>
                            <h1>UPLeave Account has been Disabled</h1>
                            <p>Dear '.$name.',</p>
                            <p> UPLeave account for the Employee ID <strong>'.$ed.' associated with the email address <strong>' . $email . '</strong> has been disabled due to the reason : '.$reason.' with effect From '.$currentDate.'</p>
                            <p>If you have any questions or concerns, please contact our support team.</p>
                            <p>Thank you, <br> UPLeave</p>
                        </body>
                        </html>';
                     if ($mail->send()) {
                         $sql="update tbl_employee set status = 0 where emp_id = $ed";
                        $x= $conn->query($sql);
                        if ($x) {
                            ?>
                                <!DOCTYPE html>
                                <html lang="en">
                                <head>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
                                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
                                </head>
                                <body>
                                <script>
                                Swal.fire({
  text: "confirmation Email has been sent to <?php echo $name?>",
  timer:4000,
  showConfirmButton: false,
  icon: "success"
});
           </script> 
        </body>
        </html>
                            <?php
                        //echo "<script> alert('Employee added');</script>";
                    }
        
        // header("location:a.php");
    }} catch (Exception $e) {
                    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
                }}
if(isset($_POST['enable'])){
    $ed=$_POST['empid'];
    $sql="update tbl_employee set status = 1 where emp_id = $ed";
    $conn->query($sql);
    header("location:manage_employee.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disable Employee</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <style type="text/css">
        .notif:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    
    .button-approve {
        background-color: #4CAF50; /* Green */
        color: white;
    }
    
    .button-decline {
        background-color: #f44336; /* Red */
        color: white;
    }
    
    .button:hover {
        background-color: #555;
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
                            <a href="index.php" class='sidebar-link'>
                                <i class="fa fa-home text-success"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-building text-success"></i>
                                <span>Department</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_department.html">Add Department</a>
                                </li>
                                <li>
                                    <a href="manage_department.html">Manage Department</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-success"></i>
                                <span>Designation</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_designation.html">Add Designation</a>
                                </li>
                                <li>
                                    <a href="manage_designation.html">Manage Designation</a>
                                </li>
                            </ul>
                        </li> -->
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-users text-success"></i>
                                <span>Employees</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_employee.php">Add Employee</a>     
                                </li>
                                <li>
                                    <a href="manage_employee.php">Manage Employee</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-success"></i>
                                <span>Leave Type</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_leave_type.php">Add Leave Type</a>
                                </li>
                                <li>
                                    <a href="manage_leave_type.php">view Leave Type</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-success"></i>
                                <span>Leave Management</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="pending_leave.php">Pending Leaves</a>
                                </li>
                                <li>
                                    <a href="hodleavehistory.php">Leave Summary</a>
                                </li>
                                <!-- <li>
                                    <a href="approve_leave.html">Approve Leaves</a>
                                </li>
                                <li>
                                    <a href="not_approve_leave.html">Not Approve Leaves</a>
                                </li> -->
                            </ul>
                        </li>
                        <!-- <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-user text-success"></i>
                                <span>Users</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_user.html">Add User</a>
                                </li>
                                <li>
                                    <a href="manage_user.html">Manage Users</a>
                                </li>
                            </ul>
                        </li> -->
                        
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                
                            </a>
                           
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $x; ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="hvacc.php"><i data-feather="user"></i> Account</a>
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
                            <h3>Disable Employee</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Employee</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
              <section class="section">
                <div class="card">
                    <div class="card-body">
                        <table class='table' id="table1">
                            <thead>
                                <tr>
                                    <th>Emp ID</th>
                                    <th>Full Name</th>
                                    <th>Department</th>
                                    <th>Date Of Join</th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql="select * from tbl_employee where dept_id =$deptid and post_id = 4 ";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $eid = $row['emp_id'];
                                        $name=$row['empname'];
                                        $dept=$row['dept_id'];
                                        $doj=$row['doj'];
                                        $stat=$row['status'];
                                        $dql="select deptname from tbl_department where dept_id = $deptid ;";
                                        $res=$conn->query($dql);
                                        $rows=$res->fetch_assoc();
                                        $dname=$rows['deptname'];
                                        echo "<tr>";
                                        echo "<td>$eid</td>";
                                        echo "<td>$name</td>";
                                        echo "<td>$dname</td>";
                                        echo "<td>$doj</td>";
                                        echo "<td>";
                                        echo "<form method='POST' action='#'>";
                                        echo "<input type='hidden' name='empid' value='$eid'>";
                                        if($stat == '1'){
                                            // Show the form to disable employee
                                        echo "<center><input type='submit' name='cancel' value='Disable' class='button button-decline'></center>";
                                        } 
                                        if($stat=='0') {
                                            echo "<center><input type='submit' name='enable' value='Enable' class='button button-approve'></center>";
                                        }
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </section>
            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
<?php
}else{
    header("Location: login.php");
    exit();
}
?>