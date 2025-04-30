<?php
$id = $_GET['edit'];
$result = mysqli_query($conn, "Select * from users where id = '$id'");
$rows = mysqli_fetch_assoc($result);
?>

<form method="post">
    <input type="text" name="name" value="<?= $rows['name'] ?>">
    <br>
    <input type="text" name="lastname" value="<?= $rows['lastname'] ?>">
    <br>
    <input type="text" name="email" value="<?= $rows['email'] ?>">
    <br>
    <input type="text" name="password" value="<?= $rows['password'] ?>">
    <br>
    <input type="text" name="mobile" value="<?= $rows['mobile'] ?>">
    <br>
    <button name="edit">Edit</button>
</form>

<?php
    if(isset($_POST['edit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']); 
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']); 
        $email = mysqli_real_escape_string($conn, $_POST['email']); 
        $password = mysqli_real_escape_string($conn, $_POST['password']); 
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']); 

        $update = "update users set name ='$name', lastname= '$lastname', email='$email', password = '$password', mobile = '$mobile' where id = '$id'";

        if(mysqli_query($conn, $update)){
            header("Location:http://localhost/PHPClass/Homework6/");
        }
    }
?>