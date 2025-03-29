<form action="" method="post" style="margin-top: 20px;">
    <textarea name="input_text"></textarea>
    <br>
    <button name="insert">Insert</button>
</form>

<?php
if(isset($_POST['insert'])){
    if(!empty($_POST['input_text'])){
        $file_path = $_GET['insert'];
        $text = $_POST['input_text'];

        $file = fopen($file_path, 'a');
        fwrite($file, $text . "\n");
        fclose($file);
        echo 'Text inserted successfully';
        
        header('location:index.php');
    }
    else{
        echo "Please enter some text.";
    }
}
?>