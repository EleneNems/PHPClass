<?php
include "connect.php";

$message = "";

if (isset($_POST['sign-in-btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id, password, role FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        $role = $row['role'];
        $userId = $row['id'];

        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $userId; 

            if ($role === 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: ./index.php");
                exit();
            }

        } else {
            $message = "❌ Incorrect password!";
        }
    } else {
        $message = "❌ Email not found!";
    }
    mysqli_stmt_close($stmt);
}
?>