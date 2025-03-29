<?php
    include 'work_with_files.php';
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
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="">
            <br>
            <button name="file_u">Upload file</button>
        </form>
        
        <div class="content_container">
            <?php
                for ($i=2; $i < count($content); $i++) { 
                    
            ?>
             <div>
                <p><?=$content[$i]?></p>
                <span>
                <a href="?drop=<?='storage/'.$content[$i]?>">Delete</a>
                <?php
                    $info = pathinfo($content[$i]);
                    $extension = $info['extension'];

                    if($extension  == 'txt'){

                ?>
                    <a href="?insert=<?='storage/'.$content[$i]?>">Insert</a>
                    <a href="?read=<?='storage/'.$content[$i]?>">Read</a>
                <?php
                }
                ?>
                </span>
            </div>
            <?php
                }            
            ?>

        </div>
        <?php
        if(isset($_GET['insert'])){
            include 'insert.php';
        }

        if(isset($_GET['read'])){
            include 'read.php';
        }
        ?>


    </div>
</body>
</html>