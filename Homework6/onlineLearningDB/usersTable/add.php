<form method="post">
    <br>
    <input type="text" name="username">
    <br><br>
    <input type="text" name="password">
    <br><br>
    <input type="text" name="email">
    <br><br>
    <input type="text" name="fullname">
    <br><br>
    <select name="role">
        <option value="Admin">Admin</option>
        <option value="Admin">User</option>
        <option value="Admin">Manager</option>
    </select>
    <br><br>
    <button name="add">Add A User</button>
</form>

<?php
if(isset($_POST['add'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $insert_q = "insert into users(username, password, email, fullname, role) values('$username', '$password', '$email', '$fullname', '$role')";

    mysqli_query($conn, $insert_q);
    header("Location: http://localhost/PHPClass/Homework6/onlineLearningDB/usersTable/");

}
?>