<?php
include '../../Includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['team_name']);
    $hasError = false;
    $nameErr = "";
    $logoErr = "";

    if (empty($name)) {
        $nameErr = "Team name is required.";
        $hasError = true;
    } elseif (strlen($name) < 10) {
        $nameErr = "Team name must be at least 10 characters.";
        $hasError = true;
    } else {
        $checkStmt = mysqli_prepare($conn, "SELECT id FROM teams WHERE LOWER(name) = LOWER(?)");
        mysqli_stmt_bind_param($checkStmt, "s", $name);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);
        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $nameErr = "A team with this name already exists.";
            $hasError = true;
        }
        mysqli_stmt_close($checkStmt);
    }

    if (!isset($_FILES['team_logo']) || $_FILES['team_logo']['error'] !== 0) {
        $logoErr = "Team logo is required.";
        $hasError = true;
    } else {
        $ext = strtolower(pathinfo($_FILES['team_logo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($ext, $allowed)) {
            $logoErr = "Logo must be an image (jpg, jpeg, png, webp).";
            $hasError = true;
        }
    }

    if ($hasError) {
        $redirectUrl = "../admin_dashboard.php?page=teams&"
            . "nameErr=" . urlencode($nameErr)
            . "&logoErr=" . urlencode($logoErr)
            . "&oldName=" . urlencode($name);
        header("Location: $redirectUrl");
        exit();
    }

    $cleanName = preg_replace("/[^a-zA-Z0-9]/", "", $name);
    $fileName = $cleanName . "." . $ext;
    $uploadPath = "../../Assets/Teams/" . $fileName;

    if (!move_uploaded_file($_FILES['team_logo']['tmp_name'], $uploadPath)) {
        header("Location: ../admin_dashboard.php?page=teams&logoErr=" . urlencode("Failed to upload logo."));
        exit();
    }

    $relativePath = "Assets/Teams/" . $fileName;
    $stmt = mysqli_prepare($conn, "INSERT INTO teams (name, logo) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $name, $relativePath);
    mysqli_stmt_execute($stmt);

    header("Location: ../admin_dashboard.php?page=teams&success=1");
    exit();
}
