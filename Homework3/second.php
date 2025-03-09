<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>დაწერეთ ფუნქცია, რომელიც გამოიტანს MxN-ზე ცხრილს, რომლის თითოეულ უჯრაში ჩაწერილი იქნება შემთხვევითი რიცხვები [a; b] შუალედიდან. M, N, a და b შეიტანეთ ფორმიდან, გაითვალისწინეთ მომხმარებლის მიერ მონაცემების შეტანის პროცესში დაშვებული შესაძლო შეცდომები.</p>

    <form action="" method="post">
        <input type="number" placeholder="Enter M" name="m">
        <input type="number" placeholder="Enter N" name="n">
        <input type="number" placeholder="Enter A" name="a">
        <input type="number" placeholder="Enter B" name="b">

        <button name="create">Create a table</button>
    </form>

    <?php
    if(isset($_POST["create"])){
        if(empty($_POST['m'])||empty($_POST['n'])||empty($_POST['a'])||empty($_POST['b'])){
            echo "<p>Please fill all fields</p>";
        }
        elseif ($_POST['m']<=0||$_POST['n']<=0) {
            echo "<p>M and N cant be negative or 0</p>";
        }
        elseif($_POST['a']>$_POST['b']){
            echo "<p>A can't be more than B</p>";
        }
        else{

            $M = $_POST['m'];
            $N = $_POST['n'];
            $A = $_POST['a'];
            $B = $_POST['b'];

            echo "<table>";
            for ($i=0; $i < $M; $i++) { 
                echo "<tr>";
                for ($j=0; $j < $N; $j++) { 
                    $random_number = rand($A,$B);
                    echo "<td>".$random_number."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>
</body>
</html>