<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/changeDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php

    if (!isset($_SESSION["username"])) {
        echo "<script>location.href='../login.php'</script>";
        exit();
    }

    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateDetailsBtn"])) {
        $updatedName = $_POST["updatedName"];
        $updatedPhone = $_POST["updatedPhone"];
        $updatedEmail = $_POST["updatedEmail"];

        // ✅ Handle file upload safely
        if (isset($_FILES["updatedProfilePic"]) && $_FILES["updatedProfilePic"]["error"] === 0) {
            $photoTmp = $_FILES["updatedProfilePic"]["tmp_name"];
            $photoData = file_get_contents($photoTmp);
            $photoData = base64_encode($photoData); // You can store this in DB
        } else {
            $photoData = ""; // or keep existing one from DB
        }

        // Store data in session temporarily for confirmation page
        $_SESSION["updated_name"] = $updatedName;
        $_SESSION["updated_phone"] = $updatedPhone;
        $_SESSION["updated_email"] = $updatedEmail;
        $_SESSION["updated_profile"] = $photoData;
        $_SESSION["working_page"] = "changeDetails";
        // ✅ Redirect to password confirmation
        header("Location: confirmPassword.php");
        exit();
    }
?>

    <section class="changeDetailsSection">
        <div>
            <button id="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button>
        </div>
        <div id="formName">
            <h2>Change User Details</h2>
        </div>
        <form id="changeDetailsForm" action="changeDetails.php" method="POST" enctype="multipart/form-data">
            <div class="maindiv">
                <div>
                    <label for="updatedName">Name: </label>
                    <input type="text" name="updatedName" id="updatedName" value="<?php echo $_SESSION["username"] ?>" required>
                </div>
                <div>
                    <label for="updatedProfilePic">Profile Photo:</label> 
                    <input type="file" name="updatedProfilePic" id="updatedProfilePic" accept=".png, .jpeg, .jpg">
                </div>
                <div>
                    <label for="updatedPhone">Phone:</label> 
                    <input type="number" name="updatedPhone" id="updatedPhone" value="<?php echo $_SESSION["phone"] ?>" required>
                </div>
                <div>
                    <label for="updatedEmail">Email:</label> 
                    <input type="email" name="updatedEmail" id="updatedEmail" value="<?php echo $_SESSION["email"] ?>" required>
                </div>
                <div class="errorMessage">
                    <p><?php echo $errorMessage;?></p>
                </div>
                <div class="formBtns">
                    <button id="resetBtn" type="reset">Reset</button>
                    <button type="submit" id="updateDetailsBtn" name="updateDetailsBtn">Update</button>
                </div>
            </div>
        </form>
    </section>
    <script src="js/changeDetails.js"></script>
</body>
</html>