<?php
include "includes/connect.php";
include "includes/layout.php";
include "includes/user_profile_box.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Academy</title>
    <link rel="stylesheet" href="Css/layout.css?v=8">
    <link rel="stylesheet" href="Css/HomePage.css?v=8">
</head>

<body>
    <div class="intro-animation" id="introAnimation">
        <img src="Assets/Layout/F1AcademyLogo.svg" alt="F1 Academy Logo" class="logo-drop" />
        <img src="Assets/Layout/F1Car.png" alt="F1 Car" class="f1-car" />
        <img src="Assets/Layout/Annoyed-bubble.png" class="annoyed-bubble" />
    </div>

    <header>
        <a href="index.php">
            <img src="Assets/Layout/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
        </a>

        <div class="list">
            <ul>
                <li><a href="teams.php">Teams</a></li>
                <li><a href="drivers.php">Drivers</a></li>
                <li><a href="standings_team.php">Standings</a></li>
                <li><a href="schedule.php">Schedule</a></li>
            </ul>
        </div>

        <?php if ($isLoggedIn) { ?>
            <div class="profile" onclick="toggleLogout()">
                <p class="username"><?= $fullName ?></p>

                <div class="logout-menu" id="logoutMenu">
                    <?php if ($isAdmin) { ?>
                        <a href="Admin/admin_dashboard.php">View as Admin</a>
                    <?php } elseif ($isAdmin) { ?>
                        <a href="../index.php">View as User</a>
                    <?php } ?>
                    <a href="post_story.php">Post a Story</a>
                    <a href="my_stories.php">My Stories</a>
                    <a href="includes/logout.php">Logout</a>
                    <a href="#" onclick="openDeleteConfirm(event)">Delete Account</a>
                </div>

                <div id="confirmDeleteModal" class="modal" style="display:none;">
                    <div class="modal-content">
                        <h3>Delete Account</h3>
                        <p>Are you sure you want to delete your account?</p>
                        <div class="modal-actions">
                            <button onclick="proceedToPassword()">Yes</button>
                            <button onclick="closeConfirmModal()">Cancel</button>
                        </div>
                    </div>
                </div>

                <div id="passwordModal" class="modal" style="display:none;">
                    <div class="modal-content">
                        <h3>Enter Your Password</h3>
                        <input type="password" id="deletePassword" placeholder="Password" required>
                        <div class="modal-actions">
                            <button type="button" onclick="submitAccountDeletion()">Delete</button>
                            <button onclick="closePasswordModal()">Cancel</button>
                        </div>
                        <p id="deleteError" style="color:red; display:none;">Incorrect password. Try again.</p>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <a href="SignIn.php">
                <div class="sign_in">
                    <i class="fas fa-user"></i> Sign In
                </div>
            </a>
        <?php } ?>

        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </header>

    <main>
        <div class="home-section">
            <img src="Assets/Layout/HomePic.png" alt="F1 academy picture" class="home-bg">
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
                    $query = "SELECT id, title, description, photo_path, date FROM news ORDER BY date DESC";
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $day = date("d", strtotime($row['date']));
                            $month = strtoupper(date("M", strtotime($row['date'])));
                            $newsId = $row['id'];
                            ?>

                            <a href="news.php?id=<?= $newsId ?>" class="news-card-link">
                                <div class="news-card">
                                    <div class="news-image"
                                        style="background-image: url('<?= $row['photo_path'] ?>'); background-size: cover; background-position: center;">
                                        <div class="news-date">
                                            <span class="day"><?= $day ?></span>
                                            <span class="month"><?= $month ?></span>
                                        </div>
                                    </div>
                                    <div class="news-info">
                                        <h3 class="news-card-title"><?= $row['title'] ?></h3>
                                        <p class="news-description"><?= $row['description'] ?></p>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="stories-section">
            <h2 class="section-title">Our Community</h2>

            <div class="stories-inner">
                <?php
                $mainQuery = "SELECT s.id, s.title, s.story_pic_path, s.type, u.firstname, u.lastname FROM stories s JOIN users u ON s.author_id = u.id WHERE s.type IN ('main-story') ORDER BY s.created_at DESC LIMIT 1";
                $mainResult = mysqli_query($conn, $mainQuery);

                if ($mainResult && mysqli_num_rows($mainResult) > 0) {
                    $mainStory = mysqli_fetch_assoc($mainResult);
                    $fullname = $mainStory['firstname'] . ' ' . $mainStory['lastname'];
                    ?>
                    <a href="story.php?id=<?= $mainStory['id'] ?>" class="main-story-container">
                        <div class="scrollable-content">
                            <div class="story-image"
                                style="background-image: url('<?= $mainStory['story_pic_path'] ?>'); background-size: cover; background-position: center;">
                            </div>
                            <div class="story-info">
                                <span class="story-label"><?= $mainStory['type'] ?></span>
                                <h3 class="story-title"><?= $mainStory['title'] ?></h3>
                                <p class="story-desc">by: <?= $fullname ?></p>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>

                <div class="story-list">
                    <?php
                    $otherQuery = "SELECT s.id, s.title, s.story_pic_path, s.type, u.firstname, u.lastname 
                           FROM stories s 
                           JOIN users u ON s.author_id = u.id 
                           WHERE s.type IN ('Story', 'Interview', 'report') 
                           ORDER BY s.created_at DESC LIMIT 6";

                    $otherResult = mysqli_query($conn, $otherQuery);

                    if ($otherResult && mysqli_num_rows($otherResult) > 0) {
                        while ($story = mysqli_fetch_assoc($otherResult)) {
                            $fullname = $story['firstname'] . ' ' . $story['lastname'];
                            ?>
                            <a href="story.php?id=<?= $story['id'] ?>" class="story-card">
                                <div class="story-image"
                                    style="background-image: url('<?= $story['story_pic_path'] ?>'); background-size: cover; background-position: center;">
                                </div>
                                <div class="story-info">
                                    <span class="story-label"><?= $story['type'] ?></span>
                                    <h3 class="story-title"><?= $story['title'] ?></h3>
                                    <p class="story-desc">by: <?= $fullname ?></p>
                                </div>
                            </a>
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
                <a href="https://www.tagheuer.com/int/en/" class="partner_logo"><img src="Assets/Layout/TagHeuer.svg"
                        alt="Tag Heuer"></a>
                <a href="https://www.americanexpress.com/" class="partner_logo"><img
                        src="Assets/Layout/AmericanExpress.svg" alt="American Express"></a>
                <a href="https://www.charlottetilbury.com/uk/secrets/charlotte-tilbury-f1-academy"
                    class="partner_logo"><img src="Assets/Layout/CharlotteTilbury.svg" alt="Charlotte Tilbury"></a>
                <a href="https://www.morethanequal.com/" class="partner_logo"><img src="Assets/Layout/MoreThanEqual.svg"
                        alt="More Than Equal"></a>
            </div>
            <div class="partners_row">
                <a href="https://www.morganstanley.com/" class="partner_logo"><img src="Assets/Layout/MorganStanley.svg"
                        alt="Morgan Stanley"></a>
                <a href="https://uk.puma.com/uk/en/sports/motorsport" class="partner_logo"><img
                        src="Assets/Layout/Puma.svg" alt="Puma"></a>
                <a href="https://www.teamviewer.com/en-cis/" class="partner_logo"><img
                        src="Assets/Layout/TeamViewer.svg" alt="TeamViewer"></a>
                <a href="https://uk.tommy.com/" class="partner_logo"><img src="Assets/Layout/TommyHilfiger.svg"
                        alt="Tommy Hilfiger"></a>
                <a href="https://www.pirelli.com/tyres/en-ww/motorsport/home" class="partner_logo"><img
                        src="Assets/Layout/Pirelli.svg" alt="Pirelli"></a>
            </div>
            <hr class="dec_line">
            <div class="partners_row">
                <a href="https://www.tatuus.it/en" class="partner_logo"><img src="Assets/Layout/Tatuus.svg"
                        alt="Tatuus"></a>
                <a href="https://www.autotecnicamotori.it/" class="partner_logo"><img src="Assets/Layout/ATM.svg"
                        alt="ATM"></a>
                <a href="https://www.aramco.com/en" class="partner_logo"><img src="Assets/Layout/Aramco.svg"
                        alt="Aramco"></a>
            </div>
        </div>
        <hr>
        <div class="footer_con">
            <img src="Assets/Layout/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
            <p>© 2025 F1 Academy Limited</p>
        </div>
    </footer>

    <script src="JS/Slider&Menu.js?v=1"></script>
    <script src="JS/Delete_account.js?v=2"></script>
    <script src="JS/Intro_animation.js?v=3"></script>
</body>

</html>