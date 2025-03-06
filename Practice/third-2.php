<?php
    echo"<pre>";
    print_r($_POST);
    echo"</pre>";

    include"questions.php";

    $answers = $_POST['answers'];
    $studentName = $_POST["studentName"];
    $studentLastName = $_POST["studentLastName"];
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

        .table-1 button{
            width: 100px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <table class="table-1">
            <tr>
                <td colspan="4">Student:
                    <?=$studentName." ".$studentLastName?>    
                </td>
            </tr>
            <tr>
                <th>Questions</th>
                <th>Answers</th>
                <th>Max Point</th>
                <th>Point</th>
            </tr>

            <?php
                for ($i=0; $i < count($questions1); $i++) { 
            ?>
            
            <tr>
                <td><?=$questions1[$i]['question']?></td>
                <td><?=$answers[$i]?></td>
                <td><?=$questions1[$i]['maxPoint']?></td>
                <td><input type="number"></td>
            </tr>

            <?php
                }
            ?>

            <tr>
                <td colspan="4">
                    <button>Send</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>