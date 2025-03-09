<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>დაწერეთ ფუნქცია, რომელიც დაადგენს შეტანილი რიცხვი რამდენ ნიშნაა.</p>

    <form action="" method="post">
        <input type="number" name="number" placeholder="Enter the number:">
        <button name="count">Enter</button>
    </form>

    <?php
        function number_length( $number ) {
            $length = strlen( $number );
            return $length;
        }

        if(isset($_POST['count'])){
           if(empty($_POST['number'])){
            echo '<p>Please enter a number</p>';
           } 
           else{
            echo "<p>The length of the number is: " .number_length( $_POST['number']). "</p>";
           }
        }
    ?>
</body>
</html>