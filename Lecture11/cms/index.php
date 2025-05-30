<?php
session_start();

if(!isset($_SESSION['mail'])){
    header("Location: ../f.php");
}

include_once "includes/connect.php";
if (isset($_GET['log']) && $_GET['log'] == 'out') {
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ../f.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="front/style.css">
</head>
<body>
    <header>
        <a href="?log=out">Log out</a>
    </header>
    <main>
        <nav>
            <ul>
                <li><a href="index.php">სტატისტიკები</a></li>
                <li><a href="?nav=role">როლების მართვა</a></li>
                <li><a href="?nav=user">მომხმარებლის მართვა</a></li>
                <li><a href="?nav=hotel">სასტუმროების მართვა</a></li>
                <li><a href="?">ოთახების მართვა</a></li>
            </ul>
        </nav>
        <div class="content">
            <?php
                if(isset($_GET['nav']) && $_GET['nav']=="role"){
                    include "includes/roles/roles.php";
                }else{

                }
            ?>
        </div>
    </main>
    <footer></footer>
</body>
</html>