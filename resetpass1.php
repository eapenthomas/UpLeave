<?php
include("conn.php");
$empid=$_SESSION['empid'];
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    echo "<script type='text/javascript'>console.log('1')</script>";

    if (isset($_POST['confirmpassword'])) {
        echo "<script type='text/javascript'>console.log('2')</script>";

        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($newpassword == $confirmpassword) {
            echo "<script type='text/javascript'>console.log('3')</script>";

            $selectUserIdQuery = "SELECT * FROM tbl_login WHERE emp_id ='$empid'";
            $resultUserId = $conn->query($selectUserIdQuery);


            if ($resultUserId && $resultUserId->num_rows > 0) {
                
                $newpassword = md5($newpassword);
                $updateLoginQuery = "UPDATE tbl_login SET password = '$newpassword' WHERE emp_id = '$empid'";
                $resultUpdateLogin = $conn->query($updateLoginQuery);

                if ($resultUpdateLogin) {
                    ?>
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Document</title>
                    </head>
                    <body>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script> Swal.fire({
  position: "top-end",
  icon: "Password Changed",
  showConfirmButton: false,
  timer: 1500
});.then(() => {
                            window.location.href = 'login.php';
                        });</script>
                    </body>
                    </html>
                    <?php
                   
                } else {
                    
                        ?>
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Document</title>
                        </head>
                        <body>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Fail to update password",
                                });.then(() => {
                            window.location.href = 'login.php';
                        });
                            </script>
                        </body>
                        </html>
                        <?php
                    
                }

                $_SESSION = array();
                session_destroy();
?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Password Changed Successfully</title>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                </head>

                <body>
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Password Changed Successfully",
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    </script>
                </body>

                </html>
            <?php

            } else {
                echo "<script type='text/javascript'>console.log('5')</script>";
            ?>

                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                </head>

                <body>
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong!",
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            window.location.href = 'logout.php';
                        });
                    </script>
                </body>

                </html>
<?php
                $_SESSION['error'] = "Something went wrong";
            }
        } else {
            $_SESSION['error'] = "Passwords do not match";
            header("Location: logout.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .container-fluid {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }

        .form-heading {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 16px;
            color: #333333;
            margin-bottom: 10px;
            display: block;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
        }

        .error-message {
            font-size: 14px;
            color: #dc3545;
            margin-top: 5px;
        }

        .btn-submit {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 15px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Forgot password section starts here -->
        <div class="form-container">
            <h3 class="form-heading">Reset Password</h3>
            <form action="#" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="newPassword" class="form-label">Enter new password</label>
                    <input type="password" class="form-control form-input" name="newpassword" id="newPassword" placeholder="Enter new password" oninput="validatePassword()">
                    <div id="password-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="form-label">Confirm new password</label>
                    <input type="password" class="form-control form-input" name="confirmpassword" id="confirmPassword" placeholder="Confirm new password" oninput="validateConfirmPassword()">
                    <div id="confirm-password-error" class="error-message"></div>
                </div>

                <div id="errorMessage" class="text-center"></div>

                <button type="submit" name="submit" class="btn btn-success w-100 mb-4 btn-submit">Change Password</button>
            </form>
        </div>
        <!-- Forgot password section ends here -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            function showError(input, message, errorId) {
                document.getElementById(errorId).textContent = message;
            }

            function showSuccess(errorId) {
                document.getElementById(errorId).textContent = '';
            }

            function validateField(input, regex, message, errorId) {
                const value = input.value.trim();
                const isValid = regex.test(value);
                isValid ? showSuccess(errorId) : showError(input, message, errorId);
                return isValid;
            }

            function validatePassword() {
                const input = document.getElementById('newPassword');
                const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
                const message = 'Password must be at least 6 characters long with an uppercase letter, a digit, and a special character.';
                return validateField(input, regex, message, 'password-error');
            }

            function validateConfirmPassword() {
                const passwordInput = document.getElementById('newPassword');
                const confirmPasswordInput = document.getElementById('confirmPassword');
                const message = 'Passwords do not match.';
                return validateField(confirmPasswordInput, new RegExp(`^${passwordInput.value}$`), message, 'confirm-password-error');
            }

            function validateForm() {
                return validatePassword() && validateConfirmPassword();
            }

            form.addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });

            form.addEventListener('input', function(event) {
                const inputElement = event.target;
                switch (inputElement.id) {
                    case 'newPassword':
                        validatePassword();
                        break;
                    case 'confirmPassword':
                        validateConfirmPassword();
                        break;
                    default:
                        break;
                }
            });
        });
    </script>
</body>

</html>
