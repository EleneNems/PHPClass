<?php
include '../../Includes/connect.php';

function redirectWithErrors($errors, $old)
{
    $query = http_build_query(array_merge($errors, $old));
    header("Location: ../admin_dashboard.php?page=results&$query");
    exit;
}

$event_id = intval($_POST['event_id'] ?? 0);
$type = $_POST['type'] ?? '';
$date_time = $_POST['date_time'] ?? '';

$errors = [];
$old = [
    'event_id' => $event_id,
    'type' => $type,
    'date_time' => $date_time,
];

if (!$event_id) {
    $errors['typeErr'] = 'Invalid race.';
}
if (empty($type)) {
    $errors['typeErr'] = 'Session type is required.';
}
if (empty($date_time) || !strtotime($date_time)) {
    $errors['dateErr'] = 'Valid date & time is required.';
}
if ($errors) {
    redirectWithErrors($errors, $old);
}

$sql = "SELECT start_date, end_date FROM race_events WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    $errors['typeErr'] = 'Event not found.';
    redirectWithErrors($errors, $old);
}

$session_ts = strtotime($date_time);
$start_ts = strtotime($event['start_date'] . ' 00:00:00');
$end_ts = strtotime($event['end_date'] . ' 23:59:59');

if ($session_ts < $start_ts || $session_ts > $end_ts) {
    $errors['dateErr'] = 'Session must be scheduled within the race dates.';
    redirectWithErrors($errors, $old);
}

$sql = "SELECT * FROM sessions WHERE event_id = ? AND type = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "is", $event_id, $type);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
    $errors['typeErr'] = "This session type already exists for this race.";
    redirectWithErrors($errors, $old);
}

$sql = "SELECT * FROM sessions WHERE date_time = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $date_time);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
    $errors['dateErr'] = "A session is already scheduled at this time.";
    redirectWithErrors($errors, $old);
}

$lower_type = strtolower($type);
$final_type = $type;
$session_number = 1;

if ($lower_type === 'race_1' || $lower_type === 'race_2') {
    $final_type = 'race';

    $sql = "SELECT COUNT(*) as count FROM sessions WHERE event_id = ? AND type = 'race'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $event_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $session_number = ($row['count'] >= 1) ? 2 : 1;
}

$sql = "INSERT INTO sessions (event_id, type, date_time, session_number) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "issi", $event_id, $final_type, $date_time, $session_number);
mysqli_stmt_execute($stmt);

header("Location: ../admin_dashboard.php?page=results&event_id=$event_id");
exit;
?>