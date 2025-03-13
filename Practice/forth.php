<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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

    <p>დაწერეთ ფუნქცია, რომელიც გამოიტანს 10x10-ზე ცხრილს, რომლის თითოეულ უჯრაში ჩაწერილი იქნება შემთხვევითი
    რიცხვები [10; 99] შუალედიდან.</p>
    <?php
        function generate_table(){
            echo"<table>";
        for ($i = 0; $i < 10; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 10; $j++) {
                $random_num = rand(10,99);
                echo "<td>". $random_num ."</td>";
            }
            echo "</tr>";
        }
        echo"</table>";
        }

        generate_table();
    ?>
</body>
</html>