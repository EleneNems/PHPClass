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
        .container form{
            width: 300px;
            min-height: 400px;
            margin: auto;
            padding: 10px;
            box-sizing: border-box;
            background-color: lightcoral;

        }

        .container{
            margin-bottom: 80px;
        }

        button{
            margin-top: 10px;
            background-color: white;
            color: red;
            width: 160px;
            height: 30px;
            text-align: center;
            height: 30px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: larger;
        }

        table{
            margin: auto;
            border-collapse: collapse;
            width: 400px;
        }
        
        table tr th, td{
            border: 1px solid black;
            padding: 5px;
            box-sizing: border-box;
        }

    </style>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            
            <h3>Answer these questions:</h3>

            <?php
                for ($i = 0; $i < count($questions); $i++) {
            ?>

            <p><?=$questions[$i]['question']?></p>
                <?php
                    foreach ($questions[$i]['options'] as $option) {
                ?>

                    <input type="radio" name="<?= $questions[$i]['name'] ?>" value="<?= $option ?>"> <?= $option ?> <br>

                <?php
                    }
                ?>
            <?php
                }
            ?>

            <br>
            <button>Enter</button>
        </form>
    </div>

    <table>
        <tr>
            <th>Questions</th>
            <th>Correct Answer</th>
            <th>Selected Answer</th>
        </tr>

        <?php
        for ($i = 0; $i < count($questions); $i++){
            $questionName = $questions[$i]['name'];

            $selectedAnswer = $_POST[$questionName] ?? 'Not Answered';
        ?>

        <tr>
            <td><?=$questions[$i]['question']?></td>
            <td><?=$questions[$i]['correctAnswer']?></td>
            <td><?=$selectedAnswer?></td>
        </tr>

        <?php
        }
        ?>

        <tr>
            <td colspan="3">Correct Answers: <?=$correctAnswerCount?></td>
        </tr>
    </table>

</body>
</html>