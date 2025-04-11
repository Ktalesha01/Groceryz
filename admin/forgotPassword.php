<?php
session_start();

// Include PHPMailer and Twilio libraries
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';  // Ensure you have PHPMailer installed via Composer
require_once 'path/to/vendor/autoload.php'; // Twilio SDK

// Twilio credentials
$sid = 'your_twilio_sid';
$token = 'your_twilio_auth_token';
$twilioPhoneNumber = 'your_twilio_phone_number';
$twilioClient = new \Twilio\Rest\Client($sid, $token);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    
    $otp = rand(100000, 999999); // Generate OTP

    // Store OTP in session for verification later
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_email'] = $email;
    $_SESSION['otp_phone'] = $phone;

    // Send OTP via email (PHPMailer)
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // or use your SMTP provider
        $mail->SMTPAuth = true;
        $mail->Username = 'kalpeshtalesha01.official@gmail.com';  // Your email
        $mail->Password = 'apfr zgmk qpmb ymng';  // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('kalpeshtalesha01.official@gmail.com', 'Groceryz');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Password Reset';
        $mail->Body    = "Your OTP for password reset is: $otp";

        $mail->send();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Send OTP via SMS (Twilio)
    try {
        $twilioClient->messages->create(
            $phone, // Phone number to send OTP to
            [
                'from' => $twilioPhoneNumber,
                'body' => "Your OTP for password reset is: $otp"
            ]
        );
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    header("Location: verifyOtp.php"); // Redirect to OTP verification page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Groceryz</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form action="" method="POST">
        <label for="email">Enter your email address:</label>
        <input type="email" name="email" required>
        <br>
        <label for="phone">Enter your phone number:</label>
        <input type="text" name="phone" required>
        <br>
        <button type="submit">Send OTP</button>
    </form>
</body>
</html>
