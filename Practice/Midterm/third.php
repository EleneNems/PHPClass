<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <p>განსაზღვრეთ 12 ელემენტიანი რიცხვითი მასივი. ელემენტებს მნიშვნელობები მიანიჭეთ [10; 100]-შუალედიდან. დაადგინეთ
რამდენი ელემენტია მასივში შეტანილ X რიცხვზე ნაკლები და რამდენი მეტი. X რიცხვის შეტანა მოახდინეთ $_POST მეთოდის
საშუალებით.</p>

    <form action="" method="post">
        <input type="number" name="x" placeholder="enter X">
        <br><br>
        <button name="enter">Enter</button>
        <br>
    </form>

    <?php
        if(isset($_POST['enter'])){
            if(!empty($_POST['x'])){
                $ran_array = [];
                $x = $_POST['x'];
                $less_than_x = 0;
                $more_than_x = 0;
                for ($i=0; $i < 12; $i++) { 
                    $random_num= rand(10, 100);
                    $ran_array[$i] = $random_num;
                    if($random_num< $x){
                        $less_than_x++;
                    }
                    elseif($random_num> $x)
                    {
                        $more_than_x++;
                    }
                }

                echo "<pre>";
                print_r($ran_array);
                echo "</pre>";

                echo "Numbers less than $x: $less_than_x";
                echo "Numbers more than $x: $more_than_x";
            }
            else{
                echo "Please enter a number";
            }
            
        }
    ?>
</body>
</html>