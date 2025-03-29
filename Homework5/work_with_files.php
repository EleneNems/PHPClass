<?php
    $content = scandir('storage');

    if(isset($_POST['file_u'])){
        $file = $_FILES['file'];

        if($file['name']== null){
            echo "Please select a file.";
        }
        else{
            print_r($file);
            move_uploaded_file($file['tmp_name'], 'storage/'.$file['name']);
        }
    }

    if(isset($_GET['drop'])){
        $drop = $_GET['drop'];
        if(is_file($drop)){
            unlink($drop);
        }
    }
?>