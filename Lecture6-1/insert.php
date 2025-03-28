<div>
    <form action="" method="post">
        <textarea name="text_f" rows="10" cols="30"></textarea>
        <br><br>
        <button name="insert_f">Insert</button>
    </form>
</div>

<?php
    if(isset($_POST['insert_f'])){
        $text = $_POST['text_f'];

        $file = fopen($_GET['insert'], 'a');
        fwrite($file, $text);
        fclose($file);

        header('location:index.php');
    }
?>