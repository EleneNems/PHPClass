<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 300px;
        }
    </style>
</head>

<body>

    <?php
    $directory = 'second';
    $content = scandir($directory);
    ?>

    <form method="post">
        <input type="text" name="name">
        <br><br>
        <button name="create">Create</button>
    </form>
    <br><br>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>

        <?php
        for ($i = 2; $i < count($content); $i++) {

            ?>
            <tr>
                <td><?= $content[$i] ?></td>
                <td>
                    <a href="?delete=<?= 'second/' . $content[$i] ?>">Delete</a>
                    <a href="?read=<?= 'second/' . $content[$i] ?>">Read</a>
                    <a href="?write=<?= 'second/' . $content[$i] ?>">Write</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
    if (isset($_POST['create'])) {
        $file_name = $_POST['name'];
        $file_path = "second/" . $file_name . ".txt";

        if (!is_file($file_path)) {
            fopen($file_path, 'w');
            header('location: second.php');
        } else {
            echo 'file already exists';
        }
    }

    if (isset($_GET['write'])) {
        $file_name = $_GET['write'];
        ?>
        <form method="post">
            <textarea name="text"></textarea>
            <br>
            <button name="write">Write</button>
        </form>
        <?php
        if (isset($_POST['write'])) {
            $text = $_POST['text'];
            $stream=fopen($file_name, 'w');
            fwrite($stream, $text);
            fclose($stream);
        }
    }

    if(isset($_GET['read'])){
        $file_name=$_GET['read'];
        $stream=fopen($file_name, 'r');
        // striqonebit
        // while(!feof($stream)){
        //     echo fgets($stream).'<br>';
        // }
        // chveulebrivi
        $text=fread($stream, filesize($file_name));
        echo $text;
        fclose($stream);
    }

    if(isset($_GET['delete'])){
        $file_name=$_GET['delete'];
        if(is_file($file_name)){
            unlink($file_name);
            header('location: second.php');
        }
    }
    ?>
</body>

</html>