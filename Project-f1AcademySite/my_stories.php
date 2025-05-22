<?php
include "includes/connect.php";
include "includes/layout.php";
include "includes/user_profile_box.php";
include "includes/post_story.php";

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT id, title, type, story_pic_path FROM stories WHERE author_id = $user_id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Stories</title>
    <link rel="stylesheet" href="Css/layout.css?v=2">
    <link rel="stylesheet" href="Css/my_stories.css?v=6">
</head>

<body>

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
        <div class="container">
            <h1>My Stories</h1>
            <hr>
            <?php if (isset($_GET['deleted'])) { ?>
                <p style="color: green;">Story deleted successfully.</p>
            <?php } ?>

            <?php if (mysqli_num_rows($result) > 0) { ?>
                ` <?php $delay = 0; ?>
                <div class="story-list">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="story-item fade-slide" style="animation-delay: <?= ($delay++ * 0.1) ?>s;">
                            <img src="<?= $row['story_pic_path'] ?>" alt="Story Image">
                            <div class="story-info">
                                <h3><?= $row['title'] ?></h3>
                                <p>Type: <span><?= $row['type'] ?></span> </p>
                                <a href="story.php?id=<?= $row['id'] ?>">View Story</a>
                                <a href="#" class="delete-btn" data-story-id="<?= $row['id'] ?>">Delete Story</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <p>You haven't posted any stories yet.</p>
            <?php } ?>
        </div>
    </main>

    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete this story?</p>
            <div class="modal-actions">
                <button id="confirmDelete">Delete</button>
                <button onclick="closeDeleteModal()">Cancel</button>
            </div>
        </div>
    </div>

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
    <script src="JS/Delete_account.js?v=3"></script>
</body>

</html>