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
    <?php
        $arr=[];
        for ($i=0; $i < 12; $i++) { 
            $rand=rand(10, 100);
            array_push($arr, $rand);
        }
        // print_r($arr)
    ?>

    <form method="post">
        <input type="text" name="num" placeholder="Enter X here">
        <br><br>
        <button name="enter">Enter</button>
    </form>

    <?php
        if(isset($_POST['enter'])){
            $x = $_POST['num'];
            $less=0;
            $more=0;
            for ($i=0; $i < 12; $i++) { 
                if($arr[$i]<$x){
                    $less++;
                }
                elseif ($arr[$i]>$x) {
                    $more++;
                }
            }

            echo "more than X:".$more."<br>Less than X:".$less;
        }
    ?>
</body>

</html>