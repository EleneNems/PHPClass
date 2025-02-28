<?php
    include "questions.php";

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="">
    <table class="table-1">
        <tr>
        <td colspan="4">Student: 
        <?= isset($_POST['studentName']) ? $_POST['studentName'] : '' ?> 
        <?= isset($_POST['studentlastName']) ? $_POST['studentlastName'] : '' ?></td>
        </tr>
        <tr>
            <th>Questions</th>
            <th>Answers</th>
            <th>Max Point</th>
            <th>Point</th>
        </tr>

        <?php
            for ($i=0; $i < count($questions); $i++) { 
        ?>

        <tr>
            <td><?=$questions[$i]['question']?></td>
            <td><?=$_POST['answer'][$i] ?? '' ?></td> 
            <td><?=$questions[$i]['maxPoint']?></td>
            <td> <input type="text"></td>
        </tr>

        <?php
            }
        ?>

        <tr>
            <td colspan="4">
                Lecturer: <input type="text" name="name" placeholder="First Name">
                <input type="text" name="lastName" placeholder="Last Name">
                <button type="submit">Send</button>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>