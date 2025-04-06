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
    <title>Contact Us | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/contactUs.css">
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
                <a href="aboutUs.php"><li id="aboutUs">About Us</li></a>
                <a href="#" class="activeTab"><li id="contact">Contact</li></a>
                <a href="dashboard.php"><li id="profile"><i class="fa-solid fa-circle-user fa-2xl"></i></li></a>
            </ul>
        </nav>
    </header>
    <main>
    <div class="header1">
    <h1>Contact Us</h1>
    <p>We’d Love to Hear From You!</p>
</div>

<div class="container">

    <h2>Contact Information</h2>
    <ul class="contact-info">
        <li><i class="fas fa-envelope"></i> Email: <a href="mailto:support@groceryz.com">support@groceryz.com</a></li>
        <li><i class="fas fa-phone"></i> Phone: +1 (555) 123-4567</li>
        <li><i class="fas fa-map-marker-alt"></i> Address:  
            Groceryz Inc., 123 Greenway Lane, Suite 100, Seattle, WA 98101, USA</li>
    </ul>

    <h2>Support Hours</h2>
    <p><strong>Monday – Friday:</strong> 9:00 AM – 6:00 PM (PST)</p>
    <p><strong>Saturday – Sunday:</strong> Closed</p>

    <h2>Send Us a Message</h2>
    <form class="contact-form">
        <input type="text" placeholder="Your Name" required>
        <input type="email" placeholder="Email Address" required>
        <input type="text" placeholder="Subject" required>
        <textarea placeholder="Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>

    <h2>Connect With Us</h2>
    <div class="social-links">
        <a href="https://github.com/Ktalesha01" target="_blank">
            <i class="fa-brands fa-github"></i>
            <p>GitHub</p>
        </a>
        <a href="mailto:kalpeshtalesha01official@gmail.com">
            <i class="fa-regular fa-envelope"></i>
            <p>Mail</p>
        </a>
        <a href="https://www.linkedin.com/in/kalpesh-talesha-881b75311/" target="_blank">
            <i class="fa-brands fa-linkedin"></i>
            <p>LinkedIn</p>
        </a>
        <a href="https://www.instagram.com/ktalesha01.official/?next=%2F&hl=en" target="_blank">
            <i class="fa-brands fa-instagram"></i>
            <p>Instagram</p>
        </a>
        <a href="https://wa.me/+917208495230" target="_blank">
            <i class="fa-brands fa-whatsapp"></i>
            <p>WhatsApp</p>
        </a>
    </div>

</div>
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