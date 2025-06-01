<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }

    if(isset($_GET['logout'])){
        unlink($_SESSION['email']);
        session_destroy();
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-self: center;
            align-self: center;
            width: 90%;
        }

        .con {
            min-height: 200px;
            display: flex;
            flex-direction: row;
        }

        footer,
        header {
            width: 90%;
            background-color: lightseagreen;
            padding: 10px;
            box-sizing: border-box;
            height: 70px;
        }

        nav {
            width: 25%;
            box-sizing: border-box;
            padding: 10px;
            background-color: lightgreen;
        }

        main {
            width: 75%;
            box-sizing: border-box;
            padding: 20px;
        }
        ul li a{
            text-decoration: none;
        }
        table{
            border-collapse: collapse;
            width: 80%;
        }
        table tr th, td{
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <a href="?logout">Log Out</a>
        </header>
        <div class="con">
            <nav>
                <ul>
                    <li>
                        <a href="?nav=hotels">Hotels</a>
                    </li>
                    <li>
                        <a href="?nav=roles">Roles</a>
                    </li>
                    <li>
                        <a href="?nav=rooms">Rooms</a>
                    </li>
                    <li>
                        <a href="?nav=users">Users</a>
                    </li>
                </ul>
            </nav>
            <main>
                <?php
                    if(isset($_GET['nav']) && $_GET['nav']=='hotels'){
                        include 'hotels.php';
                    }
                    if(isset($_GET['nav']) && $_GET['nav']=='roles'){
                        include 'roles.php';
                    }
                    if(isset($_GET['nav']) && $_GET['nav']=='rooms'){
                        include 'rooms.php';
                    }
                    if(isset($_GET['nav']) && $_GET['nav']=='users'){
                        include 'users.php';
                    }
                ?>
            </main>
        </div>
        <footer></footer>
    </div>
</body>

</html>