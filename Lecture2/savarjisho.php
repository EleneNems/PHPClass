<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Lecture2</title>
</head>
<body>

    <?php
        $students = [
            'elene' => rand(0, 100),
            'john' => rand(0, 100),
            'mari' => rand(0, 100),
            'david' => rand(0, 100),
            'luka' => rand(0, 100)
        ];

        echo "<pre>";
        print_r($students);
        echo "</pre>";

        echo "<hr>";

        $sum = 0;
        $maxGrade =0;

        foreach ($students as $key => $value) {
            echo $key . ": " . $value . "<br>";
            $sum += $value;
            if ($maxGrade<$value) {
                $maxGrade = $value;
            }
        }
        echo "<hr>";

        echo "Thea average of the students is (With Foreach): " . $sum / count($students) . "<br>";

        $avgValue = array_sum($students) / count($students);

        echo "The average of the students is: " . $avgValue . "<br>";

        echo "The Max of the students is (With Foreach): " . max($students) . "<br>";

        echo "The Max of the students is: " . $maxGrade . "<br>";

        echo "<hr>";

        foreach ($students as $key => $value) {
            if ($value>$avgValue) {
                echo $key . " is above the average <br>";
            }
        }
    ?>
</body>
</html>