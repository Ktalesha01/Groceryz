<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userOtp = htmlspecialchars($_POST["otp"]);

    // Check if OTP matches
    if ($userOtp == $_SESSION['otp']) {
        header("Location: resetPassword.php"); // Redirect to reset password page
        exit();
    } else {
        $errorMessage = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | Groceryz</title>
</head>
<body>
    <h2>Enter OTP Sent to Your Email/Phone</h2>
    <form action="" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required>
        <br>
        <button type="submit">Verify OTP</button>
    </form>
    <?php
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>
</body>
</html>
