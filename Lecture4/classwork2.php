<?php
    $error ='';
    if(!isset($email)||isset($user)){
       $error = "error";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            padding: 10px;
            margin: auto;
        }

        form input, button{
            margin: 5px;
            
        }

        p{
            margin: 10px;
        }

        .error{
            font-size: 24px;
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="email" name="email"> <span class="<?=$error?>">*</span>
        <br>
        <input type="text" placeholder="user" name="user"> *
        <br>
        <input type="radio" value="18-25" name="choice"> 18-25
        <input type="radio" value=" 26-30" name="choice"> 26-30
        <input type="radio" value= "30-40" name="choice"> 30-40
        <input type="radio" value= "41-50" name="choice"> 41-50
        <br>
        <button name="sign_up">Sign Up</button>
    </form>

    <?php
        if(isset($_POST['sign_up'])){
            $email = $_POST['email'] ?? '';
            $user = $_POST['user'] ?? '';
            $age = $_POST['choice'] ?? '';
    
            echo "<p> ". $email ."<br> ". $user ." <br>". $age."</p> " ;

           
        }

    ?>
</body>
</html>