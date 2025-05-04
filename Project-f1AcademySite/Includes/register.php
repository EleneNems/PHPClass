<?php
include 'connect.php';

$field_errors = [];

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $dob = trim($_POST['dob']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $consent = isset($_POST['consent']) ? 1 : 0;

    if (empty($username)) $field_errors['username'] = "Username is required.";
    if (empty($dob)) $field_errors['dob'] = "Date of birth is required.";
    if (empty($email)) $field_errors['email'] = "Email is required.";
    if (empty($password)) $field_errors['password'] = "Password is required.";
    if (!$consent) $field_errors['consent'] = "You must agree to the Privacy Policy.";

    if (!isset($field_errors['dob']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
        $dob_year = intval(substr($dob, 0, 4));
        $current_year = intval(date("Y"));
        if ($dob_year < 1920 || $dob_year > $current_year) {
            $field_errors['dob'] = "Year must be between 1920 and $current_year.";
        }
    } elseif (!isset($field_errors['dob'])) {
        $field_errors['dob'] = "Invalid date format.";
    }

    if (!isset($field_errors['password']) &&
        (!preg_match('/[A-Z]/', $password) ||
         !preg_match('/[a-z]/', $password) ||
         !preg_match('/[0-9]/', $password) ||
         strlen($password) < 8 || strlen($password) > 30)) {
        $field_errors['password'] = "Must contain uppercase, lowercase, number, and be 8–30 characters.";
    }

    if (!isset($field_errors['email'])) {
        $safe_email = mysqli_real_escape_string($conn, $email);
        $check_query = "SELECT id FROM users WHERE email = '$safe_email' LIMIT 1";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $field_errors['email'] = "An account with this email already exists.";
        }
    }

    if (empty($field_errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $safe_username = mysqli_real_escape_string($conn, $username);
        $safe_dob = mysqli_real_escape_string($conn, $dob);

        $query = "INSERT INTO users (username, date_of_birth, email, password)
                  VALUES ('$safe_username', '$safe_dob', '$safe_email', '$hashed_password')";

        if (mysqli_query($conn, $query)) {
            header("Location: SignIn.php?registered=1");
            exit();
        } else {
            $field_errors['form'] = "Database error: " . mysqli_error($conn);
        }
    }
}
?>
