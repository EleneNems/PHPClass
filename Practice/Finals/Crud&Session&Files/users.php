<?php
include 'conn.php';
$result = mysqli_query($conn, "select roles.id as roles_id, users.id as users_id, users.name, users.lastname, users.email, users.password, users.mobile, roles.status as roles_status from users join roles on roles.id=users.role_id");
?>

<table>
    <tr>
        <th>Role</th>
        <th>Name</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Password</th>
        <th>Mobile</th>
        <th>Actions</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['roles_status'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['lastname'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['password'] ?></td>
            <td><?= $row['mobile'] ?></td>
            <td>
                <a href="?nav=users&drop=<?= $row['users_id'] ?>">Delete</a>
                <a href="?nav=users&edit=<?= $row['users_id'] ?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<br><br>
<a href="?nav=users&add"><button>Add</button></a>

<?php
if (isset($_GET['add'])) {

    ?>
    <form method="post">
        <select name="role">
            <?php
            $roles = mysqli_query($conn, "select * from roles");
            while ($rolesres = mysqli_fetch_assoc($roles)) {
                ?>
                <option value="<?= $rolesres['id'] ?>"><?= $rolesres['status'] ?></option>
                <?php
            } ?>
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
        <button name="add">Add a hotel</button>
    </form>
    <?php
}

if (isset($_POST['add'])) {
    $role = $_POST['role'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];

    $i_q = "insert into users(role_id, name, lastname, email, password, mobile) values('$role','$name', '$lastname', '$email', '$password', '$mobile')";
    mysqli_query($conn, $i_q);
}

if (isset($_GET['drop'])) {
    $id = $_GET['drop'];

    mysqli_query($conn, "delete from users where id ='$id'");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "select * from users where id = '$id'");
    $row = mysqli_fetch_assoc($res);
    ?>

    <form method="post">

        <select name="role">
            <?php
            $rolesq = mysqli_query($conn, "select * from roles");
            while ($rolerows = mysqli_fetch_assoc($rolesq)) {
                ?>
                <option value="<?= $rolerows['id'] ?>"><?= $rolerows['status'] ?></option>
                <?php
            }
            ?>
        </select>

        <br>
        <input type="text" name="name" value="<?=$row['name']?>">
        <br>
        <input type="text" name="lastname" value="<?=$row['lastname']?>">
        <br>
        <input type="text" name="email" value="<?=$row['email']?>">
        <br>
        <input type="text" name="password" value="<?=$row['password']?>">
        <br>
        <input type="text" name="mobile" value="<?=$row['email']?>">
        <br>
        <button name="edit">Edit Hotel</button>
    </form>

    <?php
    if (isset($_POST['edit'])) {
        $role = mysqli_escape_string($conn, $_POST['role']);
        $name = mysqli_escape_string($conn, $_POST['name']);
        $lastname = mysqli_escape_string($conn, $_POST['lastname']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $mobile = mysqli_escape_string($conn, $_POST['mobile']);

        $q_i = "update users set role_id='$role', name='$name', lastname='$lastname', email='$email', password='$password', mobile='$mobile' where id='$id'";
        mysqli_query($conn, $q_i);
    }
}
?>