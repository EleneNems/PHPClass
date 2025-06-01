<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 1</title>
    <style>
        body{
            background-color: lightpink;
            text-align: center;
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
        }
        a{
            text-decoration: none;
            font-size: 20px;
        }
        p{
            font-size: 18px;
            margin-top: 20px;
            color: green;
        }
    </style>
</head>

<body>
    <a href="page1.php">Page 1</a>
    <br><br>
    <a href="page2.php">Page 2</a>
    <br><br>
    <a href="page3.php">Page 3</a>
    <br><br>
    <a href="page4.php">Page 4</a>
    <h1>
        Page 5
    </h1>

    <?php
    echo "<p>".$_SESSION['ses1']."</p>";
    echo "<p>".$_SESSION['ses2']."</p>";
    echo "<p>".$_SESSION['ses3']."</p>";
    ?>
</body>

</html>