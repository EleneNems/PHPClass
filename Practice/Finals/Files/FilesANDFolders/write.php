<form method="post" style="margin: 20px 0 0 82px;">
    <textarea name="text"></textarea>
    <br><br>
    <button name="insert">Write</button>
</form>

<?php
    $file=$_GET['write'];
    if(isset($_POST['insert'])){
        $text=$_POST['text'];
        $stream=fopen($file,'a');
        fwrite($stream,$text);
        fclose($stream);
    }
?>