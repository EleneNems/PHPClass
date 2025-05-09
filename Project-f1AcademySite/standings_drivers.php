<?php
include "includes/connect.php";
include "includes/layout.php";

$racesResult = mysqli_query($conn, "SELECT id, name FROM race_events ORDER BY start_date");
$races = array();
while ($row = mysqli_fetch_assoc($racesResult)) {
    $races[] = $row;
}

$driversResult = mysqli_query($conn, "SELECT id, firstname, lastname, racing_number, team_id FROM drivers");
$drivers = array();
while ($row = mysqli_fetch_assoc($driversResult)) {
    $id = $row['id'];
    $firstInitial = strtoupper(substr($row['firstname'], 0, 1));
    $nameDisplay = "<span class='number'>". $row['racing_number']."</span>" . " - " . $firstInitial . ". " . $row['lastname'];
    $drivers[$id] = array(
        'display' => $nameDisplay,
        'total_points' => 0,
        'per_race' => array()
    );
}

$sessionsResult = mysqli_query($conn, "SELECT event_id, session_number, type, result_json FROM sessions WHERE type = 'Race'");
while ($row = mysqli_fetch_assoc($sessionsResult)) {
    $results = json_decode($row['result_json'], true);
    if (!$results)
        continue;

    foreach ($results as $entry) {
        $driverId = $entry['driver_id'];
        $points = isset($entry['points']) ? $entry['points'] : 0;

        if (!isset($drivers[$driverId]))
            continue;

        $drivers[$driverId]['total_points'] += $points;

        $raceId = $row['event_id'];
        $sessionKey = 'R' . $row['session_number'];

        if (!isset($drivers[$driverId]['per_race'][$raceId])) {
            $drivers[$driverId]['per_race'][$raceId] = array();
        }

        if (!isset($drivers[$driverId]['per_race'][$raceId][$sessionKey])) {
            $drivers[$driverId]['per_race'][$raceId][$sessionKey] = 0;
        }

        $drivers[$driverId]['per_race'][$raceId][$sessionKey] += $points;
    }
}

usort($drivers, function ($a, $b) {
    return $b['total_points'] - $a['total_points'];
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Academy - Driver Standings</title>
    <link rel="stylesheet" href="Css/layout.css?v=1">
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
        <a href="SignIn.php">
            <div class="sign_in">
                <i class="fas fa-user"></i> Sign In
            </div>
        </a>
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
                    <div class="tab">Teams</div>
                </a>
                <a href="standings_drivers.php" class="tab-link">
                    <div class="tab active">Drivers</div>
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th class="blank"></th>
                        <th class="blank"></th>
                        <?php foreach ($races as $race) { ?>
                            <th class="blank" colspan="2"><?= $race['name'] ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>Driver</th>
                        <th>T. Points</th>
                        <?php foreach ($races as $race) { ?>
                            <th>R1</th>
                            <th>R2</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($drivers as $driver) { ?>
                        <tr>
                            <td class="format"><?= $driver['display'] ?></td>
                            <td><?= $driver['total_points'] ?></td>
                            <?php foreach ($races as $race) {
                                $racePoints = isset($driver['per_race'][$race['id']]) ? $driver['per_race'][$race['id']] : array();
                                $r1 = isset($racePoints['R1']) ? $racePoints['R1'] : '-';
                                $r2 = isset($racePoints['R2']) ? $racePoints['R2'] : '-';
                                ?>
                                <td><?= $r1 ?></td>
                                <td><?= $r2 ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
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
</body>

</html>