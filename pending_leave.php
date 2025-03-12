<?php
include 'conn.php';
if(isset($_SESSION['empid'])) {
$X=$_SESSION['name'];
$empid=$_SESSION['empid'];
$postid=$_SESSION['post_id'];
$deptid=$_SESSION['deptid'];
if(isset($_POST['decline'])){
    
    $rid=$_POST['req_id'];
    $tql="update tbl_leave set status = 2 where req_id = $rid;";
    $conn->query($tql);
    header("location:pending_leave.php");
}
if(isset($_POST['approve'])){
    $rid=$_POST['req_id'];
    $remark = $_POST['remark'];
    $sql="update tbl_leave set status =1 where req_id = $rid;";
    $conn->query($sql);
    $sql="SELECT * FROM tbl_leave WHERE req_id = $rid";
    $result=$conn->query($sql);
    $row = $result->fetch_assoc();
    $lid=$row['l_id'];
    $eid=$row['emp_id'];
    $reason = $row['reason'];
    $stdate=$row['st_date']; 
    $todate=$row['to_date'];
    $daybtw=$row['daydiff'];
    $apptime=$row['appliedtime'];
    $iql="insert into tbl_approval(emp_id,l_id,st_date,to_date,reason,status,daydiff,appliedtime,remark) values('$eid','$lid','$stdate','$todate','$reason',1,'$daybtw','$apptime','$remark');";
    $conn->query($iql);
    header("location:pending_leave.php");
}if(isset($_POST['recommend'])){
    $rid=$_POST['req_id'];
    $empname=$_POST['empname'];
    echo "<div id='disableFormContainer' style='display: block; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); z-index: 9999;'>";
    echo "<form method='post' action='#'>";
    echo "Employee Name - ".$empname;
    echo "<textarea name='remark' id='reason'   class='form-control' rows='5' cols='50' placeholder='Add Remark'></textarea><br>";
    echo "<input type='hidden' name='req_id' value='$rid'>";
    echo"<input type='submit' value='Recommend Request' name='recommends' class='btn btn-primary me-1 mb-1'> &nbsp &nbsp";
    echo"  <input type='submit' value='Decline' name='decline' class='button button-decline'> &nbsp &nbsp";
    echo "<input type='submit' name='can' class='button button-approve' value='cancel'>";
    echo "</form>";
    echo "</div>";
}if(isset($_POST['take1'])){
     $rid=$_POST['req_id'];
    $empname=$_POST['empname'];
    echo "<div id='disableFormContainer' style='display: block; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); z-index: 9999;'>";
    echo "<form method='post' action='#'>";
    echo "Employee Name - ".$empname;
    echo "<textarea name='remark' id='reason'   class='form-control' rows='5' cols='50' placeholder='Add Remark'></textarea><br>";
    echo "<input type='hidden' name='req_id' value='$rid'>";
    echo" <input type='submit' value='Approve' name='approve' class='button button-approve'> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type='submit' value='Decline' name='decline' class='button button-decline' >";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='can' class='btn btn-primary me-1 mb-1' value='cancel'>";
    echo "</form>";
    echo "</div>";
}
if(isset($_POST['recommends'])){
    $rid=$_POST['req_id'];
    $remark = $_POST['remark'];
    $sq="update tbl_leave set status = 4 where req_id = $rid;";
    $conn->query($sq);
    $sql="insert into tbl_hodrecommendation (req_id,status,comments) values('$rid','0','$remark');";
    $conn->query($sql);
    header("location:pending_leave.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <style>
          button {
        background : none;
        border : none; 
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 14px;
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
                        </li>
                        <li class="sidebar-item has-sub">
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
                        <li class="sidebar-item has-sub">
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
                                    <a href="manage_leave_type.php">view Leave Types</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item active has-sub">
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
                                
                            </ul>
                        </li>
                       
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
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $_SESSION['name'] ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="hvacc.php"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="hod_update_pass.php"><i data-feather="settings"></i> Settings</a>
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
                            <h3>Pending</h3>
                        </div>
                         <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'> 
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Pending</li>
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
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Reason</th>
                                        <th > Document</th>
                                        <th><center>Action</center></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                           <?php  
                                    $sql="SELECT * FROM tbl_leave WHERE status =0 and emp_id in (select emp_id from tbl_employee where dept_id = '$deptid');";
                                    $result=$conn->query($sql);
                                    if ($result){
                                        if ($result->num_rows > 0) {
                                            
                                            while ($row = $result->fetch_assoc()) {
                                            $eid=$row['emp_id'];
                                            $eql="select empname from tbl_employee where emp_id = $eid";
                                            $resu=$conn->query($eql);
                                            if($resu){
                                                $rows = $resu->fetch_assoc();
                                                $empname=$rows['empname'];
                                            }
                                            $reqid=$row['req_id'];
                                            $lid=$row['l_id'];
                                            $stdate=$row['st_date']; 
                                            $todate=$row['to_date'];
                                            $doc = $row['document'];
                                            // $status=$row['status']; 
                                            $reason=$row['reason'];
                                            $lql="select leavetype from tbl_leavetype where l_id = $lid";
                                            $res=$conn->query($lql);
                                            if($res){
                                                $rows = $res->fetch_assoc();
                                                $ltype=$rows['leavetype'];
                                            }
                                            echo"<tr>";
                                            echo"<td>$empname</td>";
                                            echo"<td>$ltype</td>";
                                            echo"<td>$stdate</td>";
                                            echo"<td>$todate</td>";
                                            echo"<td>$reason</td>";
                                            if($doc){
                                            
                                            echo "<td><a href='$doc' target='_blank'> <i class='fas fa-download download-icon'></i> </a></td>"; // Redirect to download_file.php after

                                            }else{
                                                echo "<td></td>";
                                            }
                                            echo"<td >
                                            <form action='#' method='post'>
                                            <input type='hidden' name='req_id' value='$reqid'>
                                            <input type='hidden' name='empname' value='$empname'>
                                            ";

                                        if($lid == 1 || $lid == 2 || $lid == 7){
                                        
                                        echo"<input type='submit' value='Take Action' name='take1' class='btn btn-primary me-1 mb-1'>";
                                        }else{
                                            echo"<input type='submit' value='Take Action' name='recommend' class='btn btn-primary me-1 mb-1'>";
                                        }
                                          echo "</form>
                                          </td>
                                            </tr>";
                                        }   
                                        }else{
                                               
                                            }
                                            }?>
                                      
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