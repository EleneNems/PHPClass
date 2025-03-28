<div>
    <?php
        $file = $_GET['read'];
        $f = fopen($file, 'r');
        $content = fread($f, filesize($file));
        // $content = fgets($f);  //pirveli striqoni

        // while(!feof($f)){
        //     echo fgets($f).'<br>';
        // }
        fclose($f);
        echo $content;
    ?>
</div>
