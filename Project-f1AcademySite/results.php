<?php
include "includes/connect.php";
include "includes/layout.php";
include "includes/user_profile_box.php";


$raceId = intval($_GET['race_id']);

$raceQuery = mysqli_prepare($conn, "SELECT name, cover_path FROM race_events WHERE id = ?");
mysqli_stmt_bind_param($raceQuery, "i", $raceId);
mysqli_stmt_execute($raceQuery);
$raceResult = mysqli_stmt_get_result($raceQuery);
$raceInfo = mysqli_fetch_assoc($raceResult);

$raceName = $raceInfo['name'];
$coverPath = $raceInfo['cover_path'];

$sessionQuery = mysqli_prepare($conn, "SELECT id, type, session_number, result_json FROM sessions WHERE event_id = ? ORDER BY FIELD(type, 'Practice', 'Qualifying', 'Race'), session_number");
mysqli_stmt_bind_param($sessionQuery, "i", $raceId);
mysqli_stmt_execute($sessionQuery);
$sessions = mysqli_stmt_get_result($sessionQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Css/layout.css?v=2">
    <link rel="stylesheet" href="Css/result.css?v=1">
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
        <div class="cover-section">
            <img src="<?= $coverPath ?>" alt="Race cover photo" class="result-bg">
            <div class="result-content">
                <h1><?= $raceName ?></h1>
            </div>
        </div>

        <?php
        $raceQuery = "SELECT name, location, start_date, end_date, circuit_path FROM race_events WHERE id = $raceId";
        $raceResult = mysqli_query($conn, $raceQuery);
        $raceInfo = mysqli_fetch_assoc($raceResult);

        ?>

        <div class="container_race">
            <div class="race-left">
                <img src="<?= $raceInfo['circuit_path'] ?>" alt="Circuit layout">
            </div>
            <div class="race-right">
                <h2 class="race-name"><?= $raceInfo['name'] ?></h2>
                <p class="race-location"><?= $raceInfo['location'] ?></p>
                <p class="race-date">Start: <?= date('F j, Y', strtotime($raceInfo['start_date'])) ?></p>
                <p class="race-date">End: <?= date('F j, Y', strtotime($raceInfo['end_date'])) ?></p>
            </div>
        </div>

        <div class="results-container">
            <?php if ($sessions->num_rows > 0) { ?>
                <?php while ($session = mysqli_fetch_assoc($sessions)) {
                    $sessionType = $session['type'];
                    $results = json_decode($session['result_json'], true); ?>

                    <div class="session-box">
                        <div class="session-header" onclick="toggleSession(this)">
                            <span><?= ($sessionType === 'Race' ? 'Race ' . $session['session_number'] : $sessionType) ?></span>
                            <span class="arrow">▼</span>
                        </div>
                        <div class="session-results">
                            <?php
                            usort($results, function ($a, $b) {
                                return $a['position'] - $b['position'];
                            });
                            ?>
                            <div class="table_container">
                                <table class="result-table">
                                    <thead>
                                        <tr>
                                            <th>Pos</th>
                                            <th>Driver/Number & Team</th>
                                            <th><?= ($sessionType === 'Race') ? 'Points' : 'Lap Time' ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($results as $entry) { ?>
                                            <?php
                                            $driverId = (int) $entry['driver_id'];
                                            $position = $entry['position'];
                                            $points = isset($entry['points']) ? $entry['points'] : 0;

                                            $driverQuery = "SELECT firstname, lastname, racing_number, team_id FROM drivers WHERE id = $driverId";
                                            $driverRes = mysqli_query($conn, $driverQuery);
                                            $driverData = mysqli_fetch_assoc($driverRes);

                                            $teamQuery = "SELECT name FROM teams WHERE id = " . (int) $driverData['team_id'];
                                            $teamRes = mysqli_query($conn, $teamQuery);
                                            $teamData = mysqli_fetch_assoc($teamRes);

                                            $driverName = "#" . $driverData['racing_number'] . " " . $driverData['firstname'] . " " . $driverData['lastname'];
                                            $teamName = $teamData['name'];
                                            ?>
                                            <tr>
                                                <td><?= $position ?></td>
                                                <td>
                                                    <div class="driver-info">
                                                        <div>
                                                            <strong>
                                                                <span><?= "#" . $driverData['racing_number'] ?></span>
                                                                <?= $driverData['firstname'] . ' ' . $driverData['lastname'] ?>
                                                            </strong><br>
                                                            <?= $teamName ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= ($sessionType === 'Race')
                                                        ? $points
                                                        : (isset($entry['lap_time']) ? htmlspecialchars($entry['lap_time']) : 'N/A') ?>
                                                </td>
                                            </tr>
                                            <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php
            } else { ?>
                <div class="session-box">
                    <div class="session-header">COMING SOON</div>
                </div>
                <?php
            } ?>
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
    <script src="JS/ResultPopUp.js"></script>
    <script src="JS/Delete_account.js?v=2"></script>
</body>

</html>