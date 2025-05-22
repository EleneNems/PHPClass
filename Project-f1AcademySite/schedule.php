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
    <title>F1 Academy-Schedule</title>
    <link rel="stylesheet" href="Css/layout.css?v=2">
    <link rel="stylesheet" href="Css/schedule.css?v=4">
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

    <main class="calendar-section">
        <h1 class="calendar-title">F1 Academy calendar</h1>
        <hr class="calendar-line">

        <div class="calendar-grid">
            <?php
            $races_query = "SELECT id, name, start_date, end_date FROM race_events ORDER BY start_date";
            $races_result = mysqli_query($conn, $races_query);

            $i = 0;
            while ($race = mysqli_fetch_assoc($races_result)) {
                $delay = $i * 0.1;
                $raceId = $race['id'];

                $sessions_query = "SELECT session_number, result_json FROM sessions WHERE event_id = $raceId AND type = 'Race' ORDER BY session_number";
                $sessions_result = mysqli_query($conn, $sessions_query);

                $winners = [];

                while ($session = mysqli_fetch_assoc($sessions_result)) {
                    $results = json_decode($session['result_json'], true);
                    $winnerId = null;

                    foreach ($results as $entry) {
                        if ($entry['position'] === 1) {
                            $winnerId = $entry['driver_id'];
                            break;
                        }
                    }

                    if ($winnerId) {
                        $driver_query = "SELECT CONCAT(firstname, ' ', lastname) AS name, cover_pic_path FROM drivers WHERE id = $winnerId";
                        $driver_result = mysqli_query($conn, $driver_query);
                        $driver = mysqli_fetch_assoc($driver_result);

                        $winners["R" . $session['session_number']] = [
                            'name' => $driver['name'],
                            'cover_pic' => $driver['cover_pic_path']
                        ];
                    }
                }

                echo "
        <a href='results.php?race_id=$raceId' class='calendar-card' style='animation-delay: {$delay}s'>
            <span class='round-badge'>Round {$race['id']}</span>
            <p class='date'>" . date("d–d M", strtotime($race['start_date'])) . "</p>
            <hr class='white-line'>
            <h2 class='race-name'>{$race['name']}</h2>
            <p class='results-label'>Results</p>
            <div class='drivers-grid'>";

                if (isset($winners['R1'])) {
                    echo "
            <div class='driver-box'>
                <div class='driver-photo' style='background-image: url(\"{$winners['R1']['cover_pic']}\")'></div>
                <p class='driver-name'><span>R1</span>{$winners['R1']['name']}</p>
            </div>";
                } else {
                    echo "
            <div class='driver-box'>
                <div class='driver-photo' style='background-image: url(\"Assets/Drivers/TBD.webp\")'></div>
                <p class='driver-name'><span>R1</span>TBD</p>
            </div>";
                }

                if (isset($winners['R2'])) {
                    echo "
            <div class='driver-box'>
                <div class='driver-photo' style='background-image: url(\"{$winners['R2']['cover_pic']}\")'></div>
                <p class='driver-name'><span>R2</span>{$winners['R2']['name']}</p>
            </div>";
                } else {
                    echo "
            <div class='driver-box'>
                <div class='driver-photo' style='background-image: url(\"Assets/Drivers/TBD.webp\")'></div>
                <p class='driver-name'><span>R2</span>TBD</p>
            </div>";
                }

                echo "
            </div>
        </a>";

                $i++;
            }
            ?>
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

    <script src="JS/Slider&Menu.js"></script>
    <script src="JS/Delete_account.js?v=2"></script>
</body>

</html>