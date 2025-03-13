<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        form{
            width: 300px;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: auto;
        }

        form input{
            margin: 10px;
        }

        p{
            text-align: center;
        }

        table{
            border-collapse: collapse;
            margin: auto;
        }

        table tr th, tr td{
            border: 1px solid black;
            width: 30px;
            height: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="m" placeholder="M">
        <input type="number" name="n" placeholder="N">
        <input type="number" name="a" placeholder="A">
        <input type="number" name="b" placeholder="B">

        <button name="generate">Generate</button>
    </form>

    <?php
    if(isset($_POST["generate"])){
        if(empty($_POST["m"])||empty($_POST["n"])||empty($_POST["a"])||empty($_POST["b"])){
            echo 'Fill out the inputs';
        }
        elseif($_POST['m']<0||$_POST['n']<0){
            echo 'm and n has to be positive';
        }
        else{
            $m = $_POST['m'];
            $n = $_POST['n'];
            $a = $_POST['a'];
            $b = $_POST['b'];

            echo '<table>';

            $sum_col=array_fill(0, $n, 0);

            for ($i=0; $i < $m; $i++) { 

                echo '<tr>';
                
                $sum_rows=0;
                
                for ($j=0; $j < $n; $j++) {
                    $random = rand($a,$b); 
                    echo '<td>'.$random.'</td>';
                    
                    $sum_rows+=$random;
                    $sum_col[$j] +=$random;
                
                }
                echo '<td>'.$sum_rows.'</td>';
                echo '</tr>';
            }
           
            echo '<tr>';
            foreach ($sum_col as $numbers){
                echo '<td>'.$numbers.'</td>';
            }
            echo '</tr>';

            echo '</table>';
        }
    }
    ?>
</body>
</html>