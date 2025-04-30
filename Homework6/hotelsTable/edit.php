<?php
    $id = $_GET['edit'];
    $result = "select * from hotels where id = '$id'";
    $resultedit = mysqli_query($conn, $result);
    $rows = mysqli_fetch_assoc($resultedit);

?>

<form method="post">
    <input type="text" name="name" value="<?=$rows['name']?>">
    <br> 
    <input type="text" name="address" value="<?=$rows['address']?>">
    <br>
    <input type="text" name="rate" value="<?=$rows['rate']?>">
    <br>
    <button name="edit">edit</button>
</form>

<?php
    if(isset($_POST['edit'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $rate = mysqli_real_escape_string($conn, $_POST['rate']);

        $update_q = "update hotels set name = '$name', address = '$address',  rate = '$rate' where id = '$id'";

        mysqli_query($conn, $update_q);
        header("Location: http://localhost/PHPClass/Homework6/hotelsTable/");
    }
?>