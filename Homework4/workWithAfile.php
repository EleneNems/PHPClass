<?php

    $message='';

    if(isset($_POST["file_create"])) {
        if(!empty($_POST["name_txt"])) {
            $filename = $_POST["name_txt"];
            $filePath = 'txtFiles/'. $filename;

            if(!is_file($filePath.".txt")) {
                fopen($filePath.".txt",'w');
            }
            else{
                $message = "File already exists";
            }


        }
        else {
            $message='Please input the name';
        }


    }

    $content = scandir('txtFiles/');
    print_r($content);

    if (isset($_GET['drop'])) {
        $deleting_item =  $_GET['drop']; 
    
        if (file_exists($deleting_item) && is_file($deleting_item)) {
            unlink($deleting_item);
        }
    }    

    $w_message = '';

    if(isset($_POST['write'])) {
        $selected_file = 'txtFiles/' .$_POST['selected_file'];
        $text_content = $_POST['text_content'];

        if(is_file($selected_file) && file_exists($selected_file)){
            $file = fopen($selected_file,'a');

            if ($file) {

                fwrite($file, $text_content);
                fclose($file);
                $w_message = "Text written to file successfully!";
            }
        }
    }

    $readInfo='';

    if(isset($_POST['read'])) {
        $selected_file_read = 'txtFiles/'.$_POST['selected_file_read'];

        if(is_file($selected_file_read) && file_exists($selected_file_read)) {
            $file = fopen($selected_file_read,'r');

            if($file){
                while (($line = fgets($file)) !== false) {
                    $readInfo .= $line;
                }
            }

            fclose($file);

        }
    }

?>