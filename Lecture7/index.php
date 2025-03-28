<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture 7</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="" method="post"  enctype="multipart/form-data">
            <input type="file" name="f_name">
            <br>
            <button name="upload">Upload File</button>
        </form>

        <div class="info">

        </div>
    </div>

    <?php
        $message = '';

        if(isset($_POST['upload'])){
            $dir = 'storage/';
            if(isset($_FILES['f_name'])){
                $files = $_FILES['f_name'];

                echo '<pre>';
                print_r($files);
                echo '</pre>';

                $path = $dir . $files['name'];

                $max_size = 4 * 1024 * 1024;
                $allowed_type = 'text/txt';

                if($files['size'] >= $max_size){
                   $message = "File is too large, Cant be bigger than 4MB" ;
                }
                else{
                    move_uploaded_file($files['tmp_name'], 'storage/'.time().'.'. pathinfo($files['name'])['extension']);
                }
                echo '<pre>';
                print_r(pathinfo( $files['name']));
                echo '</pre>';

                $message = pathinfo($files['name'])['extension'];
            }
        }
    ?>

</body>
</html >