<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            border: 1px solid;
            padding: 10px;
            margin: 10px;
            width: 200px;
        }

        
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="">

        <br><br>
        <button name="upload">Upload</button>
    </form>

    <?php
        if(isset($_POST['upload'])){
            $file = $_FILES['file'];
            print_r($file);
            
            print_r(pathinfo($file['name']));
            $extension = pathinfo($file['name'])['extension'];

            $max_size = 100 * 1024 * 1024;

            if($extension=='jpg'||$extension=='png'||$extension=='gif'){
                if($file['size']< $max_size){
                    move_uploaded_file($file['tmp_name'], 'uploads/'. $file['name']);
                }
                else{
                    echo "File is too large";
                }
            }
            else{
                echo "The file has to have a jpg png or gif extensions";
            }
        }
    ?>
</body>
</html>