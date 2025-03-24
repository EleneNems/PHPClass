<?php
include "imagesUpload.php";
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
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="files" id="file" accept=".jpg, .jpeg, .gif, .png">

            <br>
            <button name="upload">Upload</button>

            <p><?= $message_upload ?></p>
        </form>

    </div>

    <table class="table-1">
        <tr>
            <td>File Name</td>
            <td>Delete</td>
        </tr>

        <?php
            for ($i=2; $i < count($content); $i++) { 
                $filePath = "uploads3/". $content[$i];
        ?>

        <tr>
            <td><?=$content[$i]?></td>
            <td>
                <a href="?drop=<?=$filePath?>">Delete</a>
            </td>
        </tr>

        <?php
            }
        ?>
    </table>
</body>

</html>