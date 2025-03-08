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
    <title>Home Page | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <figure>
            <img src="../pictures/logo_with_name-removebg-preview.png" alt="Site Logo" height="90px">
        </figure>
        <nav>
            <ul style="list-style-type: none; color: white; text-decoration:none;">
                <a href="#" class="activeTab"><li id="home">Home</li></a>
                <a href="userDetails.php"><li id="users">Users</li></a>
                <a href="aboutUs.php"><li id="aboutUs">About Us</li></a>
                <a href="contactUs.php"><li id="contact">Contact</li></a>
                <a href="dashboard.php"><li id="profile"><i class="fa-solid fa-circle-user fa-2xl"></i></li></a>
            </ul>
        </nav>
    </header>
    <main>
    
    </main>
    <footer>
        <section class="socialMedia">
            <div>
                <a href="https://github.com/Ktalesha01">
                <i class="fa-brands fa-github fa-2xl"></i>
                <p>GitHub</p>
                </a>
            </div>
            <div>
                <a href="mailto:kalpeshtalesha01official@gmail.com">
                <i class="fa-regular fa-envelope fa-2xl"></i>
                <p>Mail</p>
                </a>
            </div>
            <div>
                <a href="https://www.linkedin.com/in/kalpesh-talesha-881b75311/">
                <i class="fa-brands fa-linkedin fa-2xl"></i>
                <p>Linked In</p>
                </a>
            </div>
            <div>
                <a href="https://www.instagram.com/ktalesha01.official/?next=%2F&hl=en">
                <i class="fa-brands fa-instagram fa-2xl"></i>
                <p>Instagram</p>
                </a>
            </div>
            <div>
                <a href="https://wa.me/+917208495230">
                <i class="fa-brands fa-whatsapp fa-2xl"></i>  
                <p>Whatsapp</p>
                </a>
            </div>
        </section>
        <nav>
            <ul style="list-style-type: none;">
                <a href="#"><li>Home</li></a>
                <a href="userDetails.php"><li>Users</li></a>
                <a href="aboutUs.php"><li>About Us</li></a>
                <a href="contactUs.php"><li>Contact Us</li></a>
            </ul>
        </nav>
        <p>
            Copyright &copy;2025 Groceryz <br>
            All Rights Reserved <br>
            Designed by- Kalpesh Talesha
        </p>
    </footer>
</body>
</html>