<?php
    $tests=[
        ["question" => "Which one is a ferrari driver?",
        "answers" => ['lewis', 'max', 'lando', 'oscar'],
        "correct" => 'lewis'
        ],
        ["question" => "Which one is a redbull driver?",
        "answers" => ['lewis', 'max', 'lando', 'oscar'],
        "correct" => 'max'
        ],
        ["question" => "Which one is a mclaren driver?",
        "answers" => ['lewis', 'max', 'charles', 'oscar'],
        "correct" => 'oscar'
        ]
    ]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <?php
        for ($i=0; $i < count($tests); $i++) { 
            
        ?>
        <label for=""><?=$tests[$i]["question"]?></label>
        <br>

        <?php
        $answers=$tests[$i]['answers'];
            for ($j=0; $j < count($answers); $j++) { 
        ?>

        <input type="checkbox" name="answers[]" id="" value="<?=$answers[$j]?>"> <?=$answers[$j]?>
        <br>
        <?php
        }
        }
        ?>

        <button name="enter">Enter</button>
    </form>

    <?php
        if(isset($_POST['enter'])){
            $answers = $_POST['answers'];
            print_r($answers);
            
            $correct=0;

            foreach ($tests as $index => $test) {
                if(isset($answers[$index]) && $answers[$index] == $test['correct']){
                    $correct++;
                }
            }

            echo "<br> <br>".$correct;
        }
    ?>
</body>
</html>