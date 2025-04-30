<?php
    $id = $_GET['edit'];
    $user_q = "select * from users where userid = '$id'";
    $result = mysqli_query($conn, $user_q); 
    $row = mysqli_fetch_assoc($result);
?>

<form method="post">
    <input type="text" name="username" value="<?=$row['Username']?>">
    <br><br>
    <input type="text" name="password" value="<?=$row['Password']?>">
    <br><br>
    <input type="text" name="email" value="<?=$row['Email']?>">
    <br><br>
    <input type="text" name="fullname" value="<?=$row['FullName']?>">
    <br><br>
    <select name="role">
        <option value="admin">admin</option>
        <option value="user">user</option>
        <option value="manager">manager</option>
    </select>
    <br><br>
    <button name="edit">Edit</button>
</form>

<?php
    if(isset($_POST['edit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        $update_q = "update users set Username='$username', Password='$password', Email='$email', Fullname='$fullname', Role = '$role' where UserID = '$id'";

        mysqli_query($conn, $update_q);
        header("Location: http://localhost/PHPClass/Homework6/onlineLearningDB/usersTable/");
    }
?>