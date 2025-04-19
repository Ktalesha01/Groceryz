<?php
    session_start();

    if(isset($_SESSION["username"])){
    }
    else{
        echo "<script>location.href='login.php'</script>";
    }
    require "../php/header.php";

?>

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

    <?php
        require "../php/footer.php";
    ?>
</body>
</html>