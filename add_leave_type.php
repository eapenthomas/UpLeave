<?php
include 'conn.php';
if (isset($_SESSION['empid'])){
    
    $x=$_SESSION['name'];
    $empid=$_SESSION['empid'];
    $deptid=$_SESSION['deptid'];
if(isset($_POST['submit'])){
    $lname = $_POST['lname'];
    $desc = $_POST['description'];
    $noofdays = $_POST['noofdays'];
    $sql = "insert into tbl_leavetype(leavetype,description,totalleave) values('$lname','$desc','$noofdays')";
    if($conn->query($sql)===true){
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
  text: "New Leave Type Added !",
  icon: "success",
  timer:2500,
  showConfirmButton: false
});
            </script>
        </body>
        </html>
        <?php
    }else{
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
  text: "Failed to Add New Leave Type",
  icon: "error"
});
            </script>
        </body>
        </html>
        <?php
    }
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Leave Type</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <style type="text/css">
        .notif:hover {
            background-color: rgba(0, 0, 0, 0.1);
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
                        <!-- <li class="sidebar-item  has-sub">
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
                        <li class="sidebar-item  has-sub">
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
                        <li class="sidebar-item  has-sub">
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
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-success"></i>
                                <span>Leave Type</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_leave_type.php">Add Leave Type</a>
                                </li>
                                <li>
                                    <a href="manage_leave_type.php">View Leave Type</a>
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
                                    <a href="hodleavehistory.php">Leave Summary</a>
                                </li>
                                <li>
                                    <a href="pending_leave.php">Pending Leaves</a>
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
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $x;?></div>
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
                            <h3>Add Leave Type</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Leave Type</li>
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
                                        <form class="form form-vertical" method="post" action="#">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="leave-name">Leave Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Input leave type" name="lname" id="leave-name"
                                                                    oninput="validateField(this)" required>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-table"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="description">Description</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Input Description" id="description"
                                                                    oninput="validateField(this)" name="description" required>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-table"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="days-allowed">Number of days Allowed</label>
                                                            <div class="position-relative">
                                                                <input type="number" class="form-control"
                                                                    placeholder="Input days allowed" id="days-allowed"
                                                                    oninput="validateField(this)" name="noofdays" required>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-table"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" name ="submit"
                                                            class="btn btn-primary me-1 mb-1">Submit</button>
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
<script>
   function validateField(field) {
        var value = field.value.trim();

        // Check if the field is empty
        if (value === '') {
            field.setCustomValidity('This field is required');
        } else {
            field.setCustomValidity('');
        }

        // Check if the field is 'Number of days Allowed' and value is less than 6
        if (field.id === 'days-allowed' && parseInt(value) <= 5) {
            field.setCustomValidity('Number of days allowed should be greater than 5');
        } else if ((field.id === 'leave-name' || field.id === 'description') && /\d/.test(value)) {
            field.setCustomValidity('This field should not contain numbers');
        } else {
            field.setCustomValidity('');
        }
    }
</script>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
<?php
}else{
    header("Location:login.php");
    exit();
}
?>