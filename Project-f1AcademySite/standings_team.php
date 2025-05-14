<?php
include "includes/connect.php";
include "includes/layout.php";
include "includes/user_profile_box.php";

$racesResult = mysqli_query($conn, "SELECT id, name FROM race_events ORDER BY start_date");
$races = array();
while ($row = mysqli_fetch_assoc($racesResult)) {
    $races[] = $row;
}

$teamsResult = mysqli_query($conn, "SELECT id, name FROM teams ORDER BY name");
$teams = array();
while ($row = mysqli_fetch_assoc($teamsResult)) {
    $teams[$row['id']] = array(
        'name' => $row['name'],
        'total_points' => 0,
        'per_race' => array()
    );
}

$driversResult = mysqli_query($conn, "SELECT id, team_id FROM drivers");
$driverTeamMap = array();
while ($row = mysqli_fetch_assoc($driversResult)) {
    $driverTeamMap[$row['id']] = $row['team_id'];
}

$sessionsResult = mysqli_query($conn, "SELECT event_id, session_number, type, result_json FROM sessions WHERE type = 'Race'");
while ($row = mysqli_fetch_assoc($sessionsResult)) {
    $results = json_decode($row['result_json'], true);
    if (!$results)
        continue;

    foreach ($results as $entry) {
        $driverId = $entry['driver_id'];
        $points = isset($entry['points']) ? $entry['points'] : 0;

        if (!isset($driverTeamMap[$driverId]))
            continue;

        $teamId = $driverTeamMap[$driverId];
        $teams[$teamId]['total_points'] += $points;

        $raceId = $row['event_id'];
        $sessionKey = 'R' . $row['session_number'];

        if (!isset($teams[$teamId]['per_race'][$raceId])) {
            $teams[$teamId]['per_race'][$raceId] = array();
        }

        if (!isset($teams[$teamId]['per_race'][$raceId][$sessionKey])) {
            $teams[$teamId]['per_race'][$raceId][$sessionKey] = 0;
        }

        $teams[$teamId]['per_race'][$raceId][$sessionKey] += $points;
    }
}

usort($teams, function ($a, $b) {
    return $b['total_points'] - $a['total_points'];
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Academy-Standings</title>
    <link rel="stylesheet" href="Css/layout.css?v=2">
    <link rel="stylesheet" href="Css/standings.css?v=1">
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
        <div class="standings-container">
            <h1>F1 Academy Standings</h1>
            <hr>
            <div class="tabs">
                <a href="standings_team.php" class="tab-link">
                    <div class="tab active">Teams</div>
                </a>
                <a href="standings_drivers.php" class="tab-link">
                    <div class="tab">Drivers</div>
                </a>
            </div>


            <table>
                <thead>
                    <tr>
                        <th class="blank"></th>
                        <th class="blank"></th>
                        <?php foreach ($races as $race) { ?>
                            <th class="blank" colspan="2"><?= $race['name'] ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <th>Teams</th>
                        <th>T. Points</th>
                        <?php foreach ($races as $race) { ?>
                            <th>R1</th>
                            <th>R2</th>
                            <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teams as $team) { ?>
                        <tr>
                            <td><?= $team['name'] ?></td>
                            <td><?= $team['total_points'] ?></td>
                            <?php foreach ($races as $race) { ?>
                                <?php
                                $racePoints = isset($team['per_race'][$race['id']]) ? $team['per_race'][$race['id']] : array();
                                $r1 = isset($racePoints['R1']) ? $racePoints['R1'] : '-';
                                $r2 = isset($racePoints['R2']) ? $racePoints['R2'] : '-';
                                ?>
                                <td><?= $r1 ?></td>
                                <td><?= $r2; ?></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
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
    <script src="JS/Delete_account.js"></script>
</body>

</html>