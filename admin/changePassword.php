<?php
    session_start();

    if(isset($_SESSION["username"])){
    }
    else{
        echo "<script>location.href='../index.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/changePassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php
        $errorMessage = "";
    ?>
    <section class="changePasswordSection">
        <div>
            <button id="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button>
        </div>
        <div id="formName">
            <h2>Change Password</h2>
        </div>
        <form id="changePasswordForm" action="confirmPassword.php" method="POST">
            <div class="maindiv">
                <div>
                    <label for="updatedPassword">New Password:</label>
                    <input type="password" name="updatedPassword" id="updatedPassword" required>
                </div>
                <div>
                    <label for="updatedConfirmPassword">Confirm Password:</label>
                    <input type="password" name="updatedConfirmPassword" id="updatedConfirmPassword" required>
                </div>
                <div class="errorMessage">
                    <p><?php echo $errorMessage;?></p>
                </div>
                <div class="formBtns">
                    <button id="passwordChangeBtn" name="passwordChangeBtn">Update</button>
                </div>
            </div>
        </form>
    </section>
    <script src="js/changePassword.js"></script>
</body>
</html>