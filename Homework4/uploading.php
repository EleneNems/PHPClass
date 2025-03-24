<?php

    $message = '';

    if(isset($_POST["upload"])){
        if(isset($_FILES["image"]) && $_FILES["image"]["size"]!=0){
            $image = $_FILES['image'];

            // print_r( $image );

            $upload_dir = 'uploads/';
            $max_size = 100 * 1024 * 1024;
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            if(!in_array($image['type'], $allowed_types)){
                $message = 'Only JPG, PNG & GIF files are allowed.';
            }
            elseif($image['size'] > $max_size){
                $message = 'The file is too large, has to be less than 100MB';
            }
            else{
                $path = $upload_dir . $image['name'];

                if(move_uploaded_file($image['tmp_name'], $path)){
                    $message = 'File has been uploaded';
                }
                else{
                $message = 'Failed to upload a file';
                }
            }
        }
        else{
            $message = 'First upload a file';
        }
    }
?>