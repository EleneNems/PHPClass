<?php
    include("questions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .table-1{
            border-collapse: collapse;
            width: 600px;
            margin: auto;
        }

        .table-1 tr th, td{
            border: solid 1px black;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
        }
    </style>

</head>

<body>
    
    <form action="third-2.php" method="post">
    <table class="table-1">
        <tr>
            <th>Questions</th>
            <th>Answers</th>
            <th>Max Point</th>
        </tr>

        <?php
            for ($i=0; $i < count($questions1); $i++) { 

        ?>

        <tr>
            <td><?=$questions1[$i]['question']?></td>
            <td><input type="text" name="answers[]"></td>
            <td><?=$questions1[$i]['maxPoint']?></td>
        </tr>

        <?php
            }
        ?>

        <tr>
            <td colspan="3"> 
                Student: 
                <input type="text" name="studentName" placeholder="Name">
                <input type="text" name="studentLastName" placeholder="Last Name">
                <button>Send</button>
            </td>
        </tr>
    </table>
    </form>

</body>
</html>