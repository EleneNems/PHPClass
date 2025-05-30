<?php
include "login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="front/style.css">
</head>
<body>
    <header>Header
        <a href="cms/index.php">Admin</a>
        <form action="" method="post">
            <input type="text" name="user">
            <br>
            <input type="password" name="pass">
            <br>
            <button name='login'>Log in</button>
        </form>
    </header>
    <main>Main</main>
    <footer>Footer</footer>
</body>
</html>