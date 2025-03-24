<?php
$message_upload = '';
$upload_dir = "uploads3/";
$content = scandir($upload_dir);
print_r($content);

if (isset($_POST['upload'])) {
    if (isset($_FILES['files']) && $_FILES['files']['size'] != 0) {
        $files = $_FILES['files'];

        $max_size = 100 * 1024 * 1024;
        $allowed_types = ["image/jpeg", "image/png", "image/gif"];

        $file_count = count(scandir($upload_dir)) - 2;

        $new_name = ($file_count + 1) . "-" . date("d-m-Y") . "." . pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);

        if (!in_array($files["type"], $allowed_types)) {
            $message_upload = 'Only png, jpg and gif files are allowed.';
        } elseif ($files['size'] > $max_size) {
            $message_upload = 'The file size is too large. It cant be more than 100MB';
        } else {
            $path = "uploads3/" . $new_name;

            if (move_uploaded_file($files['tmp_name'], $path)) {
                $message_upload = 'Uploaded Successfully';
            } else {
                $message_upload = 'Upload failed!';
            }
        }
    }

    $content = scandir($upload_dir);
}

if(isset($_GET['drop'])){
    $deleting_item = $_GET['drop'];
    if(is_file($deleting_item)&& file_exists($deleting_item)) 
    {
        unlink($deleting_item);

    }
    
}

?>