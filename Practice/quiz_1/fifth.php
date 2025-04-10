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
    <p>დაწერეთ ფუნქცია, რომელიც გამოიტანს MxN-ზე ცხრილს, რომლის თითოეულ უჯრაში ჩაწერილი იქნება შემთხვევითი
რიცხვები [a; b] შუალედიდან. M, N, a და b შეიტანეთ ფორმიდან, გაითვალისწინეთ მომხმარებლის მიერ მონაცემების
შეტანის პროცესში დაშვებული შესაძლო შეცდომები.</p>

    <form action="" method="post">
        <input type="number" placeholder="Enter M" name="m">
        <input type="number" placeholder="Enter N" name="n">
        <input type="number" placeholder="Enter A" name="a">
        <input type="number" placeholder="Enter b" name="b">

        <button name="generate">generate</button>
    </form>

    <?php
        function generate_table($m, $n, $a, $b) {
            

            echo '<table>';
            for($i= 0;$i<$m;$i++){
                echo '<tr>';
                for($j= 0;$j<$n;$j++){
                    $random_num = rand($a,$b);
                    echo '<td>'.$random_num.'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }


        if(isset($_POST["generate"])){
            if(empty($_POST["m"])||empty($_POST["n"])||empty($_POST["a"])||empty($_POST["b"])){
                echo "Please fill in all the inputs";
            }
            elseif($_POST["m"]<0||$_POST["n"]<0){
                echo "Neither m or n can be negative";
            }
            else{
                $m = $_POST["m"];
                $n = $_POST["n"];
                $a = $_POST["a"];
                $b = $_POST["b"];
                generate_table($m, $n, $a, $b);
            }
        }
    ?>

</body>
</html>