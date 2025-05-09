<?php
session_start();
require '../php/databaseConnect.php'; 

if (!isset($_SESSION["username"])) {
    echo "<script>location.href='login.php'</script>";
    exit();
}

$errorMessage = "";
$phone = $_SESSION["phone"];
$email = $_SESSION["email"];

if($_SESSION['working_page']=="changeDetails")
{
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirmUpdateDetails"])) {
        $enteredPassword = $_POST["passwordConfirmation"];

        $query = "SELECT password FROM user_data WHERE `phone_no` = '$phone' AND `email_id` = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row["password"];

            if (password_verify($enteredPassword, $hashedPassword)) {
                $updatedName = $_SESSION["updated_name"];
                $updatedPhone = $_SESSION["updated_phone"];
                $updatedEmail = $_SESSION["updated_email"];
                $profileData = $_SESSION["updated_profile"];

                if (!empty($profileData)) {
                    $updateQuery = "UPDATE user_data SET `name`='$updatedName', `phone_no`='$updatedPhone', `email_id`='$updatedEmail', `profile_pic`='$profileData' WHERE `phone_no` = '$phone' AND `email_id` = '$email'";
                } else {
                    $updateQuery = "UPDATE user_data SET `name`='$updatedName', `phone_no`='$updatedPhone', `email_id`='$updatedEmail' WHERE `phone_no` = '$phone' AND `email_id` = '$email'";
                }

                if (mysqli_query($conn, $updateQuery)) {
                    $_SESSION["username"] = $updatedName;
                    $_SESSION["phone"] = $updatedPhone;
                    $_SESSION["email"] = $updatedEmail;

                    echo "<script>alert('Details updated successfully!'); location.href='dashboard.php';</script>";
                    exit();
                } else {
                    $errorMessage = "Failed to update details. Try again.";
                }
            } else {
                $errorMessage = "Incorrect password. Please try again.";
            }
        } else {
            $errorMessage = "User not found.";
        }
    }
}
else if($_SESSION['working_page']=="changePassword")
{
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirmUpdateDetails"])) 
    {
        $enteredPassword = $_POST["passwordConfirmation"];

        $query = "SELECT password FROM user_data WHERE `phone_no` = '$phone' AND `email_id` = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row["password"];

            if (password_verify($enteredPassword, $hashedPassword)) 
            {
                $newPassword = $_SESSION['newPassword'];
                $sql = "UPDATE user_data SET password = '$newPassword' WHERE phone_no = '$phone' AND email_id = '$email'";

                if (mysqli_query($conn, $sql)) {
                    $successMessage = "Password updated successfully.";
                    echo "<script>
                        alert('$successMessage');
                        window.location.href = 'dashboard.php'; // Redirect to dashboard
                    </script>";
                    exit();
                } else {
                    $errorMessage = "Error updating password. Please try again.";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/confirmPassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <section class="confirmPasswordSection">
        <div>
            <button id="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button>
        </div>
        <div id="formName">
            <h2>Confirm User</h2>
        </div>
        <form id="userConfirmForm" action="" method="POST">
            <div class="maindiv">
                <div>
                    <label for="passwordConfirmation">Enter Password:</label>
                    <input type="password" name="passwordConfirmation" required>
                </div>
                <div class="errorMessage">
                    <p><?php echo $errorMessage;?></p>
                </div>
                <div>
                    <p><a href="forgotPassword.php">Forgot Password?</a></p>
                </div>
                <div class="formBtns">
                    <button type="submit" id="confirmUpdateDetails" name="confirmUpdateDetails">Confirm</button>
                </div>
            </div>
        </form>
    </section>
    <script>
        let workingPage = <?php echo json_encode($_SESSION['working_page']); ?>;
    </script>
    <script src="js/confirmPassword.js"></script>
</body>
</html>