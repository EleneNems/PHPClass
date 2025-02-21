<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            margin:auto;
            display: flex;
        }
    </style>
</head>
<body>

    <div class="container">
        <form action="davalebis.php", method="get">
            <input type="text" name="name" placeholder="Enter your name">
            <br><br>
            <input type="text" name="lastname" placeholder="Enter your lastname">
            <br><br>
            <input type="text" name="position" placeholder="Enter your position">
            <br><br>
            <input type="text" name="salary" placeholder="Enter your salary">
            <br><br>
            <input type="text" name="tax" placeholder="Enter your tax">
            <br><br>
            <button>Continue</button>
        </form>
    </div>

</body>
</html>