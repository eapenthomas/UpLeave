<?php
include 'conn.php';
if(!isset($_SESSION['empid'])){
    header("Location : login.php");
    exit();
}
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];
$sql="select e.* ,d.deptname from tbl_employee e,tbl_department d where e.emp_id = $empid and d.dept_id = $deptid";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        #p1{
            color : DArkgreen;
            font-size :18px;
            margin: 13px;        
            font-family: "Lucida Console", "Courier New", monospace;
        }
        table{
              border-collapse: separate;
        border-spacing: 55px 15px;
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
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $x?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- <a class="dropdown-item" href="update.html"><i data-feather="user"></i> Account</a> -->
                                <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i>
                                    Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>View Profile</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">view profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>


                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                       
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group has-icon-left">
                <div class="position-relative">
                    <center><h2><span>Profile</span></h2>
                    <table>
                        <tr>
                            <th><span id="p1"> Employee Name  </span></th>
                            <td><span id="p1"><?php echo $row['empname'] ?></span></td>
                        </tr>
                        <tr>
                            <th><span id="p1"> Employee ID </span></th>
                            <td><span id="p1"><?php echo $row['emp_id'] ?></span></td>
                        </tr>
                        <tr>
                            <th><span id="p1"> Department  </span></th>
                            <td><span id="p1"><?php echo $row['deptname'] ?></span></td>
                        </tr><tr>
                            <th><span id="p1"> Email ID  </span></th>
                            <td><span id="p1"><?php echo $row['email'] ?></span></td>
                        </tr><tr>
                            <th><span id="p1"> Phone Number  </span></th>
                            <td><span id="p1"><?php echo $row['phone'] ?></span></td>
                        </tr><tr>
                            <th><span id="p1"> Date Of Join  </span></th>
                            <td><span id="p1"><?php echo $row['doj'] ?></span></td>
                        </tr>
                        
                    </table>
                       

</center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>

        </div>
    </div>
  
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
