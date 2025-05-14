<?php
include "../../Includes/connect.php";

$userId = intval($_POST['user_id']);

$stmt = mysqli_prepare($conn, "UPDATE users SET role = 'admin' WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $userId);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['message'] = "User promoted successfully.";
} else {
    $_SESSION['message'] = "Error promoting user.";
}

mysqli_stmt_close($stmt);
header("Location: ../admin_dashboard.php?page=users");
exit;
?>
