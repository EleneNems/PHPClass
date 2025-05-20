<?php
include '../../Includes/connect.php';

$event_id = intval($_GET['event_id'] ?? 0);

$response = [
    'sessions' => [],
    'eventDates' => null
];

if ($event_id > 0) {
    $sql = "SELECT id, session_number, type, date_time, result_json 
            FROM sessions 
            WHERE event_id = $event_id 
            ORDER BY session_number";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['sessions'][] = $row;
    }

    $eventSql = "SELECT start_date, end_date 
                 FROM race_events 
                 WHERE id = $event_id 
                 LIMIT 1";
    $eventResult = mysqli_query($conn, $eventSql);
    if ($eventResult && mysqli_num_rows($eventResult) > 0) {
        $response['eventDates'] = mysqli_fetch_assoc($eventResult);
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
