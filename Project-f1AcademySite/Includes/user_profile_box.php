<?php
session_start();
$isLoggedIn = isset($_SESSION['email']);

$isUser = $isLoggedIn && $_SESSION['role'] === 'user';
$isAdmin = $isLoggedIn && $_SESSION['role'] === 'admin';

if ($isLoggedIn) {
    include 'connect.php';

    $email = $_SESSION['email'];
    $sql = "SELECT firstname, lastname FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $fullName = "User";
    if ($row = mysqli_fetch_assoc($result)) {
        $firstInitial = strtoupper(substr($row['firstname'], 0, 1));
        $lastName = $row['lastname'];
        $fullName = $firstInitial . ". " . $lastName;
    }

    mysqli_stmt_close($stmt);
}
?>