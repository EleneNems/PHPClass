<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h3{
            text-align: center;
        }
        
        table{
            border-collapse: collapse;
            margin: auto;
            width: 500px;
            min-height: 200px;
            text-align: center;
        }

        table tr th, td{
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <h3>Third Exercise</h3>

    <table>
        <?php
        $matrix =[];
        $rows = 6;
        $columns = 5;



        for ($i=0; $i < $rows; $i++) { 
            echo "<tr>";
            for ($j=0; $j < $columns; $j++) { 
                $matrix[$i][$j] = $i + $j;
                echo "<td>". $matrix[$i][$j]. "</td>";
            }
            echo "</tr>";
        }
        

        ?>
    </table>

</body>
</html>