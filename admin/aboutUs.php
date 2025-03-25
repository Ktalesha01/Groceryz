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
    <title>About Us | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/aboutUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <figure>
            <img src="../pictures/logo_with_name-removebg-preview.png" alt="Site Logo" height="100px">
        </figure>
        <nav>
            <ul style="list-style-type: none;">
                <a href="adminHomePage.php"><li id="home">Home</li></a>
                <a href="userDetails.php"><li id="users">Users</li></a>
                <a href="#" class="activeTab"><li id="aboutUs">About Us</li></a>
                <a href="contactUs.php"><li id="contact">Contact</li></a>
                <a href="dashboard.php"><li id="profile"><i class="fa-solid fa-circle-user fa-2xl"></i></li></a>
            </ul>
        </nav>
    </header>


    <main>
        <section class="aboutUsSection">
            <h2>About Us</h2>
            <div class="container">
                <img src="../pictures/logo_with_name.png"  alt="Groceryz Logo" id="siteLogo">

                <p>At <strong>Groceryz</strong>, we believe that managing grocery lists should be simple, efficient, and secure. Our journey began with a common frustration: traditional grocery list methods—whether scribbled on paper or managed through basic apps—often lack essential features like real-time collaboration, effective organization, and data security. Recognizing these limitations, we set out to build a solution that transforms the way people handle their grocery shopping tasks.</p>
            </div>
        </section>

        <section class="ourMissionSection">
            <h2>Our Mission</h2>
            <div class="container">
                <img src="../pictures/our_mission.png" alt="Our Mission" id="ourMissionPic">
                <p>Our mission is to streamline the grocery shopping experience by providing a powerful yet user-friendly platform that supports seamless collaboration, secure data management, and smart organization. We aim to empower users with tools that save time and reduce the stress of managing grocery lists, making everyday shopping a smoother process.</p>
            </div>
        </section>

        <section>
            <h2>What We Offer</h2>
            <div class="container">
                <img src="../pictures/what_we_offer.png" alt="Features" id="whatWeOfferPic">
                <ul>
                    <li><strong>Role-Based Access:</strong> Manage lists efficiently based on access levels (Admin and Normal Users).</li>
                    <li><strong>Real-Time Collaboration:</strong> Share and update lists effortlessly.</li>
                    <li><strong>Secure Data Handling:</strong> Advanced security measures for data protection.</li>
                    <li><strong>Smart Organization:</strong> Store recent lists and categorize items effectively.</li>
                    <li><strong>Modern Web Technologies:</strong> Fast, responsive, and interactive user experience.</li>
                </ul>
            </div>
        </section>

        <section>
            <h2>Our Vision</h2>
            <div class="container">
                <img src="../pictures/our_vision.png" alt="Our Vision" id="ourVision">
                <p>We envision a world where managing grocery lists is no longer a chore but a convenient and even enjoyable part of your routine. By continuously enhancing our features and incorporating user feedback, we strive to be the go-to app for grocery management.</p>
            </div>
        </section>

        <section>
            <h2>Why Choose Us?</h2>
            <div class="container">
                <p>Choosing Groceryz means choosing a platform that values security, efficiency, and user satisfaction. We are committed to providing reliable support and continuously improving our features to adapt to your needs.</p>

                <p>Thank you for being a part of our journey. We're excited to help you simplify your grocery shopping experience—one list at a time!</p>
            </div>
        </section>
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
                <a href="adminHomePage.php"><li>Home</li></a>
                <a href="userDetails.php"><li>Users</li></a>
                <a href="#"><li>About Us</li></a>
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