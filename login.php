<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'db_leave');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_destroy();
session_start();
// Initialize error message variable
$errorMsg = '';

// Check if session is set, redirect accordingly
if(isset($_SESSION['empid'])) {

    $post_id = $_SESSION['post_id'];
    if ($post_id == 3) {
        header("Location: index.php");
        exit();
    } elseif ($post_id == 4) {
        header("Location: employee.php");
        exit();
    }
}

if (isset($_POST['submit1'])) {
    $empid = $_POST['empid'];
    //$pass = md5($_POST['password']);
    $pass = $_POST['password'];
    $chksp = "SELECT * FROM tbl_login WHERE emp_id ='$empid' AND password='$pass'";
    $result = $conn->query($chksp);
    $pass = md5($_POST['password']);
        $chksp1 = "SELECT * FROM tbl_login WHERE emp_id ='$empid' AND password='$pass'";
    $result2 = $conn->query($chksp1);
    if ($result || $result2) {
        if ($result->num_rows > 0|| $result2->num_rows > 0) {
            $chkad = "SELECT * FROM tbl_employee WHERE emp_id ='$empid' and status = 1;";
            $resultad = $conn->query($chkad);
            if ($resultad) {
                if ($resultad->num_rows > 0) {
                    $row = $resultad->fetch_assoc();
                    $post_id = $row["post_id"];
                    $_SESSION["empid"] = $empid;
                    $stat=$row["status"];
                    $_SESSION["name"]=$row["empname"];
                    $_SESSION["deptid"]=$row["dept_id"];
                    $_SESSION["post_id"]=$post_id;
                    if($post_id ==1){
                        // if($result->num_rows > 0){
                        //     header("Location: resetpass1.php");
                        // }else{
                        header("Location: principal.php");
                      exit();
                  //  }

                    }
                    if($post_id ==2){
                        //  if($result->num_rows > 0){
                        //     header("Location: resetpass1.php");
                        // }else{
                        header("Location: dean.php");
                        exit();
                  //  }

                    }
                    if ($post_id == 3) {
                        // if($result->num_rows > 0){
                        //     header("Location: resetpass1.php");
                        // }
                        // else{
                        header("Location: index.php");
                        exit();
                   // }
                    } elseif ($post_id == 4) {
                        // if($result->num_rows > 0){
                        //     header("Location: resetpass1.php");
                        // }else{
                        header("Location: employee.php");
                        exit();

                 //   }
                }else{
                    $errorMsg = 'No employee found with the provided Employee ID';
                    }
                } else {
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
  text: "Employee is currently disabled from the system",
});
                        </script>
                    </body>
                    </html>
                    
                    <?php
                }
            } else {
                $errorMsg = "Error retrieving employee details: " . $conn->error;
            }
        } else {
            ?>
            <!-- $errorMsg = 'Username or password incorrect'; -->
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
  text: "Invalid Credentials ! ",
});
                </script>
            </body>
            </html>
            <?php
        }
    } else {
        $errorMsg = "Error checking credentials: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/app.css" />
    <script type="text/javascript">
        window.location.hash="";
        window.location.hash="";
        window.onhashchange=function(){window.location.hash="";}
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);}
    </script>
    <style>
        body {
            background-color: #fff;
            /* background-image: url('calendar.jpg'); */
        }


        .error-message {
            color: red;
        }
        #auth {
 
    background-color: #2d545e;
                    background-image: url('images/i9.jpg');
                    background-size:cover; /* This will resize the image to cover the entire background area */

     background-size: 100% ; 
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card {
                    background-image: url('images/i8.jpg');
    border:none;
    margin-top : 90px;
}

.card-body {
    padding: 25px;
    
}

.text-center h1 {
    font-size: 24px;
    color: #3a8fde;
}

.text-center h5 {
    font-size: 17px;
    color: #5e22f5;
}

.form-group label {
    font-size: 13px;
    color: #333;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ccc;
    
}

.form-control:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.error-message {
    font-size: 14px;
}

    </style>
</head>

<body >
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h1>UPLeave</h1>
                                <h5>Employee Leave Management System</h5>
                            </div>
                            <form action="#" method="POST" onsubmit="return validateForm()">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Employee ID</label>
                                    <div class="position-relative">
                                        <input autocomplete="off" type="number"  class="form-control" id="empid" name="empid" oninput="limitLength(this, 5)"/>
                                        <div class="form-control-icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div id="empid-error" class="error-message"></div>
                                    </div>
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                        <a href="forgetpass.php" class="float-end">
                                          <strong> <small>Forgot password?</small></strong> 
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password" />
                                        <div class="form-control-icon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <div id="password-error" class="error-message"></div>
                                    </div>
                                </div>
                                <?php if ($errorMsg != ''): ?>
            <div class="error-message"><?php echo $errorMsg; ?></div>
            <?php endif; ?>

                                <div class="clearfix">
                                    <button name="submit1" type="submit" class="btn btn-primary float-end">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
         function limitLength(element, maxLength) {
    if (element.value.length > maxLength) {
      element.value = element.value.slice(0, maxLength);
    }
  }
        function validateForm() {
            var empid = document.getElementById('empid').value;
            var password = document.getElementById('password').value;
            var empidError = document.getElementById('empid-error');
            var passwordError = document.getElementById('password-error');
            var isValid = true;

            empidError.textContent = '';
            passwordError.textContent = '';

            if (empid.trim() === '') {
                empidError.textContent = 'Employee ID is required';
                isValid = false;
            }

            if (password.trim() === '') {
                passwordError.textContent = 'Password is required';
                isValid = false;
            }

            return isValid;
        }
    </script>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
