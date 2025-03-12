<?php
include("conn.php");    

if (!isset($_SESSION['forgot_password_empid'])) {
    header("Location: forgetpass.php");
}

$email = $_SESSION['forgot_password_email'];
$empid = $_SESSION['forgot_password_empid'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';





if (isset($_POST['submit'])) {

    if (isset($_POST['otp'])) {
        $otp = $_POST['otp'];
        $checkSql = "SELECT * FROM tbl_login WHERE emp_id = '$empid'";
        $result = $conn->query($checkSql);

        // Check if the query was successful
        if ($result) {
            // Fetch the data from the result set
            while ($row = $result->fetch_assoc()) {
                // Output the email to the console
                // Note: The correct syntax is console.log, not console . log
                $otpCheck = $row['Gcode'];

                echo "<script>console.log('" . $row['Gcode'] . "');</script>";
            }
        } else {
            // Handle the case where the query was not successful
            echo "<script>alert('Query failed: " . $conn->error . "');</script>";
        }
        if ($otpCheck == $otp) {
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

</body>
<script>
    Swal.fire({
        icon: "success",
        title: "OTP verified",
        timer: 2000,
        showConfirmButton: false,
    }).then(() => {
        window.location.href = 'resetpass.php';
    });
</script>

</html>

<?php
        }
        else{
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

</body>
<script>
    Swal.fire({
        icon: "error",
        title: "OTP invalid",
        timer: 2000,
        showConfirmButton: false,
    });
</script>

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
    <title>UPLeave - OTP Verification</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Custom CSS for OTP Verification Page */

body {
    background-color: #f8f9fa; /* Light gray background */
    font-family: Arial, sans-serif; /* Set a default font family */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container-fluid {
    margin-top: 50px; /* Add some top margin */
}

.card {
    background-color: #ffffff; /* White card background */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Soft shadow */
    padding: 30px; /* Add padding inside the card */
    text-align: center; /* Center align text */
    width: 400px; /* Limit card width */
}

.text-primary {
    color: #007bff; /* Primary text color */
    font-size: 28px; /* Increase heading size */
}

h5 {
    font-size: 24px; /* Increase heading size */
}

.btn-primary {
    background-color: #007bff; /* Primary button color */
    border-color: #007bff; /* Border color */
    padding: 12px 24px; /* Increase button padding */
    font-size: 18px; /* Increase button font size */
    border-radius: 8px; /* Rounded corners */
    transition: background-color 0.3s ease, border-color 0.3s ease; /* Smooth transition */
}

.btn-primary:hover {
    background-color: #0056b3; /* Darker primary color on hover */
    border-color: #0056b3; /* Darker border color on hover */
}

.btn-outline-primary {
    color: #007bff; /* Primary button text color */
    border-color: #007bff; /* Border color */
    padding: 12px 24px; /* Increase button padding */
    font-size: 18px; /* Increase button font size */
    border-radius: 8px; /* Rounded corners */
    transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
}

.btn-outline-primary:hover {
    background-color: #ffffff; /* Change background color on hover */
    color: #0056b3; /* Change text color on hover */
}

.form-control {
    border: 2px solid #ced4da; /* Default form control border */
    font-size: 18px; /* Increase input font size */
    height: 50px; /* Increase input height */
    border-radius: 8px; /* Rounded corners */
    transition: border-color 0.3s ease; /* Smooth transition */
}
a{
    text-decoration: none;
}
.form-control:focus {
    border-color: #007bff; /* Focus border color */
    outline: none; /* Remove outline */
}

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <a href="login.php" class="text-decoration-none">
                    <h3 class="text-primary">UPLeave</h3>
                </a>
                <h5>OTP Verification</h5>
            </div>
            <form action="#" method="post" onsubmit="return validateForm()">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="otp" id="floatingInput" placeholder="OTP"
                        oninput="validateUsername()" required>
                    <label for="floatingInput">Enter your OTP</label>
                </div><br>
                <div id="countdown"></div> <!-- Countdown timer -->
                <div id="errorMessage"></div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check"><br>
                        <label class="form-check-label" for="exampleCheck1" style="color: #6c757d;">
                            Enter the OTP received in your registered Email Address!
                        </label>
                    </div><br>
                </div>
                <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Submit OTP</button>
            </form><br>
            <a href="logout.php" class="btn btn-outline-primary">&#8249; Back</a>
        </div>
    </div>

    <script>
        // Set the countdown duration in seconds
        const countdownDuration = 300; // 5 minutes in seconds

        // Initialize the countdown
        let countdown = countdownDuration;

        // Function to update the countdown timer
        function updateCountdown() {
            const minutes = Math.floor(countdown / 60);
            const seconds = countdown % 60;
            document.getElementById('countdown').innerHTML = `Time remaining: ${minutes}m ${seconds}s`;

            if (countdown === 0) {
                // Redirect to forgotpassword.php when countdown reaches zero
                window.location.href = "./forgotpassword.php";
                // Reset session variables here if needed
                sessionStorage.clear(); // Clear all session storage
            } else {
                countdown--;
                setTimeout(updateCountdown, 1000); // Update every second
            }
        }

        // Start the countdown when the page loads
        updateCountdown();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('floatingInput').addEventListener('input', function () {
                validateEmail();
            });
        });

        function validateEmail() {
            var otpInput = document.getElementById('floatingInput').value.trim();
            var errorMessageDiv = document.getElementById('errorMessage');

            // Use a regex to match exactly 6 digits
            var otpRegex = /^\d{6}$/;

            if (!otpRegex.test(otpInput)) {
                errorMessageDiv.textContent = 'Enter valid 6 digit OTP';
            } else {
                errorMessageDiv.textContent = '';
            }
        }

        // Add an event listener to the input field
        document.getElementById('floatingInput').addEventListener('input', function () {
            var input = this.value.trim();
            var errorMessageDiv = document.getElementById('errorMessage');

            // Limit the input to 6 digits
            if (input.length > 6) {
                // Truncate the input to 6 digits
                this.value = input.slice(0, 6);
                errorMessageDiv.textContent = 'Only 6 digits allowed';
            } else {
                errorMessageDiv.textContent = '';
            }
        });

        function validateForm() {
            var emailInput = document.getElementById('floatingInput').value.trim();
            var errorMessageDiv = document.getElementById('errorMessage');

            var emailRegex = /^[0-9]{2,6}$/;

            if (emailInput.length < 4 || !emailRegex.test(emailInput)) {
                // Display error message
                errorMessageDiv.textContent = 'Invalid email address';
                // Prevent form submission
                return false;
            }

            // Form is valid, allow submission
            return true;
        }
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>