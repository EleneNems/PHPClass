<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table tr th, tr td {
            border: 1px solid black;
            box-sizing: border-box;
            text-align: center;
            width: 30px;
            height: 30px;
        }
    </style>

</head>

<body>

    <p>
    განსაზღვრეთ 4x4 რიცხვითი მატრიცა. ელემენტებს მნიშვნელობები მიანიჭეთ [10; 100]-შუალედიდან. გამოიტანეთ მატრიცის ელემენტები ცხრილის სახით, გამოიტანეთ მატრიცის მთავარი დიაგონალის ზემოთ მდგომი ელემენტები ცხრილის სახით. შეიტანეთ X რიცხვი $_POST მეთოდის საშუალებით, გამოიტანეთ მატრიცაში არსებული X რიცხვის ჯერადი რიცხვები, გამოიტანეთ მატრიცის ელემენტების ჯამი, ნამრავლი, საშუალო არითმეტიკული ცხრილის სახით.
    </p>

    <form action="" method="post">
        <input type="number" name="x" placeholder="enter X">
        <br><br>
        <button name="enter">Enter</button>
        <br>
    </form>

    <?php
    if(isset($_POST['enter'])){
        if(!empty($_POST['x'])){

            $x = $_POST['x'];
            $matrix = [];
            $sum = 0;
            $prod=1;
            $avg = 0;
            $count = 0;


            echo "<table>";
            for ($i = 0; $i < 4; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 4; $j++) {
                    $matrix[$j][$i] = rand(10, 100);
                    $sum += $matrix[$j][$i];
                    $prod *= $matrix[$j][$i];
                    $count ++;
                    echo "<td>".$matrix[$j][$i] ."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";

            echo "<table>";
            for ($i = 0; $i < 4; $i++) {
                echo "<tr>";
                for ($j=0; $j < 4; $j++) { 
                    if($i <$j){
                echo "<td>".$matrix[$j][$i]." </td>";
                    }
                    else{
                echo "<td></td>";
                    }
                }
                echo "</tr>";

            }
            echo "</table>";

            for ($i=0; $i < 4; $i++) { 
                for ($j=0; $j < 4; $j++) { 
                    if($matrix[$j][$i]%$x==0){
                        echo $matrix[$j][$i]." ";
                    }
                }
            }

            $avg = $sum / $count;


            echo "<table>";
            echo "<tr>";
            echo "<th>Sum</th>";
            echo "<th>Prod</th>";
            echo "<th>Average</th>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>$sum</th>";
            echo "<th>$prod</th>";
            echo "<th>$avg</th>";
            echo "</tr>";
            echo "</table>";
        }
        else{
            echo "Please enter a number";
        }
    }
    ?>
</body>

</html>