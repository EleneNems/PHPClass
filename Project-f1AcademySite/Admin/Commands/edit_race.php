<?php
include '../../Includes/connect.php';

function redirectWithErrors($errors, $oldInputs) {
    $query = http_build_query(array_merge($oldInputs, $errors));
    header("Location: ../admin_dashboard.php?page=races&$query");
    exit;
}

$errors = [];
$oldInputs = [];

$race_id = intval($_POST['race_id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$location = trim($_POST['location'] ?? '');
$start_date = $_POST['start_date'] ?? '';

$oldInputs = [
    'edit_id' => $race_id,
    'name' => $name,
    'location' => $location,
    'start_date' => $start_date
];

if ($name === '') {
    $errors['nameErr'] = 'Race name is required.';
}
if ($location === '') {
    $errors['locationErr'] = 'Location is required.';
}
if ($start_date === '') {
    $errors['startErr'] = 'Start date is required.';
} elseif (!strtotime($start_date)) {
    $errors['startErr'] = 'Start date is invalid.';
}

if (!empty($errors)) {
    redirectWithErrors($errors, $oldInputs);
}

$start_dt = new DateTime($start_date);
$start_dt->modify('+2 days');
$end_date = $start_dt->format('Y-m-d');

$sql = "SELECT cover_path, circuit_path FROM race_events WHERE id = $race_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 0) {
    die("Race not found.");
}
$row = mysqli_fetch_assoc($result);
$cover_path = $row['cover_path'];
$circuit_path = $row['circuit_path'];

$allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];

if (!empty($_FILES['cover_image']['name'])) {
    $cover_ext = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
    if (!in_array($cover_ext, $allowed_exts)) {
        $errors['coverErr'] = 'Invalid cover image format.';
    } else {
        move_uploaded_file($_FILES['cover_image']['tmp_name'], "../../".$cover_path);
    }
}

if (!empty($_FILES['circuit_image']['name'])) {
    $circuit_ext = strtolower(pathinfo($_FILES['circuit_image']['name'], PATHINFO_EXTENSION));
    if (!in_array($circuit_ext, $allowed_exts)) {
        $errors['circuitErr'] = 'Invalid circuit image format.';
    } else {
        move_uploaded_file($_FILES['circuit_image']['tmp_name'], "../../".$circuit_path);
    }
}

if (!empty($errors)) {
    redirectWithErrors($errors, $oldInputs);
}

$update_sql = "UPDATE race_events SET name = ?, location = ?, start_date = ?, end_date = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $update_sql);
mysqli_stmt_bind_param($stmt, "ssssi", $name, $location, $start_date, $end_date, $race_id);
mysqli_stmt_execute($stmt);

header("Location: ../admin_dashboard.php?page=races");
exit;
?>
