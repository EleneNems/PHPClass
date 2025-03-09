<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>განსაზღვრეთ MxN რიცხვითი მატრიცა. ელემენტებს მიანიჭეთ შემთხვევითი მნიშვნელობები [a; b]-შუალედიდან. გამოიტანეთ მატრიცის ელემენტები ცხრილის სახით. M, N, a და b შეიტანეთ ფორმიდან. გამოიტანეთ მატრიცის თითუელ სტრიქონში მდგომი ელემენტების ჯამი სტრიქონის გასწვრივ, ასევე მატრიცის თითოეულ სვეტში მდგომი ელემენტების ჯამი სვეტის ქვემოთ.</p>

    <form action="" method="post">
        <input type="text" name="m" placeholder="Enter M">
        <input type="text" name="n" placeholder="Enter N">
        <input type="text" name="a" placeholder="Enter A">
        <input type="text" name="b" placeholder="Enter B">
        <button name="create">Enter</button>
    </form>

    <?php
        if(isset($_POST['create'])){
            if(empty($_POST['m'])||empty($_POST['n'])|| empty($_POST['a'])||empty($_POST['b'])){
                echo "<p>please fill out the whole form</p>";
            }
            elseif($_POST['m']<=0||$_POST['n']<=0){
                echo "<p>neither m or n can be 0 or negative</p>";
            }
            elseif($_POST['a']>$_POST['b']){
                echo "<p>a cant be greater than b</p>";
            }
            else{
                $m = $_POST ["m"];
                $n = $_POST ["n"];
                $a = $_POST ["a"];
                $b = $_POST ["b"];
                $sum_col =  array_fill(0, $n, 0);


                echo "<table>";
                for ($i=0; $i < $m; $i++) { 
                    $sum_row=0;

                    echo"<tr>";
                    for ($j= 0; $j < $n; $j++) {
                        $random_num = rand($a,$b);
                        echo "<td>".$random_num."</td>";
                        
                        $sum_col[$j] += $random_num;
                        $sum_row += $random_num; 

                        
                    }
                    
                    echo "<td>".$sum_row."</td>";
                    echo"</tr>";
                }

                echo "<tr>";
                foreach ($sum_col as $numbers) {
                    echo "<td>".$numbers."</td>";
                }
                echo "</tr>";

                echo "</table>";

            }
        }
    ?>
</body>
</html>