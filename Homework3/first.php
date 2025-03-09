<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <p>დაწერეთ ფუნქცია, რომელიც გამოიტანს 10x10-ზე ცხრილს, რომლის თითოეულ უჯრაში ჩაწერილი იქნება შემთხვევითი
    რიცხვები [10; 99] შუალედიდან.</p>

    <?php
        function generateTable()
        {
            echo "<table>";
            
            for ($i=0; $i < 10; $i++) { 
                echo "<tr>";
                for ($j=0; $j < 10; $j++) { 
                    $randomNumber = rand(10, 99);
                    echo "<td>$randomNumber</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }    

        generateTable();
?>
</body>
</html>