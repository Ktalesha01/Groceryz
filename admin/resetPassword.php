<?php
session_start();

// Check if OTP was verified
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    header("Location: forgotPassword.php");
    exit();
}

$passwordError = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $passwordError = "Passwords do not match.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Connect to DB
        include '../php/databaseConnect.php'; // DB connection

        $email = $_SESSION['otp_email']; // Retrieved from session
        $sql = "UPDATE user_data SET password = '$hashedPassword' WHERE email_id = '$email'";

        if (mysqli_query($conn, $sql)) {
            $successMessage = "Password reset successful. Redirecting to login page...";
            echo "<script>
                alert(`$successMessage`);
                window.location.href = '../login.php';
            </script>";
            session_destroy();
            exit();
        } else {
            $passwordError = "Error updating password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/resetPassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<section class="resetPasswordSection">
        <div>
            <button id="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button>
        </div>
        <div id="formName">
            <h2>Reset Your Password</h2>
        </div>
        <form id="resetPasswordForm" action="" method="POST">
            <div class="maindiv">
                <div>
                    <label for="password">New Password:</label><br>
                    <input type="password" name="password" required placeholder="Enter new password"><br>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password:</label><br>
                    <input type="password" name="confirm_password" required placeholder="Confirm new password">
                </div>
                <div class="errorMessage">
                    <p><?php echo $passwordError;?></p>
                </div>
                <div class="formBtns">
                    <button type="submit" id="resetPasswordBtn" name="resetPasswordBtn">Reset Password</button>
                </div>
            </div>
        </form>
    </section>
    <script src="js/resetPassword.js"></script>

</body>
</html>

