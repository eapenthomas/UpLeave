<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include 'conn.php';
    if(isset($_SESSION["empid"])){

$x=$_SESSION['name'];
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
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%^&*";
$pass = "";
for ($i = 0; $i < 6; $i++) {
    $n = rand(0, strlen($alphabet)-1);
    $pass .= $alphabet[$n];
}

    $check_query = "SELECT * FROM tbl_login WHERE emp_id = '$eid'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
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
  text: "Employee Creation Failed",
  icon: "error",
  timer:2500,
  showConfirmButton: false
});
           </script> 
        </body>
        </html>
        <?php
       // echo "<script> alert('Employee ID not available');</script>";
    } else {
         $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->SMTPDebug = 0; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth   = true; // Enable SMTP authentication
                    $mail->Username   = 'abyjoy2@gmail.com'; // SMTP username
                    $mail->Password   = 'olgb oieg zhso xidy'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable explicit TLS encryption
                    $mail->Port       = 587; // Use 587 for STARTTLS, or 465 for implicit TLS (SMTPS)
                    $mail->isHTML(true);
                    // Recipients
                    $mail->setFrom('reeco.recycle@gmail.com', 'UPLeave');
                    $mail->addAddress($email, 'Sample'); // Add a recipient

                    // Set email format to HTML
                    $mail->Subject = 'UPLeave Account created successfully'; 
                    $mail->Body = '
                        <html>
                        <body>
                            <h1>UPLeave Temporary Account Password</h1>
                            <p>Dear User,</p>
                            <p>We have created a UPLeave account for the Employee ID <strong>'.$eid.' associated with the email address <strong>' . $email . '</strong>. To proceed with the account creation process, please use the following Temporary Password</p>
                            <h2>Your Temporary account Password : <span style="color: #007bff;">' . $pass . '</span></h2>
                            <p>Please enter this Password on Your next login  to complete the process. Ensure the security of your account by not sharing this OTP with anyone.</p>
                            <p>If you have any questions or concerns, please contact our support team.</p>
                            <p>Thank you, <br> UPLeave</p>
                        </body>
                        </html>';

                    if ($mail->send()) {
                        $cql = "insert into tbl_login(emp_id,password) values('$eid','$pass')";
                        $sql = "insert into tbl_employee(emp_id,empname,email,phone,doj,status,dept_id,post_id) values('$eid','$name','$email','$phone','$doj','1',$did,'4')";
                        $x = $conn->query($cql);
                        $y = $conn->query($sql);
                        if ($x && $y) {
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
  text: "confirmation Email with a temporary password has been sent to <?php echo $name?>",
  timer:4000,
  showConfirmButton: false,
  icon: "success"
});
           </script> 
        </body>
        </html>
                            <?php
                        //echo "<script> alert('Employee added');</script>";
                    } else {
                        echo "<script> alert('Employee not added');</script>";
                    }
                    } else {
                        throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                    }
                } catch (Exception $e) {
                    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
                }
            }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
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
                        
                        <li class="sidebar-item active has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="fa fa-users text-success"></i>
                                <span>Employees</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="add_employee.php">Add Employee</a>
                                </li>
                                <li>
                                    <a href="manage_employee.php">Manage Employee</a>
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
                                    <a href="add_leave_type.php">Add Leave Type</a>
                                </li>
                                <li>
                                    <a href="manage_leave_type.php">View Leave Type</a>
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
                                    <a href="hodleavehistory.php">Leave Summary</a>
                                </li>
                                <li>
                                    <a href="pending_leave.php">Pending Leave Requests</a>
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
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                               
                            </a>
                           
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
                            <h3>Add Employee</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php" class="text-success">Dashboard</a>
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
                                                                name="empid" oninput="limitLength(this, 5)"/>
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
                                                                name="empname" oninput="validateInput(this)"/>
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
                                                                id="employee-email" name="email" oninput="validateEmail(this)"/>
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
                                                           <input type="number" class="form-control" placeholder="Phone" id="employee-phone" name="phone" maxlength="10" oninput="validatePhoneNumber(this)">

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
                                                                name="doj" min=""/>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="department">Department</label>
                                                        <select class="form-select" id="department" name="department" >
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
           function limitLength(element, maxLength) {
    if (element.value.length > maxLength) {
      element.value = element.value.slice(0, maxLength);
    }
  }
    var today = new Date().toISOString().split('T')[0];
  document.getElementById("date-of-join").setAttribute("min", today);
    function validateInput(inputField) {
    // Replace any non-letter characters with an empty string
    inputField.value = inputField.value.replace(/[^A-Za-z]/g, '');
  }


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
        function validateInput(inputField) {
    // Replace any non-letter characters with an empty string
    inputField.value = inputField.value.replace(/[^A-Za-z]/g, '');
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
                 const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    const minLengthBeforeAt = 3; // Minimum characters before '@'
    const minLengthAfterAt = 5;  // Minimum characters after '@' before '.'

    const parts = email.split('@');
    if (parts.length !== 2) return false; // Email should contain only one '@'

    const localPart = parts[0];
    const domainPart = parts[1];

    // Check minimum length before '@'
    if (localPart.length < minLengthBeforeAt) return false;

    // Check minimum length after '@' before '.'
    const domainParts = domainPart.split('.');
    if (domainParts.length !== 2 || domainParts[0].length < minLengthAfterAt) return false;

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
       

        // Function to validate Employee ID (at least 5 digits)
        function validateEmployeeID(id) {
            const idRegex = /^\d{5,}$/;
            return idRegex.test(id);
        }
function validatePhone(phone) {
    // Regular expression for exactly 10 digits
    const phoneRegex = /^\d{10}$/;
    // Regular expression to check for only digits
    const validPhoneRegex = /^\d+$/;

    // Check if the phone number matches the criteria and is greater than or equal to 6000000000
    if (phoneRegex.test(phone) && validPhoneRegex.test(phone) && parseInt(phone) >= 6000000000) {
        // Check if any digit repeats more than 5 times
        for (let i = 0; i < 10; i++) {
            const digit = i.toString();
            const digitCount = (phone.match(new RegExp(digit, "g")) || []).length;
            if (digitCount > 5) {
                console.log("A digit should not repeat more than 5 times in the phone number.");
                return false;
            }
        }
        return true;
    } else {
        console.log("Please enter a valid phone number with exactly 10 digits and greater than or equal to 6000000000.");
        return false;
    }
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
                    
                    case 'employee-id':
                        if (!validateEmployeeID(inputValue)) {
                            insertErrorMessage(input, createErrorMessage('Please enter a valid Employee ID with  5 digits.'));
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
<?php
    }else{
        header("Location:login.php");
        exit();
    }    ?>