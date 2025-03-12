<?php
    include 'conn.php';
    
    if(isset($_SESSION["empid"])){
    $post_id=$_SESSION["post_id"];
    if($post_id==4){
         $x=$_SESSION['name'];
         $empid=$_SESSION['empid'];
         $deptid=$_SESSION['deptid'];
         $sql="select sum(daydiff) as cc from tbl_approval where l_id = '1' and emp_id = $empid;";
         $res=$conn->query($sql);
         $row=$res->fetch_assoc();
         $casualcount = 15 - $row['cc'];
         $sql="select sum(daydiff) as cc from tbl_approval where l_id = '2' and emp_id = $empid;";
         $res=$conn->query($sql);
         $row=$res->fetch_assoc();
         $vacationcount = 45 - $row['cc'];
         $sql="select sum(daydiff) as cc from tbl_approval where l_id = '7' and emp_id = $empid;";
         $res=$conn->query($sql);
         $row=$res->fetch_assoc();
         $compcount = 0 + $row['cc'];
         $nql = "SELECT COUNT(*) as c FROM tbl_docs WHERE status != '0' AND emp_id = '$empid';";
         $res=$conn->query($nql);
         $row=$res->fetch_assoc();
         $not = $row['c'];
         if ($not == '0'){
            $_SESSION['not'] = '';
         }else{
            $_SESSION['not'] ='('. $not . ')';
         }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>UPLeave</title>
      <link rel="stylesheet" href="assets/css/bootstrap.css">
      <script defer src="assets/fontawesome/js/all.min.js"></script>
      <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
      <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
      <link rel="stylesheet" href="assets/css/app.css">
      <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
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
                     <li class="sidebar-item active ">
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
                           <div class="d-none d-md-block d-lg-inline-block"><?php echo $x."<br>".$empid?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <!-- <a class="dropdown-item" href="update.html"><i data-feather="user"></i> Account</a> -->
                           <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i> Settings</a>
                           <a class="dropdown-item" href="evacc.php"><i data-feather="user"></i> Account</a>

                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i> Logout</a>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
            <div class="main-content container-fluid">
               <div class="page-title">
                  <h3>Dashboard</h3>
               </div>
               <section class="section">
                  <div class="row mb-2">
                   <a href="leavehistory.php"> <div class="col-xl-4 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-plane text-success fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Leaves Taken</h4>
                      <?php
                      $sql="select count(*) as crq from tbl_approval where status ='1' and emp_id = '$empid';";
                      $cql=$conn->query($sql);
                      $rowc=$cql->fetch_assoc();
                      $cl=$rowc['crq'];
                      $sql="select count(req_id) as crq from tbl_leave where status ='0'and emp_id = '$empid';";
                      $cql=$conn->query($sql);
                      $rowc=$cql->fetch_assoc();
                      $pl=$rowc['crq'];
                      $sql="select count(req_id) as crq from tbl_leave where status ='2' and emp_id = '$empid';";
                      $cql=$conn->query($sql);
                      $rowc=$cql->fetch_assoc();
                      $dl=$rowc['crq'];
                      // $sql="select count(req_id) as crq from tbl_leave where status ='3' and emp_id = '$empid';";
                      // $cql=$conn->query($sql);
                      // $rowc=$cql->fetch_assoc();
                      // $ccl=$rowc['crq'];
                      ?>
                    <h2 class="h1 mb-0"><?php echo $cl;?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </a>
          </div>
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-info text-warning fa-3x me-4"></i>
                    </div>
                    <div>
                    <a href="leave_status.php">    <h4>Pending Requests</h4>
                    <h2 class="h1 mb-0"><?php echo $pl;?></h2>
                    </div>
                  </div></a>
                </div>
              </div> 
            </div>
          </div>      
          <div class="col-xl-4 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-trash text-danger fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Canceled Leaves</h4>
                    <h2 class="h1 mb-0"><?php echo $dl;?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><div class="col-xl-4 col-md-12 mb-4">
    <div class="card">
        <div class="card-body">
            <h4>Available Leaves in 2024</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Leave Type</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <td><b>Casual Leave</b></td>
                        <td><b><?php echo $casualcount; ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Vacation Leave</b></td>
                        <td><b><?php echo $vacationcount; ?></b></td>
                    </tr>
                  
                    <tr>
                      <td><b>Compensatory leaves</b></td>
                      <td><b><?php echo $compcount;
                      $_SESSION["casualcount"] = $casualcount;
                      $_SESSION["compcount"] = $compcount;
                      $_SESSION["vacationcount"] = $vacationcount; ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

                  </div>
               </section>
            </div>
         </div>
      </div>
      <script src="assets/js/feather-icons/feather.min.js"></script>
      <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
      <script src="assets/js/app.js"></script>
      <script src="assets/vendors/chartjs/Chart.min.js"></script>
      <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
      <script src="assets/js/pages/dashboard.js"></script>
      <script src="assets/js/main.js"></script>
   </body>
</html>
  <?php   
    }
    else
    {
        ?>
            <script>
                window.location.href="login.php";
            </script>
        <?php
    }
}else{
    ?>
<script>
                window.location.href="login.php";
            </script>
    <?php
}
   ?>