<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>First Exercise</h3>

    <form action="" method="post">
        <input type="text" placeholder="Enter X here:" name="num1">
        <button name="calculate">Calculate</button>
    </form>
    
    <?php
        if(isset($_POST['calculate'])) {

            $num1 = $_POST['num1'] ?? '';

            if(empty($num1)) {
                echo "You must enter a number!";
            }
            else{
                
                $array1 = [];

                for ($i=0; $i < 12; $i++) { 
                    $array1[] = rand(10,100);
                }

                $more_than_x = 0;
                $less_than_x = 0;
                $equals = 0;
    
                for ($i= 0; $i < count($array1); $i++) {
                    if ($array1[$i] > $num1) {
                        $more_than_x++;
                    }
                    else if ($array1[$i] < $num1) {
                        $less_than_x++;
                    }
                    else{
                        $equals++;
                    }
                }
    
                echo "<p>".$less_than_x . " numbers are less than: " . $num1 . "</p>";
                echo "<p>".$more_than_x . " numbers are more than: " . $num1 . "</p>";
                echo "<p>".$equals . " numbers equal " . $num1 . "</p>";
            }
        }

    ?>
</body>
</html>