<?php
session_start();
include '../../Includes/connect.php';


$userId = intval($_POST['user_id']);


$update = mysqli_prepare($conn, "UPDATE users SET role = 'user' WHERE id = ?");
mysqli_stmt_bind_param($update, 'i', $userId);
mysqli_stmt_execute($update);

header("Location: ../admin_dashboard.php?page=users");
exit;
