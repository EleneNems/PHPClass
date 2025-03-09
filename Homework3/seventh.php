<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>დაწერეთ ფუნქცია, რომელიც დააბრუნებს M განზომილებიან ვექტორს, რომელშიდაც ჩაწერილი იქნება შემთხვევითი
    რიცხვები [a; b] შუალედიდან. M, a და b შეიტანეთ ფორმიდან.</p>

    <form action="" method="post">
        <input type="number" name="m" placeholder="Enter M"> 
        <input type="number" name="a" placeholder="Enter A"> 
        <input type="number" name="b" placeholder="Enter B">
        <button name="generate">Generate</button> 
    </form>

    <?php
        function create_vector($size, $min, $max){
            $vector =[];

            for($i = 0; $i < $size; $i++){
                $vector[$i] = rand($min,$max);
            }
            
            return $vector;

        }

        if(isset($_POST['generate'])){
            if(empty($_POST['m'])||empty($_POST['a'])||empty($_POST['b'])){
                echo "<p>Please fill all the fields!</p>";
            }
            else{
                $M = $_POST['m'];
                $A = $_POST['a'];
                $B = $_POST['b'];

                $vector = create_vector($M,$A,$B);

                foreach($vector as $numbers){
                    echo $numbers. ' ';
                }
            }
        }
    ?>
</body>
</html>