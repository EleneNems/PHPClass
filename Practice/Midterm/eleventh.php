<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            border: 1px solid;
            padding: 10px;
            margin: 10px;
            width: 200px;
        }

        table {
            border-collapse: collapse;
            width: 300px;
            margin: 10px;
        }

        table tr th,
        tr td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <br><br>
        <button name="upload">upload</button>
    </form>

    <?php
    if (isset($_POST['upload'])) {
        $file = $_FILES['file'];
        $max_size = 100 *1024*1024;
        $extension = pathinfo($file['name'])['extension'];
        $dir = scandir('uploads3');
        $file_count = count($dir)-1;

        if($extension=='jpg'||$extension=='png'||$extension=='gif'){
           if($file['size']<$max_size){
            move_uploaded_file($file['tmp_name'], to: "uploads3/".$file_count.'-'.date('d-m-y').'.'.$extension);
           }
           else{
            echo 'file is too big';
           }
        }
        else{
            echo "Invalid file type";
        }
    }
    ?>
</body>

</html>