<?php
    include("questions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HW3</title>
    <style>

        body {
            text-align: center;
        }

        form{
            justify-self: center;
            border: solid 1px black;
            padding: 10px;
            text-align: left;
        }

        form input{
            margin: 5px;
        }

        form textarea{
            width: 200px;
            height: 50px;
            padding: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    
    <form action="" method="post">
        <?php
            for ($i = 0; $i < count($questions); $i++) {
        ?>
        
            <p><?=$questions[$i]['question']?></p>
            
            <?php
                foreach ($questions[ $i ]['options'] as $option) {
            ?>

                <input type="radio" name="<?= $questions[$i]['name']?>" value="<?=$option?>"> <?=$option?> <br>
            
            <?php
                }
            ?>
        <?php
            }
        ?>

        <p>What is the purpose of HTML in web development?</p>
        <textarea name="q4" id=""></textarea>
        <p>explain what a database is:</p>
        <textarea name="q5" id=""></textarea>

        <br> <br>
        <button>Submit</button>
    </form>

    <br><br>


    <?php
        $rightAnswers=0; 
        $correctAnswers=[
            "q1"=> "Python",
            "q2"=> "CSS",
            "q3"=> "MySQL"
        ];

        foreach ($correctAnswers as $question => $answer) {
            if(isset($_POST[$question]) && $_POST[$question]==$answer){
                $rightAnswers++;
            }
        }

        $q4 = $_POST["q4"] ?? "Did Not Answer";
        $q5 = $_POST["q5"] ?? "Did Not Answer";

        echo "question 4:".$q4."<br>question 5:".$q5."<br>";

        echo "You got the ".$rightAnswers." multiple questions right out of 3 the other two is stored for review";
    ?>

</body>
</html>