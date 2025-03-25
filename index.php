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
            $data= trim($data);
            return htmlspecialchars($data);
        };
        $errorMessage= $status= " ";
        if(isset($_POST["loginSubmit"])){
    
            $userId ="";


            if($_SERVER["REQUEST_METHOD"]=="POST"){

                
                $userId = test_input($_POST["userId"]);
                $password = test_input($_POST["password"]);

                $SQL= "SELECT * FROM `groceryz`.`user_data` WHERE (`phone_no` = '$userId' OR `email_id` = '$userId') AND `password`= '$password'";

                $SQL1= "SELECT * FROM `groceryz`.`user_data` WHERE (`phone_no` = '$userId' OR `email_id` = '$userId') AND `password`!= '$password'";

                $correct_credentials= MYSQLI_QUERY($conn,$SQL);

                $incorrect_password= MYSQLI_QUERY($conn,$SQL1);

                $result= MYSQLI_FETCH_ASSOC($correct_credentials);


                if($correct_credentials !== false && MYSQLI_NUM_ROWS($correct_credentials) > 0)
                {
                    $user_type= $result['role'];
                    
                    $_SESSION['username']=$result['name'];
                    $_SESSION['phone']=$result['phone_no'];
                    $_SESSION['email']=$result['email_id'];
                    $_SESSION['role']=$result['role'];



                    if($user_type=="admin"){
    ?>
                        <script type="text/javascript">
                            window.location="admin/adminHomePage.php";
                        </script>
    <?php
                    } else{
    ?>
                        <script type="text/javascript">
                            window.location="user/homePage.php";
                        </script>
    <?php

                    };
                } else if($incorrect_password !== false && MYSQLI_NUM_ROWS($incorrect_password) > 0){
                    $status= "Incorrect Password";
                } else{
                    $status= "User Account not found";
                };

            };
        }
        elseif(isset($_POST["signUpSubmit"])){

            $name= $phone= $email= $confirmPasswordErr= "";
        
            if($_SERVER["REQUEST_METHOD"]=="POST"){
        
                $confirmPasswordErr = "";
                $name= test_input($_POST["username"]);
                $phone= test_input($_POST["phone"]);
                $email= test_input($_POST["email"]);
                $password= test_input($_POST["password"]);
                $confirmPassword= test_input($_POST["confirmPassword"]);
        
                if($password != $confirmPassword){
                    $confirmPasswordErr= "Password Mismatch";
                }
        
                $user_details= "SELECT * FROM `groceryz`.`user_data` WHERE `phone_no`='$phone' OR `email_id`='$email'";
                $users= MYSQLI_QUERY($conn,$user_details);
        
                $row= MYSQLI_NUM_ROWS($users);
                $fetch= MYSQLI_FETCH_ASSOC($users);
        
                if($password==$confirmPassword){
                    if($row==0){
                        $SQL= "INSERT INTO `user_data` (`name`,`phone_no`,`email_id`,`password`) VALUES ('$name','$phone','$email','$password')";
                        $result= MYSQLI_QUERY($conn,$SQL);
        
                        if($result){ 
    ?>
                            <script type="text/javascript">
                                window.location="#";
                            </script> 
    <?php
                        };
                    } else if ($fetch['phone_no'] == $phone && $fetch['email_id'] == $email) {
                        $errorMessage = "User already exists.";
    ?>
                            <script type="text/javascript">
                                window.onload = function() {
                                    onPageLoad();
                                };
                            </script> 
    <?php
                    } elseif ($fetch['phone_no'] == $phone) {
                        $errorMessage = "User already exists with this phone no.";
    ?>
                            <script type="text/javascript">
                                window.onload = function() {
                                    onPageLoad();
                                };
                            </script> 
    <?php
                    } elseif ($fetch['email_id'] == $email) {
                        $errorMessage = "User already exists with this email id";
    ?>
                            <script type="text/javascript">
                                window.onload = function() {
                                    onPageLoad();
                                };
                            </script> 
    <?php
                    }    
                }
            }
                
        };

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
                <div>
                    <p id="errorMessage"><?php echo $status;?></p>
                </div>
                <p id="forgetPassword"><a href="forgetPassword.php">Forget Password?</a></p>
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
                <p id="errorMessage"><?php echo $errorMessage;?></p>
                <button id="signUpSubmit" name="signUpSubmit" type="submit">SignUp</button>
            </form>
            <p>Already have account? <span id="switchToLogin">Login</span></p>
        </section>
    </article>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>