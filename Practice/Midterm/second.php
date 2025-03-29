<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $questions = [
        [
            "question" => "Which one says green?",
            "answers" => ["Green", "Blue", "Red", "Yellow"],
            "correct" => "Green"
        ],
        [
            "question" => "Which one says blue?",
            "answers" => ["Red", "Blue", "Green", "Yellow"],
            "correct" => "Blue"
        ],
        [
            "question" => "Which one says red?",
            "answers" => ["Green", "Blue", "Red", "Yellow"],
            "correct" => "Red"
        ]
    ];


    $gia = [
        "Tell me about yourself here.",
        "Tell me about your experience here."
    ]
        ?>

    <form action="" method="post">
        <?php
        for ($i = 0; $i < count($questions); $i++) {
            ?>

            <label>
                <?= $questions[$i]['question'] ?>
            </label>
            <br>

            <?php
            for ($j = 0; $j < count($questions[$i]['answers']); $j++) {
                ?>

                <input type="checkbox" name="m_answers[]" value="<?=$questions[$i]['answers'][$j]?>">

                <?= $questions[$i]['answers'][$j] ?>
                <br>

                <?php
            }
        }
        ?>


        <?php
        for ($i = 0; $i < count($gia); $i++) {
            ?>
            <label> <?= $gia[$i] ?></label>
            <br>
            <textarea name="g_answers[]"></textarea>
            <br>
            <?php
        }
        ?>
        <button name="enter">Enter</button>
    </form>

    <?php
        if(isset($_POST['enter'])){

            if(isset($_POST['m_answers']) && isset($_POST['g_answers'])){

                $m_answers = $_POST['m_answers'];
                $g_answers = $_POST['g_answers'];
    
                $correctAnswerCount = 0;
    
                foreach ($questions as $index => $question) {
                    if (isset($m_answers[$index]) && $m_answers[$index] == $question['correct']) {
                        $correctAnswerCount++;
                    }
                }

                echo "<pre>";
                print_r($g_answers);
                echo "</pre>";
    
                echo $correctAnswerCount;
            }
            else{
                echo "enter some answers";
            }
        }
    ?>
</body>

</html>