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
    <form action="" method="post">
        <input type="text" name="file_n" placeholder="Enter file name">
        <br><br>
        <button name="create">Create</button>
    </form>

    <?php
        if(isset($_POST['create'])){
            if(!empty($_POST['file_n'])){
                $file_n = $_POST['file_n'];

                if(!is_file('uploads2/'.$file_n.'.txt')){
                    fopen('uploads2/'.$file_n.'.txt', 'w');
                }
                else{
                    echo "file already exists";
                }
            }
            else{
                echo "Please enter a file name.";
            }
        }

        $files = scandir('uploads2')
    ?>

    <table>
        <tr>
            <th>Name</th>
            <th>Delete</th>
            <th>Write</th>
            <th>Read</th>
        </tr>

        <?php
            for ($i=2; $i < count($files); $i++) { 
        ?>
            <tr>
                <td><?=$files[$i]?></td>
                <td>
                    <a href="?drop=<?='uploads2/'.$files[$i]?>">Delete</a>
                </td>
                <td>
                    <a href="?write=<?='uploads2/'.$files[$i]?>">Write</a>
                </td>
                <td>
                    <a href="?read=<?='uploads2/'.$files[$i]?>">
                        Read
                    </a>   
                </td>
            </tr>
        <?php
            }

            if(isset($_GET['drop'])){
                $deleting_item = $_GET['drop'];
                if(file_exists($deleting_item) && is_file($deleting_item)){
                    unlink($deleting_item);
                }
            }

            if(isset($_GET['write'])){
                echo '<form action="" method="post">';
                echo '<textarea name="text_write"></textarea>';
                echo '<br><br>';
                echo '<button name="enter">Enter</button>';
                echo '</form>';
                
                if(isset($_POST['enter'])){
                    $write_item = $_GET['write'];
                    $text_write = $_POST['text_write'];
                    $file = fopen($write_item, 'a');
                    fwrite($file,$text_write);
                    fclose($file);
                }
            }

            if(isset($_GET['read'])){
                $read_item = $_GET['read'];
                $file = fopen($read_item, 'r');

                ///kitxulobs mtlianad
                $content = fread($file, filesize($read_item));
                echo $content;

                ///kitxulobs striqonebad
                while (!feof($file)) {
                    echo fgets($file).'<br>';
                }

                ///gamoitans meore striqons marto
                fgets($file);
                echo fgets($file);

            }
        ?>
    </table>
    
    
    

</body>
</html>