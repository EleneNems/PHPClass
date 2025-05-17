<?php
include '../../Includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $nationality = trim($_POST['nationality'] ?? '');
    $support = trim($_POST['support'] ?? '');
    $racing_number = trim($_POST['racing_number'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $team_id = $_POST['team_id'] ?? '';

    $firstnameErr = $lastnameErr = $nationalityErr = $numberErr = $dobErr = $mainErr = $coverErr = "";
    $hasError = false;

    if ($firstname === '') {
        $firstnameErr = "First name is required.";
        $hasError = true;
    }

    if ($lastname === '') {
        $lastnameErr = "Last name is required.";
        $hasError = true;
    }

    if ($nationality === '') {
        $nationalityErr = "Nationality is required.";
        $hasError = true;
    }

    if ($racing_number === '' || !is_numeric($racing_number)) {
        $numberErr = "Racing number is required and must be numeric.";
        $hasError = true;
    } elseif ((int) $racing_number < 1 || (int) $racing_number >= 100) {
        $numberErr = "Racing number must be between 1 and 99.";
        $hasError = true;
    }

    if ($dob === '') {
        $dobErr = "Date of birth is required.";
        $hasError = true;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!isset($_FILES['main_pic']) || $_FILES['main_pic']['error'] !== 0) {
        $mainErr = "Main photo is required.";
        $hasError = true;
    } else {
        $main_ext = strtolower(pathinfo($_FILES['main_pic']['name'], PATHINFO_EXTENSION));
        if (!in_array($main_ext, $allowed)) {
            $mainErr = "Main photo must be an image (jpg, jpeg, png, webp).";
            $hasError = true;
        }
    }

    if (!isset($_FILES['cover_pic']) || $_FILES['cover_pic']['error'] !== 0) {
        $coverErr = "Cover photo is required.";
        $hasError = true;
    } else {
        $cover_ext = strtolower(pathinfo($_FILES['cover_pic']['name'], PATHINFO_EXTENSION));
        if (!in_array($cover_ext, $allowed)) {
            $coverErr = "Cover photo must be an image (jpg, jpeg, png, webp).";
            $hasError = true;
        }
    }

    if ($hasError) {
        $query = http_build_query([
            'firstnameErr' => $firstnameErr,
            'lastnameErr' => $lastnameErr,
            'nationalityErr' => $nationalityErr,
            'numberErr' => $numberErr,
            'dobErr' => $dobErr,
            'mainErr' => $mainErr,
            'coverErr' => $coverErr,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nationality' => $nationality,
            'support' => $support,
            'racing_number' => $racing_number,
            'dob' => $dob,
            'team_id' => $team_id
        ]);
        header("Location: ../admin_dashboard.php?page=drivers&$query");
        exit();
    }

    $filenameBase = preg_replace('/[^a-zA-Z0-9]/', '', $firstname . $lastname);
    $mainPath = "Assets/Drivers/{$filenameBase}.$main_ext";
    $coverPath = "Assets/Drivers/Cover/cover-{$filenameBase}.$cover_ext";

    move_uploaded_file($_FILES['main_pic']['tmp_name'], "../../" . $mainPath);
    move_uploaded_file($_FILES['cover_pic']['tmp_name'], "../../" . $coverPath);

    $teamValue = $team_id === '' ? 'NULL' : (int) $team_id;
    $stmt = $conn->prepare("INSERT INTO drivers 
        (firstname, lastname, nationality, support, racing_number, dob, team_id, main_pic_path, cover_pic_path)
        VALUES (?, ?, ?, ?, ?, ?, $teamValue, ?, ?)");
    $stmt->bind_param("ssssisss", $firstname, $lastname, $nationality, $support, $racing_number, $dob, $mainPath, $coverPath);
    $stmt->execute();
    $stmt->close();

    header("Location: ../admin_dashboard.php?page=drivers&success=1");
    exit();
}
