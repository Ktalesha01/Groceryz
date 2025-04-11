<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = htmlspecialchars($_POST["newPassword"]);
    $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);

    if ($newPassword == $confirmPassword) {
        // Save the new password (for testing purposes, save it to session)
        $_SESSION['new_password'] = $newPassword;

        // Redirect to login page (or any success page)
        header("Location: login.php");
        exit();
    } else {
        $errorMessage = "Passwords do not match. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Groceryz</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <form action="" method="POST">
        <label for="newPassword">Enter New Password:</label>
        <input type="password" name="newPassword" required>
        <br>
        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" name="confirmPassword" required>
        <br>
        <button type="submit">Reset Password</button>
    </form>
    <?php
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>
</body>
</html>
