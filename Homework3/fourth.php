<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <p>გამოიტანეთ დამცავი კოდი, რომელიც ორნიშნა რიცხვებს შორის წერს შემთხვევითი არითმეტიკული ოპერაციის სიმბოლოს(მიმატება, გამოკლება), გამოიტანეთ შედეგის შესატანი ველი, შეამოწმეთ მომხმარებლის მიერ შეტანილი მონაცემი.</p>

    <form action="" method="post">
        <input type="text" name="users_guess" placeholder="Enter your guess:">
        <button name="button">Enter</button>
    </form>

    <?php
        if(isset($_POST['button']))
        {
            if(empty($_POST['users_guess'])){
                echo "<p>Please fill out the form</p>";
            }
            else{
                $users_guess= $_POST['users_guess'];
                $num1 = rand(10,99);
                $num2 = rand(10,99);
                $operations = ['+','-'];
                $operation = $operations[array_rand($operations)];
                $random_number = $num1 .$operation. $num2;

                echo "<p>The code was:". $random_number."</p>";

                if($users_guess==$random_number){
                    echo "<p>The guess is correct</p>";
                }
                else{
                    echo "<p>The guess is incorrect</p>";
                }
            }
        }
    ?>
</body>
</html>