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
            echo "<hr><hr><hr>";
            $full_info = [  'name' => "Marima", 
                            'age' => 25, 
                            'city' => "Tbilisi", 
                            'education' => ["Gau", "157 Skola", "123 Baghi"] 
                        ];
            foreach ($full_info as $k => $e) {
               echo "<div>$k</div>";
            }            
            echo "<hr><hr><hr>";
            echo "Hello PHP";
            $name = "Mariam";
            $age = 18;
            echo "<h2>სახელი: $name; ასაკი:  $age</h2>";
            $info = ["Mariam", 18, 3.8, true, "Gau"];
            echo "<h2>სახელი: $info[0]; უნივერსიტეტი: $info[4]</h2>";
            echo "<hr>";
            
            // სამი განსხვავებული ხერხით დაბეჭდეთ მასივის ელემენტები ცალ-ცალკე სტრიქონად. 
            for($i=0; $i<count($info); $i++){
                echo "<div>$info[$i]</div>";
            }
            echo "<hr>";
            $i = 0;
            while($i < count($info)){
                echo "<div>$info[$i]</div>";
                $i++;
            }
            echo "<hr>";
            foreach ($info as $e) {
                echo "<div>$e</div>";
            }
            echo "<hr>";
            echo implode(" <br> ", $info);
            echo "<hr>";
            echo "<pre>";
            print_r($info);
            echo "</pre>";
        ?> 
        <hr>
            <div>End Of Soruce Code</div>
        </hr>
    </div>
</body>
</html>
