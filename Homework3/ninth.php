<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>დაწერეთ ფუნქცია რომელიც დაადგენს შეტანილი პაროლის სიმძლავრეს (სუსტი, საშუალო, მძლავრი), ლოგიკა მოიფიქრეთ დამოუკიდებლად.</p>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="password">
        <button name="button">enter</button>
    </form>

    <span style="color: red;"></span>

    <?php
        function password_strength($password) {
            if (!preg_match('/[a-zA-Z]/', $password) || !preg_match('/\d/', $password)) {
                return 'Weak';
            }
        
            if (preg_match('/[a-zA-Z]/', $password) && preg_match('/\d/', $password) && !preg_match('/\W/', $password)) {
                return 'Medium';
            }
        
            if (preg_match('/[a-z]/', $password) && preg_match('/[A-Z]/', $password) && preg_match('/\d/', $password) && preg_match('/\W/', $password)) {
                return 'Strong';
            }
        
        }

        if(isset($_POST['button'])){
            if(empty($_POST['username'])||empty($_POST['password'])){
                echo"<p>fill out all the fields</p>";
            }
            else{
                $password = $_POST["password"];
                echo "<p>Password strengh:".password_strength($password)."</p>";
            }
        }
    ?>

</body>
</html>