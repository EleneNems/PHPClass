<?php
include "conn.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <style>
        .container {
            width: 200px;
            height: 200px;
            background-color: lightseagreen;
            text-align: center;
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">
            <input type="text" name="email">
            <br><br>
            <input type="password" name="pass">
            <br><br>
            <button name="sign">Sign in</button>
            <br><br>
            <a href="crud.php">Admin</a>
            <?php
            if (isset($_POST['sign'])) {
                $email = $_POST['email'];
                $pass = $_POST['pass'];

                $result = mysqli_query($conn, "select * from users where email='$email' AND password='$pass'");
                if (mysqli_num_rows($result) != 0) {
                    echo "You are logged in";
                    $_SESSION['email'] = $email;
                } else {
                    echo "Invalid email or password";
                }
            }
            ?>
        </form>

    </div>
</body>

</html>