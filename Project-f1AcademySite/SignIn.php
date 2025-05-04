<?php
include "includes/connect.php";
include "includes/layout.php";
include "includes/auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Academy-Sign In</title>
    <link rel="stylesheet" href="Css/layout.css">
    <link rel="stylesheet" href="Css/SignIn.css">
</head>

<body>
    <div class="page-wrapper">
        <header>
            <a href="index.php">
                <img src="Assets/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
            </a>
        </header>

        <main>
            <div class="signin-container">
                <h2>SIGN IN</h2>

                <?php if (!empty($message)): ?>
                    <p style="color: #c3047c; font-weight: bold; font-size: 12px;"><?= $message ?></p>
                <?php endif; ?>

                <?php
                if (isset($_GET['registered']) && $_GET['registered'] == 1) {
                    echo "<p style='color: green;'>Registration successful! Please log in.</p>";
                }
                ?>

                <form method="post" action="">
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" placeholder="you@example.com" required />

                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" placeholder="••••••••••••••" required />
                        <i class="fas fa-eye toggle-password"></i>
                    </div>

                    <button class="sign-in-btn" name="sign-in-btn">SIGN IN</button>
                </form>

                <p class="register-link">Don't have an account yet? <a href="register.php">Register</a></p>
            </div>
        </main>



        <footer>
            <div class="footer_list">
                <ul>
                    <li><a href="">TERMS OF USE</a></li>
                    <li><a href="">COOKIES POLICY</a></li>
                    <li><a href="">PRIVACY NOTICE</a></li>
                    <li><a href="">CREDITS</a></li>
                    <li><a href="">CONTACT US</a></li>
                    <li><a href="">FAQ</a></li>
                    <li><a href="">PRIVACY MANAGER GDPR</a></li>
                </ul>

                <div class="social-icons">
                    <div class="icon_con"><a href="https://instagram.com" target="_blank"><i
                                class="fab fa-instagram"></i></a></div>
                    <div class="icon_con"><a href="https://twitter.com" target="_blank"><i
                                class="fab fa-x-twitter"></i></a>
                    </div>
                    <div class="icon_con"><a href="https://youtube.com" target="_blank"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="footer_text">OUR PARTNERS</div>

            <div class="partner_cont">
                <div class="partners_row">
                    <a href="https://www.tagheuer.com/int/en/" class="partner_logo"><img src="Assets/TagHeuer.svg"
                            alt="Tag Heuer"></a>
                    <a href="https://www.americanexpress.com/" class="partner_logo"><img
                            src="Assets/AmericanExpress.svg" alt="American Express"></a>
                    <a href="https://www.charlottetilbury.com/uk/secrets/charlotte-tilbury-f1-academy"
                        class="partner_logo"><img src="Assets/CharlotteTilbury.svg" alt="Charlotte Tilbury"></a>
                    <a href="https://www.morethanequal.com/" class="partner_logo"><img src="Assets/MoreThanEqual.svg"
                            alt="More Than Equal"></a>
                </div>
                <div class="partners_row">
                    <a href="https://www.morganstanley.com/" class="partner_logo"><img src="Assets/MorganStanley.svg"
                            alt="Morgan Stanley"></a>
                    <a href="https://uk.puma.com/uk/en/sports/motorsport" class="partner_logo"><img
                            src="Assets/Puma.svg" alt="Puma"></a>
                    <a href="https://www.teamviewer.com/en-cis/" class="partner_logo"><img src="Assets/TeamViewer.svg"
                            alt="TeamViewer"></a>
                    <a href="https://uk.tommy.com/" class="partner_logo"><img src="Assets/TommyHilfiger.svg"
                            alt="Tommy Hilfiger"></a>
                    <a href="https://www.pirelli.com/tyres/en-ww/motorsport/home" class="partner_logo"><img
                            src="Assets/Pirelli.svg" alt="Pirelli"></a>
                </div>
                <hr class="dec_line">
                <div class="partners_row">
                    <a href="https://www.tatuus.it/en" class="partner_logo"><img src="Assets/Tatuus.svg"
                            alt="Tatuus"></a>
                    <a href="https://www.autotecnicamotori.it/" class="partner_logo"><img src="Assets/ATM.svg"
                            alt="ATM"></a>
                    <a href="https://www.aramco.com/en" class="partner_logo"><img src="Assets/Aramco.svg"
                            alt="Aramco"></a>
                </div>
            </div>
            <hr>
            <div class="footer_con">
                <img src="Assets/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
                <p>© 2025 F1 Academy Limited</p>
            </div>
        </footer>
    </div>
    <script src="JS/SignInRegister.js"></script>
</body>

</html>