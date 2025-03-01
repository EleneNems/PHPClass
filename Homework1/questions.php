<?php
    $questions=
    [
        [
            "question" => "Which of the following is a programming language?",
            "options" => ["Python", "JavaScript", "HTML", "Math"],
            "correct" => "Python",
            "name" =>"q1"
        ],
        [
            "question" => "Which of these is used to style a webpage??",
            "options" => ["CSS", "PHP", "JavaScript", "SQL"],
            "correct" => "CSS",
            "name" =>"q2"
        ],
        [
            "question" => "Which of these is a database?",
            "options" => ["MySQL", "Bizagi", "SSM", "Python"],
            "correct" => "MySQL",
            "name" => "q3"
        ],
    ];
    
    shuffle($questions);

    foreach ($questions as &$question) { // Use & to modify the original array
        shuffle($question["options"]);
    }
    
?>