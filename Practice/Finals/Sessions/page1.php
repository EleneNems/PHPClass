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
    <h1>
        Page 1
    </h1>
    <a href="page2.php">Page 2</a>
    <?php
    $x = 10;
    echo '<p>'.$x.'</p>';
    ?>
</body>

</html>