<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HW1</title>
    <style>
        .container form{
            display: flex;
            flex-direction: column;
            justify-self: center;
        }

        form input{
            width: 150px;
            margin: 5px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            text-align: left;
        }

        th, td{
            border: 1px solid black;
            padding: 12px;
        }
    </style>

</head>
<body>
    <div class="container">
        <form action="" method="get">
            <input type="text" name="firstname" placeholder="enter your first name">
            <input type="text" name="lastname" placeholder="enter your last name">
            <input type="text" name="position" placeholder="enter your position">
            <input type="text" name="salary" placeholder="enter your salary">
            <input type="text" name="tax" placeholder="enter your tax in %">

            <button>Insert</button>
        </form>
    </div>

    <?php
        $firstname = $_GET["firstname"] ?? "";
        $lastname = $_GET["lastname"] ?? "";
        $position = $_GET["position"] ?? "";
        $salary = is_numeric($_GET["salary"] ?? null) ? (float) $_GET["salary"] : 0;
        $tax = is_numeric($_GET["tax"] ?? null) ? (float) $_GET["tax"] : 0;
        
        $taxed = $salary * ($tax / 100);
        $fixedSalary = $salary - $taxed;
    ?>

    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Tax</th>
            <th>Fixed Salary</th>
        </tr>

        <tr>
            <td><?= htmlspecialchars($firstname) ?></td>
            <td><?= htmlspecialchars($lastname) ?></td>
            <td><?= htmlspecialchars($position) ?></td>
            <td><?= $salary ?></td>
            <td><?= $taxed ?></td>
            <td><?= $fixedSalary ?></td>
        </tr>
    </table>


</body>
</html>