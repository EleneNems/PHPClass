<?php
include '../../Includes/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['team_id'])) {
    $teamId = intval($_POST['team_id']);

    $stmt = mysqli_prepare($conn, "SELECT logo FROM teams WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $teamId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $logoPath);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($logoPath) {
        $fullPath = "../../" . $logoPath;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    $deleteStmt = mysqli_prepare($conn, "DELETE FROM teams WHERE id = ?");
    mysqli_stmt_bind_param($deleteStmt, "i", $teamId);
    mysqli_stmt_execute($deleteStmt);
    mysqli_stmt_close($deleteStmt);

    header("Location: ../admin_dashboard.php?page=teams&deleted=1");
    exit();
} else {
    header("Location: ../admin_dashboard.php?page=teams&error=invalid_request");
    exit();
}
