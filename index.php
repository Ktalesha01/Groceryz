<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Publisher" content="Kalpesh Talesha">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="pictures/app_logo.png" sizes="64X64">
    <title>Groceryz - Grocery List Organization</title>
</head>
<body>
<?php
require "php/databaseConnect.php";

function test_input($data){
    return htmlspecialchars(trim($data));
}

$errorMessage = $status = "";

if (isset($_POST["loginSubmit"])) {
    $userId = test_input($_POST["userId"]);
    $password = test_input($_POST["password"]);

    $SQL = "SELECT * FROM user_data WHERE phone_no = '$userId' OR email_id = '$userId'";
    $result = mysqli_query($conn, $SQL);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['name'];
            $_SESSION['phone'] = $row['phone_no'];
            $_SESSION['email'] = $row['email_id'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == "admin") {
                header("Location: admin/adminHomePage.php");
                exit();
            } else {
                header("Location: user/homePage.php");
                exit();
            }
        } else {
            $status = "Incorrect Password";
        }
    } else {
        $status = "User Account not found";
    }
}

if (isset($_POST["signUpSubmit"])) {
    $name = test_input($_POST["username"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $confirmPassword = test_input($_POST["confirmPassword"]);

    if ($password !== $confirmPassword) {
        $errorMessage = "Password Mismatch";
    } else {
        $checkSQL = "SELECT * FROM user_data WHERE phone_no = '$phone' OR email_id = '$email'";
        $checkResult = mysqli_query($conn, $checkSQL);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $row = mysqli_fetch_assoc($checkResult);
            if ($row['phone_no'] == $phone && $row['email_id'] == $email) {
                $errorMessage = "User already exists.";
            } elseif ($row['phone_no'] == $phone) {
                $errorMessage = "User already exists with this phone no.";
            } elseif ($row['email_id'] == $email) {
                $errorMessage = "User already exists with this email id.";
            }
            echo "<script>window.onload = function() { onPageLoad(); }</script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertSQL = "INSERT INTO user_data (name, phone_no, email_id, password) 
                          VALUES ('$name', '$phone', '$email', '$hashedPassword')";

            if (mysqli_query($conn, $insertSQL)) {
                echo "<script>alert('Registration successful. Please login.');</script>";
            } else {
                $errorMessage = "Error while registering. Try again.";
            }
        }
    }
}
?>


    <article class="login-signup">
        <nav class="formNavigation">
            <button id="loginSectionButton" class="activeFormType">Login</button>
            <button id="signUpSectionButton">SignUp</button>
        </nav>
        <section class="loginFormSection active">
            <form id="loginForm" name="loginForm" action="" method="post">
                <input type="text" name="userId" id="userId" placeholder="Phone/ Email..." required>
                <input type="password" name="password" id="password" placeholder="Password..." required>
                <p id="errorMessage"><?php echo $status;?></p>
                <p id="forgetPassword"><a href="admin/forgotPassword.php">Forgot Password?</a></p>
                <button id="loginSubmit" name="loginSubmit" type="submit">Login</button>
            </form>
             
            <p>Create an account? <span id="switchToSignUp">SignUp</span></p>
        </section>
        <section class="signUpFormSection">
            <form id="signUpForm" name="signUpForm" action="" method="post">
                <input type="text" name="username" id="username" placeholder="Username...">
                <input type="number" name="phone" id="phone" placeholder="Phone...">
                <input type="email" name="email" id="email" placeholder="Email Id...">
                <input type="password" name="password" id="password" placeholder="Password...">
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password...">
                <p id="rerrorMessage"><?php echo $errorMessage;?></p>
                <button id="signUpSubmit" name="signUpSubmit" type="submit">SignUp</button>
            </form>
            <p>Already have account? <span id="switchToLogin">Login</span></p>
        </section>
    </article>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>