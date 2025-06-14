<?php
// Start or resume the session
session_start();

// Reset session variables as needed
$_SESSION = array(); // Reset all session variables

// Destroy the session
session_destroy();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'D:/Xampp/htdocs/u/vendor/autoload.php';

include("conn.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) {
        $empid = $_POST['email'];
        $randomOTP = mt_rand(100000, 999999);
        echo "<script>console.log('" . $randomOTP . "')</script>";
        
  $sql= "SELECT * FROM tbl_login WHERE emp_id='$empid'";
      $result=$conn->query($sql);
        
        if ($row = $result->fetch_assoc()) {
            $updateSql = "UPDATE tbl_login SET Gcode =$randomOTP  WHERE emp_id = '".$empid."' ";

            if ($conn->query($updateSql)==true) {
                $_SESSION['forgot_password_empid'] = $empid;
                $eql="select email from tbl_employee where emp_id = '".$empid."';";
                $res=$conn->query($eql);
                $row=$res->fetch_assoc();
                $email=$row['email'];
                $_SESSION['forgot_password_email'] = $email;

                // Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->SMTPDebug = 0; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth   = true; // Enable SMTP authentication
                    $mail->Username   = 'eapentkadamapuzha@gmail.com'; // SMTP username
                    $mail->Password   = 'nftl hxyt tcpe wrlu'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable explicit TLS encryption
                    $mail->Port       = 587; // Use 587 for STARTTLS, or 465 for implicit TLS (SMTPS)
                    $mail->isHTML(true);
                    // Recipients
                    $mail->setFrom('eapentkadamapuzha@gmail.com', 're-eco');
                    $mail->addAddress($email, 'Sample'); // Add a recipient

                    // Set email format to HTML
                    $mail->Subject = 'Password Reset OTP for Your Account';
                    $mail->Body = '
                        <html>
                        <body>
                            <h1>Password Reset OTP</h1>
                            <p>Dear User,</p>
                            <p>We have received a request to reset the password for your account associated with the email address <strong>' . $email . '</strong>. To proceed with the password reset, please use the following One-Time Password (OTP):</p>
                            <h2>Your OTP: <span style="color: #007bff;">' . $randomOTP . '</span></h2>
                            <p>Please enter this OTP on the password reset page to complete the process. If you did not initiate this request, please ignore this email. Ensure the security of your account by not sharing this OTP with anyone.</p>
                            <p>If you have any questions or concerns, please contact our support team.</p>
                            <p>Thank you, <br>[Your Company Name] Team</p>
                        </body>
                        </html>';

                    if ($mail->send()) {
                        header("Location: otp.php");
                        exit();
                    } else {
                        throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                    }
                } catch (Exception $e) {
                    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
                }
            } else {
                echo "Error updating OTP: " . $conn->error;
            }
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
                        text: "Employee ID not found!",
                    });
                </script>
            </body>
            </html>
            <?php
        }
    }
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Re-eco </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #444;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }

        .card h3 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-floating input.form-control {
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ced4da;
        }

        .form-floating label {
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="card">
            <h3 class="text-center">Enter Employee ID</h3>
            <form action="#" method="post">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="email" id="floatingInput">
                    <!-- <label for="floatingInput">Enter your email address</label> -->
                </div>

                <div class="error-message" id="errorMessage"></div>
<br>
                <button type="submit" name="submit" class="btn btn-primary">Send OTP</button>
            </form>
            <br>
            <a href="login.php" class="btn btn-outline-primary mt-3">&#8249; Back</a>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>

    </script>
</body>

</html>
