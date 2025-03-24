<?php
include('folder_file.php')
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <header>
        <form action="" method='post'>
            <input type="text" name="folder"> - <button name="folder_create">Create a folder</button> <span
                class="error"><?= $error_fol ?></span>
            <br>
            <input type="text" name="file"> - <button name="file_create">Create a file</button> <span
                class="error"><?= $error_file ?></span>
        </form>
    </header>

    <main>
        <table>
            <tr>
                <th>Status</th>
                <th>Size (bytes)</th>
                <th>Name</th>
                <th>Action</th>
            </tr>

            <?php

            for ($i = 2; $i < count($content); $i++) {
                $itemPath = "$storage_patch/$content[$i]";
                if (is_dir($itemPath)) {
                    $status = "Folder";
                } else {
                    $status = "File";
                }
                ?>

                <tr>
                    <td><?= $status ?></td>
                    <td><?=filesize($itemPath)?></td>
                    <td><?= $content[$i] ?></td>
                    <td>
                        <?php
                        if (is_dir($itemPath)) {
                            echo "
                                <a href='?drop=$itemPath'>Delete</a>
                            ";
                        } else {
                            echo "
                                <a href='?drop=$itemPath'>Delete</a>
                            ";
                        }
                        ?>

                    </td>
                </tr>

                <?php
            }
            ?>



        </table>
    </main>
</body>

</html>