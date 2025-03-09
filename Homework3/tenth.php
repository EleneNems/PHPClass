<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>დაწერეთ ფუნქცია რომელიც შეამოწმებს ჩატვირთული url შეიცავს თუ არა რიცხვებს.</p>

    <form action="" method="post">
        <input type="text" name="url" placeholder="URL input">
        <button name="checking">Check</button>
    </form>

    <?php
        function checking_url( $url ) {
            if(preg_match("/\d/", $url)){
                return 'It contains numbers';
            }
            else{
                return 'It doesnt contain numbers';   
            }
        }

        if(isset($_POST['checking'])){
            $url = $_POST['url'];
            echo "<p>". checking_url($url)."</p>";
        }
    ?>
</body>
</html>