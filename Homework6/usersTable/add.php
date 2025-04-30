<?php
$roles_query = mysqli_query($conn, "SELECT * FROM roles");
?>


<form method="post">
    <select name="role_id">
        <?php
        while ($role = mysqli_fetch_assoc($roles_query)) {
        ?>
            <option value="<?=$role['id']?>"><?=$role['status']?></option>
        <?php
        }
        ?>
    </select>
    <br>
    <input type="text" name="name">
    <br>
    <input type="text" name="lastname">
    <br>
    <input type="text" name="email">
    <br>
    <input type="text" name="password">
    <br>
    <input type="text" name="mobile">
    <br>
    <button name="add">add row</button>
</form>

<?php
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);

    $query = "Insert into users(name, lastname, email, password, mobile, role_id) values('$name', '$lastname', '$email', '$password', '$mobile', '$role_id')";

    mysqli_query($conn, $query);
    header("Location: http://localhost/PHPClass/Homework6/");
}
?>