<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border-collapse: collapse;
            margin: 10px auto;
            width: 300px;
        }

        table tr th, td{
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    $cars =[
        ["Make"=>"Toyota",
        "Model"=>"Corolla",
        "Color"=>"White", 
        "Mileage"=>24000,
        "Status"=>"Sold"],
        ["Make"=>"Toyota",
        "Model"=>"Camry", 
        "Color"=>"Black", 
        "Mileage"=>56000,       
        "Status"=>"Available"],
        ["Make"=>"Honda", 
        "Model"=>"Accord", 
        "Color"=>"White", 
        "Mileage"=>15000, 
        "Status"=>"Sold"]
    ];
    ?>

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