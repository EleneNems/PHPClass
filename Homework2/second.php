<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        h3, p{
            text-align: center;
        }

        table{
            border-collapse: collapse;
            margin: auto;
            width: 200px;
            height: 200px;
            text-align: center;
        }

        table tr th, td{
            border: 1px solid black;
            width: 50px;
            height: 40px;
        }

        form{
            margin: 10px;
            display: flex;
            flex-direction: column;
            justify-self: center;
        }
    </style>
</head>
<body>
    <h3>Second Exercise</h3>

    <table>
        <tr>
            <th colspan="4">The matrix</th>
        </tr>

        <?php
        $matrix = [];
        $rows = 4;
        $columns = 4;
        
        for ($i=0; $i < $rows ; $i++) { 
            echo"<tr>";
            for ($j=0; $j < $columns; $j++) { 
                $matrix[$i][$j] = rand(10,100);
                echo "<td>". $matrix[$i][$j] ."</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <table>
        <tr>
            <th colspan="4">Above the diagonal </th>
        </tr>

        <?php
        for ($i=0; $i < $rows; $i++) { 
            echo "<tr>";

            for ($j= 0; $j < $columns; $j++){
                if($j>$i){
                    echo "<td>". $matrix[$i][$j] ."</td>";
                }
                else{
                    echo "<td> </td>";
                }
            }
            
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>

    <form action="" method="post">
        <input type="number" name="num1" placeholder="Enter X">
        <button name="calculate">Click</button>
    </form>

    <?php
        if(isset($_POST["calculate"])){
            if(empty($_POST["num1"])){
                echo "<p>You need to enter a number!</p>";
            }
            else{

                $num1 = $_POST['num1'];
                        
                $array2=[];

                for ($i=0; $i < $rows; $i++) { 
                    for ($j=0; $j < $columns; $j++) { 
                        if($matrix[$i][$j] % $num1 ==0){
                           $array2[]=$matrix[$i][$j];
                        }
                    }
                }
                
                if(empty($array2)){
                    echo "<p>No numbers are divisible by".$num1 ."</p>";
                }else{
                    echo "<p>numbers that are divisible by ".$num1." are:</p>";
                    for ($i=0; $i < count($array2); $i++) { 
                        echo "<p>". $array2[$i]."</p>";
                    }
                }
            }
        }
    ?>

    <br><br>

    <form action="" method="POST">
        <button name="calculate_all">Calculate</button>
    </form>

    <table>
        <tr>
            <th>Sum</th>
            <th>Product</th>
            <th>Average</th>
        </tr>

        <?php
            if(isset($_POST["calculate_all"])){
                
                $sum = 0;
                $product = 1;
                $count = 0;
                $average = 0;

                for ($i= 0; $i < $rows; $i++){
                    for ($j= 0; $j < $columns; $j++){
                        $sum +=$matrix[$i][$j];
                        $product *= $matrix[$i][$j];
                        $count++;
                    }
                }

                $average = $sum/$count;

                echo "<tr>";
                    echo "<td>".$sum ."</td>";
                    echo "<td>".$product ."</td>";
                    echo "<td>".$average ."</td>";
                echo "</tr>";
            }
        ?>
    </table>


</body>
</html>