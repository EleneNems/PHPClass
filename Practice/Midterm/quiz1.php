<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $travelling = [
        [
            'city' => 'Tbilisi',
            'price' => 100
        ],
        [
            'city' => 'Kutaisi',
            'price' => 120
        ],
        [
            'city' => 'Batumi',
            'price' => 200
        ],
        [
            'city' => 'Rustavi',
            'price' => 140
        ],
        [
            'city' => 'Samtredia',
            'price' => 300
        ],
        [
            'city' => 'Kobuleti',
            'price' => 200
        ],
        [
            'city' => 'Borjomi',
            'price' => 230
        ]
    ]
        ?>

        <form action="" method="post">
            <?php
            for ($i=0; $i < count($travelling); $i++) { 
            ?>

            <label><?=$travelling[$i]['city']?></label>
            <br><br>
            <input type="number" name="days[]" placeholder="Days">
            <input type="hidden" name="prices[]" value="<?= $travelling[$i]['price'] ?>">
            <br><br>

            <?php
            }
            ?>

            <button name="book">book</button>
        </form>

        <?php
        if(isset($_POST['book'])){
            // print_r($_POST['days']);
            $days = $_POST['days'];
            $prices = $_POST['prices'];
            $new_array = []; 
            $total_price =0;

            for ($i=0; $i < count($days); $i++) { 
                if($days [$i] != ''){
                    $new_array[] = $days[$i];
                    $total_price += $days[$i] *  $prices[$i];
                }
            }

            // echo count($new_array);
            // echo count($_POST['days']);

            if(count($new_array)<=3){
                if($total_price>5000){
                    echo 'Over your budget';
                }
                else{
                    echo "Total Price: $" . $total_price;
                }
            }
            else{
                echo 'choose only 3 cities';
            }

        }
        ?>
</body>
</html>