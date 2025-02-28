<?php
    include "questions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="LecturerForm.php" method="post">
    <table class="table-1">
        <tr>
            <th>Questions</th>
            <th>Answers</th>
            <th>Max Point</th>
        </tr>

        <?php
            for ($i=0; $i < count($questions); $i++) { 
        ?>
        <tr>
            <td><?=$questions[$i]['question']?></td>

            <td><input type="text" name="answer[]"> </td>
            
            <td><?=$questions[$i]['maxPoint']?></td>
        </tr>
        <?php
            }
        ?>
        <tr>
            <td colspan="3">
                Student: <input type="text" name="studentName" placeholder="First Name">
                <input type="text" name="studentlastName" placeholder="Last Name">

                <button type="submit">Send</button>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>