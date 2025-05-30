<?php
session_start();
include "connect.php";

if(!$_SESSION['email']){
    header("location: index.php");
}

if(isset($_GET['logout'])){
    unset($_SESSION['email']);
    session_destroy();
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        header,
        footer {
            width: 80%;
            height: 80px;
            padding: 10px;
            background-color: lightcyan;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-direction: row;
        }

        nav {
            box-sizing: border-box;
            width: 20%;
            padding: 10px;
            height: 400px;
            background-color: lightsteelblue;
        }

        main {
            width: 60%;
            height: 400px;
            padding: 20px;
            box-sizing: border-box;
        }

        table{
            border-collapse: collapse;
            width: 600px;
        }

        table tr td, th{
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <header>
        <?php
        if(isset($_SESSION['email'])){
        ?>
        <a href="?logout">Logout</a>
        <?php
        }
        ?>
    </header>
    <div class="container">
        <nav>
            <ul>
                <a href="?nav=hotels"><li>Hotels</li></a>
                <a href="?nav=roles"><li>Roles</li></a>
                <a href="?nav=users"><li>Users</li></a>
                <a href="?nav=rooms"><li>Rooms</li></a>
            </ul>
        </nav>
        <main>
            <?php
                if(isset($_GET['nav']) && $_GET['nav']=='hotels'){
                   
                    include 'hotels.php';
                }
            ?>
        </main>
    </div>
    <footer></footer>
</body>

</html>