<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            justify-self: center;
            padding: 10px;
        }

        form input, button{
            margin: 5px;
        }

        p{
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <form method="post">
        <input type="number" name="num1" placeholder="Number 1">
        <input type="number"  name="num2" placeholder="Number 2">
        <input type="number"  name="num3" placeholder="Number 3">

        <button name="sum">sum</button>
        <button name="product">product</button>
    </form>

    <?php
        $num1 =(float)($_POST['num1'] ?? 0);
        $num2 = (float)($_POST['num2'] ?? 0);
        $num3 = (float)($_POST['num3'] ?? 0);
        // $operation = $_POST['operation'] ?? '';
        $nameSum = $_POST['sum'] ?? '0';
        $nameProd = $_POST['product'] ?? '';

        function sum($num1, $num2, $num3){
            return $num1 + $num2 + $num3;
        }

        function product($num1, $num2, $num3) {
            return $num1 * $num2 * $num3;
        }

        if(isset($_POST['sum'])){
            echo "<p>The sum is: ". sum($num1, $num2, $num3). "</p>";
        }

        if(isset($_POST['product'])){
            echo "<p>The product is: " . product($num1, $num2, $num3) . "</p>";
        }

        // if($operation ==='Sum'){
        //     $result = $num1+$num2+$num3;
        //     echo "<p>Result: $result </p>";
        // }
        // else if($operation === "product") {
        //     $result = $num1 * $num2 * $num3;
        //     echo "<p>Result: $result</p>";
        // }
    ?>
</body>
</html>
