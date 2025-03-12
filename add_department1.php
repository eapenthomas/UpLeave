<?php
include 'conn.php';
$x=$_SESSION['name'];
if(!isset($_SESSION['empid'])){
  header("Location: logout.php");
  exit();
}
if(isset($_POST['add'])){
$dept = $_POST['dept'];
$sql= "INSERT INTO tbl_department (deptname) values('$dept')";
$conn->query($sql);
echo "department added";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Department</title>

  <link rel="stylesheet" href="assets/css/bootstrap.css" />

  <script defer src="assets/fontawesome/js/all.min.js"></script>
  <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/css/app.css" />
  <style type="text/css">
    .notif:hover {
      background-color: rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header" style="height: 50px; margin-top: -30px">
          <i class="fa fa-users text-success me-4"></i>
          <span id="span01" style="font-size: smaller;">UPLeave</span>
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-item">
              <a href="principal.php" class="sidebar-link">
                <i class="fa fa-home text-success"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item active has-sub">
              <a href="#" class="sidebar-link">
                <i class="fa fa-building text-success"></i>
                <span>Department</span>
              </a>
              <ul class="submenu">
                <li>
                  <a href="add_department1.html">Add Department</a>
                </li>
               
              </ul>
            </li>
            <li class="sidebar-item has-sub">
              <a href="#" class="sidebar-link">
                <i class="fa fa-table text-success"></i>
                <span>Leave Management</span>
              </a>
              <ul class="submenu">
                <li>
                  <a href="pall_leave.php">All Leaves</a>
                </li>
                <li>
                  <a href="apending_leave.php">Pending Leaves</a>
                </li>
                
              </ul>
            </li>

          
          </ul>
        </div>
        <button class="sidebar-toggler btn x">
          <i data-feather="x"></i>
        </button>
      </div>
    </div>
    <div id="main">
      <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
        <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown nav-icon">
              <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                
              </a>
              
            </li>
            <li class="dropdown">
              <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="avatar me-1">
                  <img src="assets/images/admin.png" alt="" srcset="" />
                </div>
                <div class="d-none d-md-block d-lg-inline-block">
                <?php echo $x; ?>                </div>
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
          <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>Add Department</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="Principal.php" class="text-success">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Add Department
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
          <div class="row match-height">
            <div class="col-md-8 col-12">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <form class="form form-vertical" method = "post" action="#">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group has-icon-left">
                              <label for="email-id-icon">Department Name</label>
                              <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Input Department Name"
                                  id="email-id-icon" />
                                <div class="form-control-icon">
                                  <i class="fa fa-table"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group has-icon-left">
                              <label for="first-name-icon">Department Short Name</label>
                              <div class="position-relative">
                                <input type="text" class="form-control" name = 'dept' placeholder="Input Department"
                                  id="first-name-icon" />
                                <div class="form-control-icon">
                                  <i class="fa fa-table"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                          

                          <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1" name ="add">
                              Submit
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Basic Vertical form layout section end -->
      </div>
    </div>
  </div>
  <script src="assets/js/feather-icons/feather.min.js"></script>
  <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="assets/js/app.js"></script>

  <script src="assets/js/main.js"></script>
</body>

</html>