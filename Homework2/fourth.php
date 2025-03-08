<?php
    include("cars.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <style>

        h3{
            text-align: center;
        }

        table{
            border-collapse: collapse;
            margin: auto;
            width: 500px;
            min-height: 200px;
            text-align: center;
        }

        table tr th, td{
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <h3>fourth Exercise</h3>

    <table>
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Color</th>
            <th>Mileage</th>
            <th>Status</th>
        </tr>

        <?php
            for ($i=0; $i < count($cars); $i++) { 
        ?>

        <tr>
            <td><?=$cars[$i]['Make']?></td>
            <td><?=$cars[$i]['Model']?></td>
            <td><?=$cars[$i]['Color']?></td>
            <td><?=$cars[$i]['Mileage']?></td>
            <td><?=$cars[$i]['Status']?></td>
        </tr>

        <?php
            }
        ?>

    </table>

</body>
</html>