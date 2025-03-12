<?php
include 'conn.php';
if(isset($_SESSION['empid'])) {
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leave Status</title>

<link rel="stylesheet" href="assets/css/bootstrap.css">

<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

<script defer src="assets/fontawesome/js/all.min.js"></script>
<link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" href="assets/css/app.css">
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
                        <li class="sidebar-item  ">
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
                        <li class="sidebar-item active">
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
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">

                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $x."<br>".$empid ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="evacc.php"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i>
                                    Settings</a>
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
                            <h3>Manage Leave Status</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="employee.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">View Leave Status</li>
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
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    $sql="SELECT * FROM tbl_leave WHERE emp_id = $empid ;";
                                    $result=$conn->query($sql);
                                    if ($result){
                                         if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                            $lid=$row['l_id'];
                                            $stdate=$row['st_date']; 
                                            $todate=$row['to_date'];
                                            $status=$row['status']; 
                                            $reason=$row['reason'];
                                            $lql="select leavetype from tbl_leavetype where l_id = $lid";
                                            $res=$conn->query($lql);
                                            if($res){
                                                $rows = $res->fetch_assoc();
                                            echo " <tr>";
                                            echo "<td>".$rows['leavetype']."</td>";
                                            echo"<td>$stdate</td>";
                                            echo "<td>$todate</td>";
                                            echo"<td>$reason</td>";
                                            if($status == 0 || $status == 4 || $status == 5) {
                                                echo"<td><span class='badge bg-info'>Pending</span></td>";
                                            }elseif($status == 1){
                                            echo"<td><span class='badge bg-success'>Approved</span></td>";
                                            }elseif($status == 2){
                                                echo"<td><span class='badge bg-danger'>Declined</span></td>";
                                            }
                                            
                                            echo"</tr>";
                                            }
                                       
                                                                    }
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
    header('Location: login.php');
    exit();
}
?>