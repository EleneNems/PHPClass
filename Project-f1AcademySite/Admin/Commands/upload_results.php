<?php
include '../../Includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST request received<br>";

    $session_id = intval($_POST['session_id'] ?? 0);
    echo "Session ID: $session_id<br>";

    if ($session_id <= 0) {
        die('Invalid session ID.<br>');
    }

    if (!isset($_FILES['results_file'])) {
        die('No file uploaded.<br>');
    }

    if ($_FILES['results_file']['error'] !== UPLOAD_ERR_OK) {
        die('File upload error: ' . $_FILES['results_file']['error'] . '<br>');
    }

    echo "File uploaded successfully<br>";

    $jsonData = file_get_contents($_FILES['results_file']['tmp_name']);
    echo "Raw JSON: <pre>" . htmlspecialchars($jsonData) . "</pre><br>";

    $results = json_decode($jsonData, true);
    if (!$results || !is_array($results)) {
        die('Invalid JSON format.<br>');
    }

    echo "JSON decoded successfully<br>";
    $sessionQuery = mysqli_query($conn, "SELECT type, event_id FROM sessions WHERE id = $session_id");

    if (!$sessionQuery || mysqli_num_rows($sessionQuery) === 0) {
        die('Session not found.<br>');
    }

    $session = mysqli_fetch_assoc($sessionQuery);
    $type = strtolower($session['type']);
    $event_id = $session['event_id'];

    echo "Session type: $type<br>";
    echo "Event ID: $event_id<br>";
    $escapedJson = mysqli_real_escape_string($conn, $jsonData);
    $jsonSave = mysqli_query($conn, "UPDATE sessions SET result_json = '$escapedJson' WHERE id = $session_id");

    if (!$jsonSave) {
        die('Failed to save session results: ' . mysqli_error($conn) . "<br>");
    }

    echo "JSON saved to session<br>";
    if ($type === 'race') {
        echo "Processing race results...<br>";
        $teamPoints = [];

        foreach ($results as $entry) {
            if (!isset($entry['driver_id'], $entry['points'])) {
                echo "Missing driver_id or points in entry: " . json_encode($entry) . "<br>";
                continue;
            }

            $driver_id = intval($entry['driver_id']);
            $points = floatval($entry['points']);

            echo "Updating driver ID $driver_id with $points points<br>";

            $driverUpdate = mysqli_query($conn, "
            UPDATE drivers 
            SET total_points = total_points + $points 
            WHERE id = $driver_id
        ");

            if (!$driverUpdate) {
                echo "Error updating driver $driver_id: " . mysqli_error($conn) . "<br>";
            }

            $teamRes = mysqli_query($conn, "SELECT team_id FROM drivers WHERE id = $driver_id");
            if ($teamRes && mysqli_num_rows($teamRes) > 0) {
                $teamRow = mysqli_fetch_assoc($teamRes);
                $team_id = intval($teamRow['team_id']);

                if (!isset($teamPoints[$team_id])) {
                    $teamPoints[$team_id] = 0;
                }

                $teamPoints[$team_id] += $points;
            }
        }

        foreach ($teamPoints as $team_id => $totalPoints) {
            echo "Updating team ID $team_id with $totalPoints points<br>";

            $teamUpdate = mysqli_query($conn, "
            UPDATE teams 
            SET total_points = total_points + $totalPoints 
            WHERE id = $team_id
        ");

            if (!$teamUpdate) {
                echo "Error updating team $team_id: " . mysqli_error($conn) . "<br>";
            }
        }
    }

    if (!headers_sent()) {
        header("Location: ../admin_dashboard.php?page=results&event_id=$event_id&uploadSuccess=1");
        exit();
    }
}
?>