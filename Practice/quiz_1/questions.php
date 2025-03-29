<?php
    $questions = [
        [
            'name' => 'q1',
            'question' => 'which year did Ferrari get their last championship',
            'options'=> ['2007', '2004', '2005', '2006'],
            'correctAnswer'=> '2007'
        ],
        [
            'name' => 'q2',
            'question' => 'Who won the 2019 F1 World Drivers Championship',
            'options'=> ['Lewis Hamilton', 'Fernando Alonso', 'Sebastian Vettel', 'Nico Rosberg'],
            'correctAnswer'=> 'Lewis Hamilton'
        ],
        [
            'name' => 'q3',
            'question' => 'How many F1 World Drivers Championships has Lewis Hamilton won',
            'options'=> ['5', '4', '7', '8'],
            'correctAnswer'=> '7'
        ]
    ];

    shuffle($questions);

    foreach ($questions as &$question) {
        shuffle($question['options']); 
    }

    $correctAnswerCount = 0;

    $correctAnswers=[
        'q1' => '2007',
        'q2' => 'Lewis Hamilton',
        'q3' => '7'
    ];

    foreach ($correctAnswers as $questionName => $correctAnswer) {
        if (isset($_POST[$questionName]) && $_POST[$questionName] == $correctAnswer) {
            $correctAnswerCount++;
        }
    }

    $questions1 =[
        [
            'question' =>  'What is HTML',
            'maxPoint' => '8' 
        ],
        [
            'question' =>  'What is Angular',
            'maxPoint' => '10' 
        ],
        [
            'question' =>  'What is React',
            'maxPoint' => '9' 
        ],
        [
            'question' =>  'What is CSS',
            'maxPoint' => '10' 
        ],
        [
            'question' =>  'What is JS',
            'maxPoint' => '10' 
        ]
    ]

?>