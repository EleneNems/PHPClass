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

        table tr th,
        tr td {
            border: 1px solid black;
            box-sizing: border-box;
            text-align: center;
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="m" placeholder="M">
        <br>
        <br>
        <input type="text" name="n" placeholder="n">
        <br>
        <br>
        <input type="text" name="a" placeholder="a">
        <br>
        <br>
        <input type="text" name="b" placeholder="b">
        <br>
        <br>
        <button name="generate">Generate</button>
    </form>

    <?php
    if (isset($_POST['generate'])) {
        if (!empty($_POST['M']) || !empty($_POST['n']) || !empty($_POST['a']) || !empty($_POST['b'])) {
            $m = $_POST['m'];
            $n = $_POST['n'];
            $a = $_POST['a'];
            $b = $_POST['b'];

            $sum_col = array_fill(0, $n, 0);

            if ($m > 0 && $n > 0) {
                echo '<table>';

                for ($i = 0; $i < $m; $i++) {
                    $sum_row = 0;

                    echo "<tr>";
                    for ($j = 0; $j < $n; $j++) {
                        $random_num = rand($a, $b);
                        echo "<td>$random_num</td>";
                        $sum_col[$j] += $random_num;
                        $sum_row += $random_num;
                    }
                    echo "<td>$sum_row</td>";
                    echo "</tr>";
                }

                echo "<tr>";
                foreach ($sum_col as $columns) {
                    echo "<td>$columns</td>";
                }
                echo "</tr>";

                echo '</table>';
            } else {
                echo "Please enter positive numbers for M and N";
            }

        } else {
            echo "fill all fields";
        }
    }
    ?>
</body>

</html>