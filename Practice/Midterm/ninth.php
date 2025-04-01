<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            border: 1px solid;
            padding: 10px;
            margin: 10px;
            width: 200px;
        }

        table{
            border-collapse: collapse;
            width: 300px;
            margin: 10px;
        }

        table tr th, tr td{
            border: 1px solid;
        }
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="">
        <br><br>
        <button name="upload">Upload</button>
    </form>

    <?php
        if(isset($_POST['upload'])){
            $file = $_FILES['file'];
            $max_size = 50 *1024*1024;

            if($file['size']<$max_size){
                move_uploaded_file($file['tmp_name'], 'uploads1/'.$file['name']);
            }
            else{
                echo "File size is too large";
            }
        }

        $files = scandir('uploads1');
        // print_r($files);
    ?>
    
    <table>
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>

        <?php
            for ($i=2; $i < count($files); $i++) { 
        ?>

            <tr>
                <td><?=$files[$i]?></td>
                <td>
                    <a href="?drop=<?='uploads1/'.$files[$i]?>">Delete</a>
                    <a href="<?='uploads1/'.$files[$i]?>">Download</a>
                </td>
            </tr>

        <?php
        }

        if(isset($_GET['drop'])){
            $deleting_item = $_GET['drop'];
            if(is_file($deleting_item)&& file_exists($deleting_item)){
                unlink($deleting_item);
            }
        }
        ?>
    </table>

</body>
</html>