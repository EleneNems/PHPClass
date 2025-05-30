<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table{
            border-collapse: collapse;
            margin: 10px auto;
        }

        table tr td{
            border: 1px solid black;
            text-align: center;
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <p>განსაზღვრეთ 4x4 რიცხვითი მატრიცა. ელემენტებს მნიშვნელობები მიანიჭეთ [10; 100]-შუალედიდან. გამოიტანეთ მატრიცის
        ელემენტები ცხრილის სახით, გამოიტანეთ მატრიცის მთავარი დიაგონალის ზემოთ მდგომი ელემენტები ცხრილის სახით. გამოიტანეთ
        მატრიცის ელემენტების ჯამი, ნამრავლი, საშუალო არითმეტიკული, განი, თითოეული ელემენტის ციფრთა ჯამი ცხრილის
        სახით.
    </p>

    <?php
        $sum=0;
        $average=0;
        $prod=1;
        $column_sum = array_fill(0, 4, 0);
        echo '<table>';
        for ($i=0; $i < 4; $i++) { 
            echo '<tr>';
            $rowsum=0;

            for ($j=0; $j < 4; $j++) { 
                $rand=rand(10,100);
                $sum+=$rand;
                $rowsum+=$rand;
                $prod*=$rand;
                $column_sum [$j]+=$rand;
                echo '<td>'.$rand.'</td>';
            }

            echo '<td>'.$rowsum.'</td>';
            echo '</tr>';

            
        }
        echo '<tr>';
        for ($i=0; $i < count($column_sum); $i++) { 
                echo '<td>'.$column_sum[$i].'</td>';
            }
        echo '</tr>';

        echo '</table>';
        

        $average=$sum/16;
        echo "sum:".$sum;
        echo "<br>average:".$average;
        echo "<br>average:".$prod;
        echo '<table>';

        for ($i=0; $i < 4; $i++) { 
            echo '<tr>';
            for ($j=0; $j < 4; $j++) { 
                if($j>$i){
                    $rand=rand(10,100);
                    echo '<td>'.$rand.'</td>';
                }
                else{
                    echo '<td></td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    ?>
</body>

</html>