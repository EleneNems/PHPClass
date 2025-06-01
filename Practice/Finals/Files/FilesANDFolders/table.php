<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folder and File creation</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
        }

        .con {
            border: 1px solid black;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
        }

        table tr td,
        th {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    $content = scandir('Storage');
    ?>
    <div class="container">
        <div class="con">
            <form method="post">
                <input type="text" name="folderName"> - <button name="cr_folder">Create a Folder</button>
                <br><br>
                <input type="text" name="fileName"> - <button name="cr_file">Create a File</button>
            </form>
        </div>

        <table>
            <tr>
                <th>Status</th>
                <th>Size(bytes)</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>

            <?php
            $name = '';
            for ($i = 2; $i < count($content); $i++) {
                if (is_dir('Storage/' . $content[$i])) {
                    $name = 'Folder';
                } else {
                    $name = 'File';
                }
                ?>
                <tr>
                    <td><?= $name ?></td>
                    <td><?php
                    if ($name == 'Folder') {
                        echo '-';
                    } else {
                        echo filesize('Storage/' . $content[$i]);
                    }
                    ?></td>
                    <td><?= $content[$i] ?></td>
                    <td><?php
                    if ($name == 'Folder') {
                        echo "<a href='?delete=Storage/" . $content[$i] . "'>Delete</a>";
                    } else {
                        echo "<a href='?delete=Storage/" . $content[$i] . "'>Delete</a> ";
                        echo "<a href='?read=Storage/" . $content[$i] . "'>Read</a> ";
                        echo "<a href='?write=Storage/" . $content[$i] . "'>Write</a> ";
                    }
                    ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <?php
    if (isset($_POST['cr_folder'])) {
        $folderName = $_POST['folderName'];
        if (!is_dir('Storage/' . $folderName)) {
            mkdir('Storage/' . $folderName);
            header('location:table.php');
        } else {
            echo "Folder already exists";
        }
    }
    if (isset($_POST['cr_file'])) {
        $fileName = $_POST['fileName'];
        if (!is_file('Storage/' . $fileName . '.txt')) {
            fopen('Storage/' . $fileName . '.txt', 'w');
            header('location:table.php');
        } else {
            echo "File already exists";
        }
    }

    if(isset($_GET['delete'])){
        $delete = $_GET['delete'];

        if(is_dir($delete)){
            rmdir($delete);
            header('location:table.php');
        }
        else{
            unlink($delete);
            header('location:table.php');
        }
    }

    if(isset($_GET['write'])){
        include 'write.php';
    }
    if(isset($_GET['read'])){
        $file=$_GET['read'];
        $stream = fopen($file, 'r');
        while(!feof($stream)){
            echo fgets($stream);
        }
    }
    ?>
</body>
</html>