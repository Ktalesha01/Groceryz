<?php
?>
</main>
    <footer>
        <section class="socialMedia">
            <div>
                <a href="https://github.com/Ktalesha01" target="_blank">
                <i class="fa-brands fa-github fa-2xl"></i>
                <p>GitHub</p>
                </a>
            </div>
            <div>
                <a href="mailto:kalpeshtalesha01.official@gmail.com">
                <i class="fa-regular fa-envelope fa-2xl"></i>
                <p>Mail</p>
                </a>
            </div>
            <div>
                <a href="https://www.linkedin.com/in/kalpesh-talesha-881b75311/" target="_blank">
                <i class="fa-brands fa-linkedin fa-2xl"></i>
                <p>Linked In</p>
                </a>
            </div>
            <div>
                <a href="https://www.instagram.com/ktalesha01.official/?next=%2F&hl=en" target="_blank">
                <i class="fa-brands fa-instagram fa-2xl"></i>
                <p>Instagram</p>
                </a>
            </div>
            <div>
                <a href="https://wa.me/+917208495230" target="_blank">
                <i class="fa-brands fa-whatsapp fa-2xl"></i>  
                <p>Whatsapp</p>
                </a>
            </div>
        </section>
        <nav>
            <ul style="list-style-type: none;">
                <a href="<?php echo activeHref('homePage.php'); ?>"><li>Home</li></a>
                <?php if($_SESSION["role"]=="admin"): ?>
                    <a href="<?php echo activeHref('userDetails.php'); ?>"><li>Users</li></a>
                <?php endif; ?>
                <a href="<?php echo activeHref('aboutUs.php'); ?>"><li>About Us</li></a>
                <a href="<?php echo activeHref('contactUs.php'); ?>"><li>Contact Us</li></a>
            </ul>
        </nav>
        <p>
            Copyright &copy;2025 Groceryz <br>
            All Rights Reserved <br>
            Designed by- Kalpesh Talesha
        </p>
    </footer>
