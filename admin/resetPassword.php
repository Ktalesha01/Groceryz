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
                window.location.href = '../index.php';
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
</head>
<body>
    <h2>Reset Your Password</h2>
        <form method="POST">
            <label for="password">New Password:</label><br>
            <input type="password" name="password" required placeholder="Enter new password"><br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" name="confirm_password" required placeholder="Confirm new password"><br><br>
            <p><?php echo $passwordError?></p>
            <button type="submit">Reset Password</button>
        </form>
</body>
</html>

