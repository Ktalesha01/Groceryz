<?php
session_start();
require '../vendor/autoload.php';  // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize error
$error = " ";

// When form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $otp = rand(100000, 999999); // Generate OTP

        // Store in session
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_email'] = $email;

        // ✅ Send OTP via Email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kalpeshtalesha01.official@gmail.com';
            $mail->Password = 'apfr zgmk qpmb ymng'; // Secure this in future
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('kalpeshtalesha01.official@gmail.com', 'Groceryz Support');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body    = "<h3>Hello,</h3><p>Your OTP for password reset is: <strong>$otp</strong></p>";

            $mail->send();

            // Redirect on success
            header("Location: verifyOtp.php");
            exit();
        } catch (Exception $e) {
            $error = "Email sending failed: {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/forgotPassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <section class="forgotPasswordSection">
        <div>
            <button id="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button>
        </div>
        <div id="formName">
            <h2>Forgot Password</h2>
        </div>
        <form id="forgotPasswordForm" action="" method="POST">
            <div class="maindiv">
                <div>
                    <label for="email">Enter your email address:</label>
                    <input type="email" name="email" required><br>
                </div>
                <div class="errorMessage">
                    <p><?php echo $error;?></p>
                </div>
                <div class="formBtns">
                    <button type="submit" id="sendOtpBtn" name="sendOtpBtn">Send OTP</button>
                </div>
            </div>
        </form>
    </section>
    <script src="js/forgotPassword.js"></script>

</body>
</html>

