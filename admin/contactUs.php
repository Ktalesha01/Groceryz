<?php
    session_start();

    if(isset($_SESSION["username"])){
    }
    else{
        echo "<script>location.href='../index.php'</script>";
    }

    $status = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $to = "kalpeshtalesha01official@gmail.com"; 
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $subject = htmlspecialchars($_POST["subject"]);
        $message = htmlspecialchars($_POST["message"]);

        $fullMessage = "From: $name <$email>\n\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $fullMessage, $headers)) {
            $status = "success";
        } else {
            $status = "error";
        }
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
        <?php if (isset($_GET["status"]) && $_GET["status"] == "success"): ?>
            <div class="success-banner">
                ✅ Your message has been sent successfully!
            </div>
        <?php elseif (isset($_GET["status"]) && $_GET["status"] == "error"): ?>
            <div class="error-banner">
                ❌ Something went wrong. Please try again.
            </div>
        <?php endif; ?>

        <div class="mainDiv">
            <div id="subDiv1">
                <section id="formSection" method="POST">
                    <p>We’d Love to Hear From You!</p>
                    <h1>Send Us a Message</h1>
                    <form id="contact-form" method="post">
                        <div>
                            <input type="text" name="name" placeholder="Your Name" required>
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div>
                            <input type="text" name="subject" placeholder="Subject" required>
                        </div>
                        <div>
                            <textarea rows="12" name="message" placeholder="Message" required></textarea>
                        </div>
                        <div class="formBtns">
                            <button id="resetBtn" type="reset">Reset</button>
                            <button id="sendbtn" type="submit">Send Message</button>
                        </div>
                    </form>
                </section>
            </div>

            <div id="subDiv2">
                <section id="section1">
                    <img src="../pictures/contact_us.png" width="70%" alt="">
                    <h1>Contact Us</h1>
                </section>

                <section id="section2">
                    <h2>Contact Information</h2>
                    <ul class="contact-info">
                        <li><i class="fas fa-envelope"></i> Email: <a href="mailto:kalpeshtalesha01@gmail.com">kalpeshtalesha01@gmail.com</a></li>
                        <li><i class="fas fa-phone"></i> Phone: <a href="tel:+917208495230">+91 72084 95230</a></li>
                        <li><i class="fas fa-map-marker-alt"></i> Address:  
                            <a href="https://maps.app.goo.gl/X18GVCQZhh5QhJ4T9" target="_blank">Groceryz Inc., Kharigaon, Kalwa, Thane- 400605, Maharashtra, India</a></li>
                    </ul>
                </section>

                <section id="section3">
                    <h2>Support Hours</h2>
                    <p><strong>Monday – Friday:</strong> 9:00 AM – 6:00 PM (PST)</p>
                    <p><strong>Saturday – Sunday:</strong> Closed</p>
                </section>
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