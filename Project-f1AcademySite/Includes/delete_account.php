<?php
session_start();
include 'connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];
$passwordInput = $_POST['password'] ?? '';

if (empty($passwordInput)) {
    echo json_encode(['success' => false, 'error' => 'Password is required.']);
    exit;
}

$query = "SELECT password FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $hashedPassword = $row['password'];

    if (password_verify($passwordInput, $hashedPassword)) {
        $deleteStmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
        if (!$deleteStmt) {
            echo json_encode(['success' => false, 'error' => 'Delete prepare failed: ' . mysqli_error($conn)]);
            exit;
        }

        mysqli_stmt_bind_param($deleteStmt, "i", $userId);
        mysqli_stmt_execute($deleteStmt);

        session_destroy();
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Incorrect password.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'User not found.']);
}