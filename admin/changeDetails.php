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
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/changeDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <section class="changeDetailsSection">
        <form id="changeDetailsForm" action="" method="POST" enctype="multipart/form-data">
            <div>
                <div>
                    <button id="closeBtn" type="button"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div>
                    <label for="updatedName">Name: </label>
                    <input type="text" name="updatedName" id="updatedName" value="<?php echo $_SESSION["username"] ?>">
                </div>
                <div>
                    <label for="updatedProfilePic">Profile Photo:</label> 
                    <input type="file" name="updatedProfilePic" id="updatedProfilePic" accept=".png, .jpeg, .jpg">
                </div>
                <div>
                    <label for="updatedPhone">Phone:</label> 
                    <input type="number" name="updatedPhone" id="updatedPhone" value="<?php echo $_SESSION["phone"] ?>">
                </div>
                <div>
                    <label for="updatedEmail">Email:</label> 
                    <input type="email" name="updatedEmail" id="updatedEmail" value="<?php echo $_SESSION["email"] ?>">
                </div>
                <div>
                    <button id="resetBtn" type="reset">Reset</button>
                    <button type="submit" id="updateDetailsBtn" name="updateDetailsBtn">Update</button>
                </div>
            </div>
        </form>
            
        <?php
            if(isset($_POST["updateDetailsBtn"])){
                echo '
                    <form id="userConfirmForm" action="" method="POST">
                        <section>
                            <p>Confirm User</p>
                            <label for="passwordConfirmation">Enter Password:</label>
                            <input type="password" name="passwordConfirmation" required>
                            <button type="submit" name="confirmUpdateDetails">Confirm</button>
                        </section>
                    </form>';
            }
        ?>
        </section>
    <script src="js/changeDetails.js"></script>
</body>
</html>