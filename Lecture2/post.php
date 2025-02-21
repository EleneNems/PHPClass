<h1>Post Method</h1>

<?php
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<div>" .$_POST['email']. "</div>";
    echo "<div>" .$_POST['pass']. "</div>";
?>