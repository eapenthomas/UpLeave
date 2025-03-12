<?php
include 'conn.php';
if(isset($_SESSION['empid'])) {
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];

if(isset($_POST['submit'])){
$oldp =md5($_POST['oldp']);
$newp = md5($_POST['newp']);

$sql="select * from tbl_login where emp_id = $empid;";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
$ep = $row['password'];
if($oldp != $ep){
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
  icon: "error",
  title: "Oops...",
  text: "Incorrect Old Password!",
    showConfirmButton: false,
        timer:1800
});
    </script>
</body>
</html>
<?php
}else{
$upd= "update tbl_login set password = '$newp' where emp_id = $empid";
$conn->query($upd);
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
  text: "Password Updated successfully !",
  icon: "success",
  showConfirmButton: false,
        timer:2000
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
    <title>Update Profile</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

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
                        <li class="sidebar-item active ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="fa fa-home text-success"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
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
                                    <a href="manage_leave_type.php">Manage Leave Type</a>
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
                                <!-- <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i>
                                    Settings</a> -->
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
                            <h3>Update Password</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Password</li>
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
                                       <form class="form" method="post"  action="#">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group has-icon-left">
                <label for="old-password">Old Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control" name="oldp" placeholder="Old Password" id="old-password" required>
                    <div class="form-control-icon">
                        <i class="fa fa-key"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group has-icon-left">
                <label for="new-password">New Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control" name="newp" placeholder="New Password" id="new-password" oninput="validateForm()" required>
                    <div class="form-control-icon">
                        <i class="fa fa-key"></i>
                    </div>
                </div>
                <div id="password-criteria-error" style="display: none; color: red;">Password must be at least 6 characters long and contain a special character, a number, an uppercase letter, and a lowercase letter</div>

            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group has-icon-left">
                <label for="confirm-password">Confirm Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirm-password" oninput="validateForm()" required>
                    <div class="form-control-icon">
                        <i class="fa fa-key"></i>
                    </div>
                </div>
                <div id="password-match-error" style="display: none; color: red;">Passwords do not match</div>

            </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
        </div>
    </div>
</form>


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
    <script>
   function validateForm() {
    var newPassword = document.getElementById('new-password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    // Check if new password meets the criteria
    var passwordLength = newPassword.length >= 6;
    var hasSpecialCharacter = /[!@#$%^&*(),.?":{}|<>]/.test(newPassword);
    var hasNumber = /\d/.test(newPassword);
    var hasUpperCase = /[A-Z]/.test(newPassword);
    var hasLowerCase = /[a-z]/.test(newPassword);

    // Display password criteria error if criteria not met
    if (!(passwordLength && hasSpecialCharacter && hasNumber && hasUpperCase && hasLowerCase)) {
        document.getElementById('password-criteria-error').style.display = 'block';
    } else {
        document.getElementById('password-criteria-error').style.display = 'none';
    }

    // Check if new password and confirm password match
    if (newPassword !== confirmPassword) {
        // Display password match error only when confirm password input is clicked
        document.getElementById('confirm-password').addEventListener('click', function() {
            document.getElementById('password-match-error').style.display = 'block';
        });
        return false; // Prevent form submission
    } else {
        document.getElementById('password-match-error').style.display = 'none';
    }

    // If all validations pass, allow form submission
    return true;
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
     header('Location: login.php');
    exit();
}