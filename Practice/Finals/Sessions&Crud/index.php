<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            width: 300px;
            height: 280px;
            padding: 10px;
            box-sizing: border-box;
            background-color: lightskyblue;
            text-align: center;
            color: white;
            margin: auto;
        }

        .container input {
            margin: 20px;
        }

        .container p {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">
            <p>Sign in!</p>
            <br>
            <input type="text" name="email">
            <br>
            <input type="password" name="password">
            <br>
            <button name="enter">sign in</button>
            <a href="first.php">Admin</a>
        </form>

        <?php
        if (isset($_POST['enter'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "select * from users where email='$email' and password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) != 0) {
                echo "Welcome, $email!";
                $_SESSION['email']=$email;
            }
        }
        ?>
    </div>
</body>

</html>