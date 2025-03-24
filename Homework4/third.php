<?php
    include 'workWithAfile.php'
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
        <form action="" method="post">
            <h2>Create a txt file</h2>
            <input type="text" name="name_txt"> 
            <br> <br>
            <button name="file_create">Create</button>
            <br>
            <p><?=$message?></p>
        </form>

       
    </div>

    <table class="table-1">
        <tr>
            <th>Name</th>
            <th>Delete</th>
        </tr>
    
        <?php
            for ($i = 2; $i < count($content); $i++) {
                $filePath = 'txtFiles/'.$content[$i];
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

    <h2>Write inside the files</h2>

    <form action="" method="post">
        <select name="selected_file">
            <?php
                for ($i = 2; $i < count($content); $i++){

            ?>
                <option value="<?=$content[$i]?>"><?=$content[$i]?></option>

            <?php
                }
            ?>
        </select>

        <br><br>

        <input type="text" placeholder="Enter your text:" name="text_content">
        
        <br><br>

        <button name="write">Write</button>

        <p><?=$w_message?></p>
    
    </form>


    <form action="" method="post">
        <select name="selected_file_read">
            <?php
                for ($i = 2; $i < count($content); $i++){

            ?>
                <option value="<?=$content[$i]?>"><?=$content[$i]?></option>

            <?php
                }
            ?>
        </select>

        <br><br>

        <button name="read">Read</button>

        <p><?=$readInfo?></p>
    
    </form>
</body>
</html>