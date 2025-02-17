<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Lecture</title>
</head>
<body>
    <div style="width: 50%; margin: auto; border: solid; padding: 20px;">
        <h1>Lecture 1</h1>

        <?php

            echo "<hr><hr>";

            echo "Hello PHP";

            $name = "Mariami";
            $age = 20;

            echo "<h2>სახელი:$name; ასაკი:$age </h2>";

            $info = ["Tako", 18, 3.8, true, "GAU"];

            echo "<h2> სახელი: $info[0]; უნივერსიტეტი: $info[4]</h2>";

            echo "<hr>";

            foreach ($info as $element) {
                echo "$element <br>";
            }

            echo "<hr>";

            $a = 0;

            while ($a < count($info)) {
                echo $info[$a] . "<br>";
                $a++;
            }

            echo "<hr>";

            for ($i=0; $i < count($info) ; $i++) { 
                echo $info[$i] . "<br>";
            }

            echo "<hr>";

            echo implode("<br>", $info);

            echo "<hr>";

            echo "<pre>";
            print_r($info);
            echo "</pre>";


            $fullInfo = [
                'name' => 'John',
                'age' => 25,
                'city' => 'New York',
                'education' => 'Bachelor of Science'
            ];

            echo "<hr>";

            foreach ($fullInfo as $element) {
                echo "$element <br>";
            }
        ?>

        <hr><hr>
    </div>
</body>
</html>
