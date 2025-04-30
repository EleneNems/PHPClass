<form method="post">
    <input type="text" name="name">
    <br>
    <input type="text" name="address">
    <br>
    <input type="text" name="rate">
    <br>
    <button name="add">Add A Hotel</button>
    <br><br>
</form>

<?php
    if (isset($_POST['add'])) {
        if(!empty($_POST['name'])|| !empty($_POST['address'])||!empty($_POST['rate'])){
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $rate = mysqli_real_escape_string($conn, $_POST['rate']);

            $q_insert = "insert into hotels(name, address, rate) values('$name', '$address', '$rate')";

            mysqli_query($conn, $q_insert);
            header("Location: http://localhost/PHPClass/Homework6/hotelsTable/");
        }   
        else{
            echo "Please enter all the inputs";
        }
    }
?>