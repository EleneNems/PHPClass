<?php
    $message = '';
    $upload_dir = "uploads2/";

    $content = scandir($upload_dir);

    if (isset($_POST['upload'])) {
        if (isset($_FILES['files']) && $_FILES['files']['size'] != 0) {
            $files = $_FILES['files'];

            $max_size = 50 * 1024 * 1024;

            if ($files['size'] > $max_size) {
                $message = 'The file is more than 50MB';
            } else {
                $path = $upload_dir . $files['name'];

                if (move_uploaded_file($files['tmp_name'], $path)) {
                    $message = 'The file has been uploaded successfully';
                }
            }
        }
        $content = scandir($upload_dir);
    }


    if (isset($_POST["delete_btn"])) {
        $file_delete = $upload_dir . $_POST['delete_file'];

        if (file_exists($file_delete)) {
            unlink($file_delete);
        } 

        $content = scandir($upload_dir);
    }

    if(isset($_POST['download_btn'])) {
        $download_file = $upload_dir . $_POST['download_file'];

        if (file_exists($download_file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($download_file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($download_file));
            readfile($download_file);
            exit;
        }
    }
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
        <h2>Upload Your Files</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="files" accept=".png, .jpg, .gif, .jpeg, .txt">
            <br>
            <button name="upload">Upload Files</button>

            <p><?= $message ?></p>

        </form>

        <h2>Delete a File</h2>
        <form action="" method="post">
            <select name="delete_file">
                <?php
                    for ($i = 2; $i < count($content); $i++) { 
                ?>
                    <option value="<?= $content[$i] ?>">
                        <?= $content[$i] ?>
                    </option>
                <?php
                    }
                ?>
            </select>
            <br>
            <br>
            <button name="delete_btn">Delete</button>
        </form>

        <h2>Download a File</h2>

        <form action="" method="post">
        <select name="download_file">
                <?php
                    for ($i = 2; $i < count($content); $i++) { 
                ?>
                    <option value="<?= $content[$i] ?>">
                        <?= $content[$i] ?>
                    </option>
                <?php
                    }
                ?>
            </select>
            <br><br>
            <button name="download_btn">Download</button>
        </form>

    </div>

</body>
</html>
