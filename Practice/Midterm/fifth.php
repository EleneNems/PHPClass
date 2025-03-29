<?php
    $cars = [
        [
            "Make" => "Toyota",
            "Model" => "Corolla",
            "Color" => "White",
            "Mileage" => 100000,
            "Status" => "Sold"
        ],
        [
            "Make" => "Toyota",
            "Model" => "Camry",
            "Color" => "Black",
            "Mileage" => 350000,
            "Status" => "Available"
        ],
        [
            "Make" => "Honda",
            "Model" => "Accord",
            "Color" => "red",
            "Mileage" => 321000,
            "Status" => "Sold"
        ]
    ]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 500px;

        }

        table tr th, tr td {
            border: 1px solid black;
            box-sizing: border-box;
            text-align: center;
        }
    </style>
</head>
<body>
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
                <td><?=$cars[$i]['Make'];?></td>
                <td><?=$cars[$i]['Model'];?></td>
                <td><?=$cars[$i]['Color'];?></td>
                <td><?=$cars[$i]['Mileage'];?></td>
                <td><?=$cars[$i]['Status'];?></td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>