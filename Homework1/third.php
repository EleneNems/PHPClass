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
        <p>Which of the following is a programming language?</p>
        <input type="radio" name="q1" value="Python"> Python <br>
        <input type="radio" name="q1" value="JavaScript"> JavaScript <br>
        <input type="radio" name="q1" value="HTML"> HTML <br>
        <input type="radio" name="q1" value="CSS"> CSS <br>

        <p>Which of these is used to style a webpage?</p>
        <input type="radio" name="q2" value="CSS"> CSS <br>
        <input type="radio" name="q2" value="PHP"> PHP <br>
        <input type="radio" name="q2" value="JavaScript"> JavaScript <br>
        <input type="radio" name="q2" value="SQL"> SQL <br>

        <p>Which of these is a database?</p>
        <input type="radio" name="q3" value="MySQL"> MySQL <br>
        <input type="radio" name="q3" value="Bizagi"> Bizagi <br>
        <input type="radio" name="q3" value="SSM"> SSM <br>
        <input type="radio" name="q3" value="Python"> Python <br>

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