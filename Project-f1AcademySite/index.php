<?php
include "includes/connect.php";
include "includes/layout.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Academy</title>
    <link rel="stylesheet" href="Css/layout.css?v=3">
    <link rel="stylesheet" href="Css/HomePage.css?v=2">

</head>

<body>
    <header>
        <a href="index.php">
            <img src="Assets/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
        </a>

        <div class="list">
            <ul>
                <li><a href="">Teams</a></li>
                <li><a href="">Drivers</a></li>
                <li><a href="">Results</a></li>
                <li><a href="">Schedule</a></li>
            </ul>
        </div>

        <a href="SignIn.php">
            <div class="sign_in">
                <i class="fas fa-user"></i> Sign In
            </div>
        </a>

    </header>

    <main>
        <div class="home-section">
            <img src="Assets/HomePic.png" alt="F1 academy picture" class="home-bg">
            <div class="home-content">
                <h1>FINDING THE NEXT GENERATION OF TALENT ON AND OFF TRACK</h1>
                <p>
                    F1 Academy is here to champion the next generation of female talent to explore their own motorsport
                    journeys.
                    By breaking down barriers to entry on track in the F1 Academy Racing Series and through grassroots
                    initiatives
                    such as F1 Academy Discover Your Drive, we hope to make motorsport more diverse, inclusive and
                    accessible.
                </p>
            </div>
        </div>

        <section class="news-section">

            <div class="news_btn">
                <h2 class="news-title">News</h2>
                <div class="buttons">
                    <button class="slider-btn" id="btn-left">←</button>
                    <button class="slider-btn" id="btn-right">→</button>

                </div>
            </div>

            <div class="news-slider">
                <div class="news-cards-wrapper" id="news-container">
                    <?php
                    $query = "SELECT title, description, photo_path, date FROM news ORDER BY date DESC";
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            $day = date("d", strtotime($row['date']));
                            $month = strtoupper(string: date("M", strtotime($row['date'])));
                            $title = htmlspecialchars($row['title']);
                            $desc = htmlspecialchars($row['description']);
                            $imgPath = htmlspecialchars($row['photo_path']);
                            ?>

                            <div class="news-card">
                                <div class="news-image"
                                    style="background-image: url('<?php echo $imgPath; ?>'); background-size: cover; background-position: center;">
                                    <div class="news-date">
                                        <span class="day"><?php echo $day; ?></span>
                                        <span class="month"><?php echo $month; ?></span>
                                    </div>
                                </div>
                                <div class="news-info">
                                    <h3 class="news-card-title"><?php echo $title; ?></h3>
                                    <p class="news-description"><?php echo $desc; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
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
                <div class="icon_con"><a href="https://twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
                </div>
                <div class="icon_con"><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <hr>

        <div class="footer_text">OUR PARTNERS</div>

        <div class="partner_cont">
            <div class="partners_row">
                <a href="https://www.tagheuer.com/int/en/" class="partner_logo"><img src="Assets/TagHeuer.svg"
                        alt="Tag Heuer"></a>
                <a href="https://www.americanexpress.com/" class="partner_logo"><img src="Assets/AmericanExpress.svg"
                        alt="American Express"></a>
                <a href="https://www.charlottetilbury.com/uk/secrets/charlotte-tilbury-f1-academy"
                    class="partner_logo"><img src="Assets/CharlotteTilbury.svg" alt="Charlotte Tilbury"></a>
                <a href="https://www.morethanequal.com/" class="partner_logo"><img src="Assets/MoreThanEqual.svg"
                        alt="More Than Equal"></a>
            </div>
            <div class="partners_row">
                <a href="https://www.morganstanley.com/" class="partner_logo"><img src="Assets/MorganStanley.svg"
                        alt="Morgan Stanley"></a>
                <a href="https://uk.puma.com/uk/en/sports/motorsport" class="partner_logo"><img src="Assets/Puma.svg"
                        alt="Puma"></a>
                <a href="https://www.teamviewer.com/en-cis/" class="partner_logo"><img src="Assets/TeamViewer.svg"
                        alt="TeamViewer"></a>
                <a href="https://uk.tommy.com/" class="partner_logo"><img src="Assets/TommyHilfiger.svg"
                        alt="Tommy Hilfiger"></a>
                <a href="https://www.pirelli.com/tyres/en-ww/motorsport/home" class="partner_logo"><img
                        src="Assets/Pirelli.svg" alt="Pirelli"></a>
            </div>
            <hr class="dec_line">
            <div class="partners_row">
                <a href="https://www.tatuus.it/en" class="partner_logo"><img src="Assets/Tatuus.svg" alt="Tatuus"></a>
                <a href="https://www.autotecnicamotori.it/" class="partner_logo"><img src="Assets/ATM.svg"
                        alt="ATM"></a>
                <a href="https://www.aramco.com/en" class="partner_logo"><img src="Assets/Aramco.svg" alt="Aramco"></a>
            </div>
        </div>
        <hr>
        <div class="footer_con">
            <img src="Assets/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
            <p>© 2025 F1 Academy Limited</p>
        </div>
    </footer>

    <script src="JS/Slider.js"></script>
</body>

</html>