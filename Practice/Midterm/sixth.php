<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="num">
        <br><br>
        <button name="enter">Enter</button>
    </form>

    <?php
        function count_num($num){
            $length = strlen($num);
            return $length;
        }

        if(isset($_POST['enter'])){
            if(!empty($_POST['num'])){
                $num1 = $_POST['num'];

                echo count_num($num1);
            }
            else{
                echo "Please enter a number.";
            }
        }
    ?>
</body>
</html>