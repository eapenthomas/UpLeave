<!DOCTYPE html>
<html lang="en">

<?php
include 'conn.php';
$x=$_SESSION['name'];
$conn = new mysqli('localhost', 'root', '', 'db_leave');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['sub'])) {
    $eid = $_POST['empid'];
    $name = $_POST['empname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $doj = $_POST['doj'];
    $did = $_POST['department'];
    $pass = md5($_POST['password']); 

    $check_query = "SELECT * FROM tbl_login WHERE emp_id = '$eid'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo "<script> alert('Employee ID not available');</script>";
    } else {
        $cql = "insert into tbl_login(emp_id,password) values('$eid','$pass')";
        $sql = "insert into tbl_employee(emp_id,empname,email,phone,doj,status,dept_id,post_id) values('$eid','$name','$email','$phone','$doj','1',$did,'4')";
        $x = $conn->query($cql);
        $y = $conn->query($sql);
        if ($x && $y) {
            echo "<script> alert('Employee added');</script>";
        } else {
            echo "<script> alert('Employee not added');</script>";
        }
    }
}
?>


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Employee</title>

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
                <div class="sidebar-header" style="height: 50px; margin-top: -25px">
                    <i class="fa fa-users text-success me-4"></i>
                    <span id="span01" style="font-size: smaller;">UPLeave</span>

                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <a href="index.php" class="sidebar-link">
                                <i class="fa fa-home text-success"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="fa fa-building text-success"></i>
                                <span>Department</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="add_department.html">Add Department</a>
                                </li>
                                <li>
                                    <a href="manage_department.html">Manage Department</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="fa fa-table text-success"></i>
                                <span>Designation</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="add_designation.html">Add Designation</a>
                                </li>
                                <li>
                                    <a href="manage_designation.html">Manage Designation</a>
                                </li>
                            </ul>
                        </li> -->
                        <li class="sidebar-item active has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="fa fa-users text-success"></i>
                                <span>Employees</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="add_employee.html">Add Employee</a>
                                </li>
                                <li>
                                    <a href="manage_employee.html">Manage Employee</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="fa fa-table text-success"></i>
                                <span>Leave Type</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="add_leave_type.html">Add Leave Type</a>
                                </li>
                                <li>
                                    <a href="manage_leave_type.html">Manage Leave Type</a>
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
                                    <a href="all_leave.html">All Leaves</a>
                                </li>
                                <li>
                                    <a href="pending_leave.html">Pending Leaves</a>
                                </li>
                                <li>
                                    <a href="approve_leave.html">Approve Leaves</a>
                                </li>
                                <li>
                                    <a href="not_approve_leave.html">Not Approve Leaves</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="fa fa-user text-success"></i>
                                <span>Users</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="add_user.html">Add User</a>
                                </li>
                                <li>
                                    <a href="manage_user.html">Manage Users</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="reports.html" class="sidebar-link">
                                <i class="fa fa-chart-bar text-success"></i>
                                <span>Reports</span>
                            </a>
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
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="bell"></i><span class="badge bg-info">2</span>
                                </div>
                            </a>
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
                                <?php echo $x ?>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
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
                            <h3>Add Employee</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Add Employee
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="post" action="#" >
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="employee-id">Employee ID</label>
                                                        <div class="position-relative">
                                                            <input type="number"  class="form-control" autocomplete="off"
                                                                placeholder="Employee ID" id="employee-id"
                                                                name="empid" />
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-id-badge"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="employee-name">Employee Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="Employee Name" id="employee-name"
                                                                name="empname" />
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="employee-email">Email</label>
                                                        <div class="position-relative">
                                                            <input type="email" class="form-control" placeholder="Email"
                                                                id="employee-email" name="email" />
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-envelope"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="employee-phone">Phone</label>
                                                        <div class="position-relative">
                                                            <input type="tel" class="form-control" placeholder="Phone"
                                                                id="employee-phone" name="phone" />
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="date-of-join">Date of Join</label>
                                                        <div class="position-relative">
                                                            <input type="date" class="form-control" id="date-of-join"
                                                                name="doj" />
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="department">Department</label>
                                                        <select class="form-select" id="department" name="department">
                                                            <option selected>Select Department</option>
                                                            <?php
                                                            $sql = "SELECT dept_id, deptname FROM tbl_department";
                                                            if (($result = $conn->query($sql)) == TRUE) {

                                                            } else {
                                                                echo "<script>alert('" . $conn->error . "')</script>";
                                                            }


                                                            if ($result) {
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<option value='" . $row["dept_id"] . "'>" . $row["deptname"] . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option disabled>No departments found</option>";
                                                                }
                                                            } else {
                                                                echo "<option disabled>Error fetching departments</option>";
                                                            }

                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div></div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="employee-password">Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control"
                                                                placeholder="Password" id="employee-password"
                                                                name="password" />
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="confirm-password">Confirm Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control"
                                                                placeholder="Confirm Password" id="confirm-password" />
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                  <button type="submit" class="btn btn-primary me-1 mb-1" name="sub">Submit</button>

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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.form');

        // Function to create error message element
        function createErrorMessage(message) {
            const errorMessage = document.createElement('div');
            errorMessage.textContent = message;
            errorMessage.classList.add('error-message');
            errorMessage.style.color = 'red';
            return errorMessage;
        }

        // Function to insert error message after input field
        function insertErrorMessage(inputElement, errorMessage) {
            const parent = inputElement.parentElement;
            parent.appendChild(errorMessage);
        }

        // Function to remove error message
        function removeErrorMessage(inputElement) {
            const parent = inputElement.parentElement;
            const errorMessage = parent.querySelector('.error-message');
            if (errorMessage) {
                parent.removeChild(errorMessage);
            }
        }

        // Function to validate email
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Function to validate name (cannot contain numbers or special characters)
        function validateName(name) {
            const nameRegex = /^[A-Za-z\s]+$/;
            return nameRegex.test(name);
        }

        // Function to validate date (should not accept previous dates)
        function validateDate(date) {
            const currentDate = new Date();
            const selectedDate = new Date(date);
            return selectedDate >= currentDate;
        }

        // Function to validate password (must match and be at least 8 characters long)
        function validatePassword(password, confirmPassword) {
            return password.length >= 8 && password === confirmPassword;
        }

        // Function to validate Employee ID (at least 5 digits)
        function validateEmployeeID(id) {
            const idRegex = /^\d{5,}$/;
            return idRegex.test(id);
        }

        // Function to validate Phone number (only digits)
        function validatePhone(phone) {
            const phoneRegex = /^\d+$/;
            return phoneRegex.test(phone);
        }

        // Attach event listeners for input fields
        const inputFields = form.querySelectorAll('input');
        inputFields.forEach(function (input) {
            input.addEventListener('blur', function () {
                const inputValue = input.value.trim();
                removeErrorMessage(input);
                switch (input.id) {
                    case 'employee-email':
                        if (!validateEmail(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please enter a valid email address.'));
                        }
                        break;
                    case 'employee-name':
                        if (!validateName(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Name cannot contain numbers or special characters.'));
                        }
                        break;
                    case 'date-of-join':
                        if (!validateDate(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please select a future date.'));
                        }
                        break;
                    case 'employee-password':
                        const confirmPassword = document.getElementById('confirm-password').value.trim();
                        if (!validatePassword(inputValue, confirmPassword)) {
                            insertErrorMessage(input, createErrorMessage('Passwords must match and be at least 8 characters long.'));
                        }
                        break;
                    case 'confirm-password':
                        const password = document.getElementById('employee-password').value.trim();
                        if (!validatePassword(password, inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Passwords must match and be at least 8 characters long.'));
                        }
                        break;
                    case 'employee-id':
                        if (!validateEmployeeID(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please enter a valid Employee ID with at least 5 digits.'));
                        }
                        break;
                    case 'employee-phone':
                        if (!validatePhone(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please enter a valid Phone number.'));
                        }
                        break;
                    default:
                        // For other input fields, do nothing
                        break;
                }
            });
        });

        // Prevent form submission if there are validation errors
        form.addEventListener('submit', function (event) {
            const inputs = form.querySelectorAll('input');
            let isValid = true;
            inputs.forEach(function (input) {
                const inputValue = input.value.trim();
                removeErrorMessage(input);
                switch (input.id) {
                    case 'employee-email':
                        if (!validateEmail(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please enter a valid email address.'));
                            isValid = false;
                        }
                        break;
                    case 'employee-name':
                        if (!validateName(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Name cannot contain numbers or special characters.'));
                            isValid = false;
                        }
                        break;
                    case 'date-of-join':
                        if (!validateDate(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please select a future date.'));
                            isValid = false;
                        }
                        break;
                    case 'employee-password':
                        const confirmPassword = document.getElementById('confirm-password').value.trim();
                        if (!validatePassword(inputValue, confirmPassword)) {
                            insertErrorMessage(input, createErrorMessage('Passwords must match and be at least 8 characters long.'));
                            isValid = false;
                        }
                        break;
                    case 'confirm-password':
                        const password = document.getElementById('employee-password').value.trim();
                        if (!validatePassword(password, inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Passwords must match and be at least 8 characters long.'));
                            isValid = false;
                        }
                        break;
                    case 'employee-id':
                        if (!validateEmployeeID(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please enter a valid Employee ID with at least 5 digits.'));
                            isValid = false;
                        }
                        break;
                    case 'employee-phone':
                        if (!validatePhone(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please enter a valid Phone number.'));
                            isValid = false;
                        }
                        break;
                    default:
                        break;
                }
            });

            if (!isValid) {
                event.preventDefault(); 
            }
        });
    });
</script>



    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>