<?php
    $error_fol=''; 

    if (isset($_POST['folder_create'])) 
    {
    
        if (isset($_POST['folder']) && !empty($_POST['folder'])) 
        {
            $folderName = $_POST['folder'];
            $folderPath = "storage/".$folderName;
    
            if (!is_dir($folderPath)) {
                mkdir($folderPath);
                } 
                else {
                $error_fol = "Folder already exists";
            }
        }
        else
        {
            $error_fol = "Folder name is required";
        }
    }

    $error_file = '';

    if(isset($_POST['file_create'])){

        if(isset($_POST['file']) && !empty($_POST['file'])){
            $fileName = $_POST['file'];
            $filePath = "storage/".$fileName;

            if (!is_file($filePath.".txt")) {
                fopen($filePath.".txt", 'w');
            } else {
                $error_file = "File already exists";
            }
        }
        else{
            $error_file = "File name is required";
        }
    }

    $storage_patch = 'storage';
    $content = scandir($storage_patch);
    // echo "<pre>";
    // print_r($content);
    // echo "</pre>";
?>
