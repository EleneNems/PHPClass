<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>გამოიტანეთ ხუთნიშნა დამცავი კოდი, რომელიც შეიცავს შემთხვევით ციფრებს უზრუნველყავით მომხმარებლის მიერ შეტანილი დამცავი კოდის შემოწმება.</p>

    <form action="" method="post">
        <input type="number" name="users_try" placeholder="enter your security code:">
        <button name="guess">Enter</button>
    </form>

    <?php
        if(isset($_POST['guess'])){
            if(empty($_POST['users_try']))
            {
                echo '<p>please enter the security code</p>';
            }
            elseif(strlen($_POST['users_try'])!=5){
                echo '<p>The input has to be 5numbers</p>';
            }
            else{
                $users_try = $_POST['users_try'];
                $security_code = rand(10000,99999);
                if($security_code == $users_try){
                    echo '<p>Your security code is correct</p>';
                }
                else{
                    echo '<p>Your security code is incorrect</p>';
                }
            }
        }
    ?>
</body>
</html>