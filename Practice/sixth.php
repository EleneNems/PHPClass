<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="guess" placeholder="Enter your code">
        <button name="enter">Enter</button>
    </form>

    <?php

        if(isset($_POST["enter"])) {
            if(empty($_POST["guess"])) {
                echo 'Please fill in the form';
            }
            else{
                $guess = $_POST["guess"];

                $num1=rand(10, 99);
                $num2=rand(10, 99);

                $operations = ['+', '-'];
                
                $operation = $operations[array_rand($operations)];

                $answer = $num1.$operation.$num2;
                if($guess == $answer){
                    echo 'Your code is correct';
                }
                else{
                    echo 'Your code is incorrect. The correct answer was: '. $answer;
                }
                
            }
        }
    ?>
</body>
</html>