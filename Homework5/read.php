<?php
    if(isset($_GET['read'])){
        $file = $_GET['read'];
        $f = fopen($file, 'r');
        $text_content = fread($f, filesize($file));
        fclose($f);
        echo "<p>" .$text_content. "</p>";
    }
?>