<?php
include '../../Includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $race_id = intval($_POST['race_id']);

    $query = mysqli_prepare($conn, "SELECT cover_path, circuit_path FROM race_events WHERE id = ?");
    mysqli_stmt_bind_param($query, "i", $race_id);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $cover_path, $circuit_path);
    mysqli_stmt_fetch($query);
    mysqli_stmt_close($query);

    $query = mysqli_prepare($conn, "DELETE FROM race_events WHERE id = ?");
    mysqli_stmt_bind_param($query, "i", $race_id);
    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);

    if (!empty($cover_path) && file_exists("../../$cover_path")) {
        unlink("../../$cover_path");
    }
    if (!empty($circuit_path) && file_exists("../../$circuit_path")) {
        unlink("../../$circuit_path");
    }

    header("Location: ../admin_dashboard.php?page=races");
    exit;
}
?>