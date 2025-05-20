<?php
include '../../Includes/connect.php';

function redirectWithErrors($errors, $oldInputs) {
    $query = http_build_query(array_merge($oldInputs, $errors));
    header("Location: ../admin_dashboard.php?page=races&$query");
    exit;
}

$errors = [];
$oldInputs = [];

$name = trim($_POST['name'] ?? '');
$location = trim($_POST['location'] ?? '');
$start_date = $_POST['start_date'] ?? '';

$oldInputs['name'] = $name;
$oldInputs['location'] = $location;
$oldInputs['start_date'] = $start_date;

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
} else {
    $today = date('Y-m-d');
    if ($start_date < $today) {
        $errors['startErr'] = 'Start date must be today or in the future.';
    }
}

if (!isset($errors['startErr'])) {
    $end_date = date('Y-m-d', strtotime($start_date . ' +2 days'));
} else {
    $end_date = '';
}

$cover = $_FILES['cover_image'] ?? null;
if (!$cover || $cover['error'] !== UPLOAD_ERR_OK) {
    $errors['coverErr'] = 'Cover image is required.';
}

$circuit = $_FILES['circuit_image'] ?? null;
if (!$circuit || $circuit['error'] !== UPLOAD_ERR_OK) {
    $errors['circuitErr'] = 'Circuit image is required.';
}

$allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];

if ($cover && $cover['error'] === UPLOAD_ERR_OK) {
    $cover_ext = strtolower(pathinfo($cover['name'], PATHINFO_EXTENSION));
    if (!in_array($cover_ext, $allowed_exts)) {
        $errors['coverErr'] = 'Invalid cover image format.';
    }
} else {
    $cover_ext = '';
}

if ($circuit && $circuit['error'] === UPLOAD_ERR_OK) {
    $circuit_ext = strtolower(pathinfo($circuit['name'], PATHINFO_EXTENSION));
    if (!in_array($circuit_ext, $allowed_exts)) {
        $errors['circuitErr'] = 'Invalid circuit image format.';
    }
} else {
    $circuit_ext = '';
}

if (!empty($errors)) {
    redirectWithErrors($errors, $oldInputs);
}

$cover_filename = 'Assets/Races/Cover/' . strtolower(str_replace(' ', '', $name)) . '.' . $cover_ext;
$circuit_filename = 'Assets/Races/' . strtolower(explode(' ', $name)[0]) . '.' . $circuit_ext;

if (!is_dir('../../Assets/Races/Cover')) mkdir('../../Assets/Races/Cover', 0777, true);
if (!is_dir('../../Assets/Races')) mkdir('../../Assets/Races', 0777, true);

move_uploaded_file($cover['tmp_name'], "../../$cover_filename");
move_uploaded_file($circuit['tmp_name'], "../../$circuit_filename");

$stmt = $conn->prepare("INSERT INTO race_events (name, location, cover_path, circuit_path, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $location, $cover_filename, $circuit_filename, $start_date, $end_date);
$stmt->execute();

header("Location: ../admin_dashboard.php?page=races");
exit;
?>