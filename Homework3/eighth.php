<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>დაწერეთ ფუნქცია, რომელიც დააბრუნებს MxN მატრიცას, რომელშიდაც ჩაწერილი იქნება შემთხვევითი რიცხვები [a; b] შუალედიდან. M, N, a და b შეიტანეთ ფორმიდან.</p>

    <form action="" method="post">
        <input type="number" name="m" placeholder="enter m here">
        <input type="number" name="n" placeholder="enter n here">
        <input type="number" name="a" placeholder="enter a here">
        <input type="number" name="b" placeholder="enter b here">

        <button name="generate">Generate</button>
    </form>

    <?php
        function generateMatrix($m, $n, $a, $b) {
            echo '<table>';
            for ($i=0; $i < $m; $i++) { 
                echo '<tr>';
                for ($j= 0; $j < $n; $j++){
                    $random_num = rand($a,$b);
                    echo "<td>$random_num</td>";
                }
                echo '</tr>';
            }
            echo '</table>';
        }

        if(isset($_POST['generate'])) {
            if(empty($_POST['m'])|| empty($_POST['n'])|| empty($_POST['a'])|| empty($_POST['b'])) {
                echo '<p>Please fill out all the fields</p>';
            }
            elseif($_POST['m']<=0||$_POST['n']<=0){
                echo '<p>neither m or n can be negative or 0</p>';
            }
            elseif($_POST['a']>$_POST['b']){
                echo '<p>a cannot be greater than b</p>';
            }
            else{
                $m = $_POST['m'];
                $n = $_POST['n'];
                $a = $_POST['a'];
                $b = $_POST['b'];
                generateMatrix($m, $n, $a, $b);
            }
        }
    ?>
</body>
</html>