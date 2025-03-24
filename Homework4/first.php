<?php
    include "uploading.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="img_container">
        <h2>Upload Your Image</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept=".png, .jpg, .gif, .jpeg">

            <br>
            <button name="upload">Upload Files</button>

            <p><?=$message?></p>
        </form>

    </div>
</body>
</html>