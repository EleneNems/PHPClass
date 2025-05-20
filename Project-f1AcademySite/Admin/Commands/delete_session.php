<?php
include '../../Includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $session_id = intval($_POST['session_id'] ?? 0);

    if ($session_id > 0) {
        $sessionQuery = mysqli_query($conn, "SELECT result_json FROM sessions WHERE id = $session_id");
        if ($sessionQuery && mysqli_num_rows($sessionQuery) > 0) {
            $sessionData = mysqli_fetch_assoc($sessionQuery);
            $jsonData = $sessionData['result_json'];
            $results = json_decode($jsonData, true);

            if (is_array($results)) {
                $teamPoints = [];

                foreach ($results as $entry) {
                    if (!isset($entry['driver_id'], $entry['points'])) {
                        continue;
                    }

                    $driver_id = intval($entry['driver_id']);
                    $points = floatval($entry['points']);

                    mysqli_query($conn, "
                        UPDATE drivers
                        SET total_points = total_points - $points
                        WHERE id = $driver_id
                    ");

                    $teamResult = mysqli_query($conn, "SELECT team_id FROM drivers WHERE id = $driver_id");
                    if ($teamResult && mysqli_num_rows($teamResult) > 0) {
                        $teamRow = mysqli_fetch_assoc($teamResult);
                        $team_id = intval($teamRow['team_id']);

                        if (!isset($teamPoints[$team_id])) {
                            $teamPoints[$team_id] = 0;
                        }
                        $teamPoints[$team_id] += $points;
                    }
                }

                foreach ($teamPoints as $team_id => $pointsToSubtract) {
                    mysqli_query($conn, "
                        UPDATE teams
                        SET total_points = total_points - $pointsToSubtract
                        WHERE id = $team_id
                    ");
                }
            }
        }

        $stmt = mysqli_prepare($conn, "DELETE FROM sessions WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $session_id);
        mysqli_stmt_execute($stmt);
    }
}

header("Location: ../admin_dashboard.php?page=results");
exit;