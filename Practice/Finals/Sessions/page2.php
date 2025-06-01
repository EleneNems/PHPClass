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
        body {
            background-color: lightpink;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        a {
            text-decoration: none;
            font-size: 20px;
        }

        p {
            font-size: 18px;
            margin-top: 20px;
            color: green;
        }
    </style>
</head>

<body>
    <a href="page1.php">Page 1</a>
    <h1>
        Page 2
    </h1>
    <a href="page3.php">Page 3</a>

    <?php
    echo $x;
    $_SESSION['ses1'] = 15;
    echo "<p>" . $_SESSION['ses1'] . "</p>"
        ?>
</body>

</html>