<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <br>
        <button name="upload">Upload</button>
    </form>

    <?php
    if (isset($_POST['upload'])) {
        $file = $_FILES['file'];
        $directory = 'first/';
        $extension = pathinfo($file['name'])['extension'];
        $max_size = 100 * 1024 * 1024;


        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
            if ($file['size'] < $max_size) {
                move_uploaded_file($file['tmp_name'], $directory . $file['name']);

            } else {
                echo "File size is too large.";
            }
        } else {
            echo "Invalid file type";
        }
    }
    ?>
</body>

</html>