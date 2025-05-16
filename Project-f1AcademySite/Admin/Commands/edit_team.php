<?php
include '../../Includes/connect.php';

$id = intval($_POST['team_id']);
$name = trim($_POST['team_name']);

$errors = [];

if (strlen($name) < 10) {
    $errors[] = "Team name must be at least 10 characters.";
}

$teamResult = mysqli_query($conn, "SELECT * FROM teams WHERE id = $id");
if (mysqli_num_rows($teamResult) === 0) {
    $errors[] = "Team not found.";
}

if (!empty($errors)) {
    header("Location: ../admin_dashboard.php?page=teams&editErr=" . urlencode(implode(" ", $errors)));
    exit();
}

$team = mysqli_fetch_assoc($teamResult);


if (isset($_FILES['team_logo']) && $_FILES['team_logo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['team_logo']['tmp_name'];
    $fileName = $_FILES['team_logo']['name'];
    $fileSize = $_FILES['team_logo']['size'];
    $fileType = $_FILES['team_logo']['type'];

    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($fileExtension, $allowedExts)) {
        $errors[] = "Logo file must be an image (jpg, jpeg, png, webp).";
    }

    if (empty($errors)) {
        $safeTeamName = preg_replace('/[^a-zA-Z0-9_-]/', '', str_replace(' ', '_', $name));
        $newFileName = "Teams_" . $safeTeamName . "." . $fileExtension;
        $uploadDir = __DIR__ . "/../../Assets/Teams/";
        $destPath = $uploadDir . $newFileName;

        if (!empty($team['logo']) && file_exists(__DIR__ . "/../../" . $team['logo'])) {
            unlink(__DIR__ . "/../../" . $team['logo']);
        }

        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            $errors[] = "There was an error moving the uploaded file.";
        } else {
            $logoPathForDB = "Assets/Teams/" . $newFileName;
        }
    }
}

if (!empty($errors)) {
    header("Location: ../admin_dashboard.php?page=teams&editErr=" . urlencode(implode(" ", $errors)));
    exit();
}

if (isset($logoPathForDB)) {
    $stmt = mysqli_prepare($conn, "UPDATE teams SET name = ?, logo = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $name, $logoPathForDB, $id);
} else {
    $stmt = mysqli_prepare($conn, "UPDATE teams SET name = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $name, $id);
}

mysqli_stmt_execute($stmt);

header("Location: ../admin_dashboard.php?page=teams&success=1");
exit();
?>
