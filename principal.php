<?php
include 'conn.php';
if(!isset($_SESSION['empid'])){
    header("Location: logout.php");
    exit();
}if($_SESSION['post_id']!= 1){
   header("Location: logout.php");
    exit();
}
 $x=$_SESSION['name'];
         $empid=$_SESSION['empid'];
         $deptid=$_SESSION['deptid'];
                      $sql="select count(*) as crq from tbl_approval where status ='1' ";
                      $cql=$conn->query($sql);
                      $rowc=$cql->fetch_assoc();
                      $cl=$rowc['crq'];
                      $sql="select count(*) as crq from tbl_deanrecommendation where status ='0'";
                      $cql=$conn->query($sql);
                      $rowc=$cql->fetch_assoc();
                      $pl=$rowc['crq'];
                      $sql="select count(req_id) as crq from tbl_leave where status ='2';";
                      $cql=$conn->query($sql);
                      $rowc=$cql->fetch_assoc();
                      $dl=$rowc['crq'];
                      $sql="select count(*) as crq from tbl_employee where post_id = '4';";
                      $cql=$conn->query($sql);
                      $rowc=$cql->fetch_assoc();
                      $empc =$rowc['crq'];
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Employee Leave Management System</title>
      <link rel="stylesheet" href="assets/css/bootstrap.css">
      <script defer src="assets/fontawesome/js/all.min.js"></script>
      <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
      <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
      <link rel="stylesheet" href="assets/css/app.css">
      <style type="text/css">
        .notif:hover{
          background-color: rgba(0,0,0,0.1);
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
                     <li class="sidebar-item active ">
                        <a href="principal.php" class='sidebar-link'>
                        <i class="fa fa-home text-success"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     
                     <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-users text-success"></i>
                        <span>Department</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="add_department1.php">Add Department</a>
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
                              <a href="pall_leave.php">Leave Summary</a>
                           </li>
                           <li>
                              <a href="apending_leave.php">Pending Leave Requests</a>
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
                           <div class="d-none d-md-block d-lg-inline-block"><?php echo $x; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="pvacc.php"><i data-feather="user"></i> Account</a>
                           <a class="dropdown-item" href="p_update_pass.php"><i data-feather="settings"></i> Settings</a>
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
                               <div class="col-xl-4 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-users text-warning fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Employees</h4>
                    <h2 class="h1 mb-0"><?php echo $empc ?></h2>
                    </div>
                  </div>
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
                      <i class="fa fa-plane text-success fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Approved Leaves</h4>
                    <h2 class="h1 mb-0"><?php echo $cl; ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          <div class="col-xl-4 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-check text-info fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Pending Leaves</h4>
                    <h2 class="h1 mb-0"><?php echo $pl ?></h2>
                    </div>
                  </div>
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
                      <h4>Canceled Requests</h4>
                    <h2 class="h1 mb-0"><?php echo $dl; ?></h2>
                    </div>
                  </div>
                </div>
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