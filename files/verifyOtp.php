<?php
session_start();

if (!isset($_SESSION['otp'])) {
    header("Location: forgotPassword.php");
    exit();
}

$otpError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = htmlspecialchars($_POST['otp']);

    if ($enteredOtp == $_SESSION['otp']) {
        $_SESSION['otp_verified'] = true;
        header("Location: resetPassword.php");
        exit();
    } else {
        $otpError = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/verifyOtp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <section class="verifyOtpSection">
        <div>
            <button id="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button>
        </div>
        <div id="formName">
            <h2>Verify OTP</h2>
        </div>
        <form id="verifyOtpForm" action="" method="POST">
            <div class="maindiv">
                <div>
                    <label for="otp">Enter the OTP sent to your email:</label><br>
                    <input type="text" name="otp" required pattern="\d{6}" placeholder="6-digit OTP" autofocus><br><br>
                </div>
                <div class="errorMessage">
                    <p><?php echo $otpError;?></p>
                </div>
                <div class="formBtns">
                    <button type="submit" id="verifyOtpBtn" name="verifyOtpBtn">Verify OTP</button>
                </div>
            </div>
        </form>
    </section>
    <script src="js/verifyOtp.js"></script>
</body>
</html>
