<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            margin:auto;
            display: flex;
        }
    </style>
</head>
<body>

    <h3><a href="davaleba1.php">Home</a></h3>

    <div class="container">
        <form action="" method="get">
            <input type="text" name="name" placeholder="Enter your name">
            <br><br>
            <input type="text" name="lastname" placeholder="Enter your lastname">
            <br><br>
            <input type="text" name="position" placeholder="Enter your position">
            <br><br>
            <input type="text" name="salary" placeholder="Enter your salary">
            <br><br>
            <input type="text" name="tax" placeholder="Enter your tax">
            <br><br>
            <button>Continue</button>
        </form>
    </div>

    <?php
        $salary = $_GET['salary'];
        $percentage = $_GET['tax'];
    
        $taxed = $salary * ($percentage / 100);
        $fixedSalary = $salary - $taxed;
    
        echo "<div>" .$taxed."</div>";
        echo "<div>" .$fixedSalary."</div>"
    ?>

    <div class="container">
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Tax (%)</th>
                <th>Fixed Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $_GET['name']; ?></td>
                <td><?= $_GET['lastname']; ?></td>
                <td><?= $_GET['position']; ?></td>
                <td><?= $_GET['salary']; ?></td>
                <td><?= $taxed;?></td>
                <td><?= $fixedSalary; ?></td>
            </tr>
        </tbody>

    </table>
</div>
</body>
</html>