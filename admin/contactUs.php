<?php
    session_start();

    require "../php/header.php";

    if (!isset($_SESSION["username"])) {
        echo "<script>location.href='../login.php'</script>";
        exit();
    }

    $status = "";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $to = "kalpeshtalesha01official@gmail.com"; 
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $subject = htmlspecialchars($_POST["subject"]);
        $message = htmlspecialchars($_POST["message"]);

        $fullMessage = "From: $name <$email>\n\n$message";
        $headers = "From: $email";


        $mail = new PHPMailer(true); 
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'kalpeshtalesha01.official@gmail.com'; 
            $mail->Password = 'apfr zgmk qpmb ymng'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress($to);

            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body    = $fullMessage;

            if ($mail->send()) {
                $status = "success";
            }
        } catch (Exception $e) {
            $status = "error: " . $mail->ErrorInfo;
        }
    }
?>

    <main>
        <?php if (isset($status) && $status == "success"): 
                $_POST["name"] = $_POST["email"] = $_POST["subject"] = $_POST["message"] = "";
                echo "<script>alert(`✅ Your message has been sent successfully!`)</script>";
            
         elseif (isset($status) && $status == "error"): 
            
                echo "<script>alert(`❌ Something went wrong. Please try again.`)</script>";
            
         endif; ?>

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

    <?php
        require "../php/footer.php";
    ?>
</body>
</html>
