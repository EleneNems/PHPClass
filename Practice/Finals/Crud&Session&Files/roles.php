<?php
include 'conn.php';
$result = mysqli_query($conn, "select * from roles");
?>

<table>
    <tr>
        <th>Id</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="?nav=roles&drop=<?= $row['id'] ?>">Delete</a>
                <a href="?nav=roles&edit=<?= $row['id'] ?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<br><br>
<a href="?nav=roles&add"><button>Add</button></a>
<a href="?nav=roles&file"><button>Add with Files</button></a>

<?php
if (isset($_GET['file'])) {

    ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="status">
        <br>
        <button name="upload">upload</button>
    </form>

    <?php
    if (isset($_POST['upload'])) {
        $status = $_FILES['status'];
        $extension = pathinfo($status['name'])['extension'];
        if ($extension == 'txt') {
            move_uploaded_file($status['tmp_name'], 'File/' . $status['name']);
            $stream = fopen('File/' . $status['name'], 'r');
            $data = fread($stream, filesize('File/' . $status['name']));

            mysqli_query($conn, "INSERT INTO roles (status) VALUES ('$data')");
        } else {
            echo "Only .txt files are allowed";
        }
    }
}

if (isset($_GET['add'])) {

    ?>
    <form method="post">
        <input type="text" name="status">
        <br>
        <button name="add">Add a Role</button>
    </form>
    <?php
}

if (isset($_POST['add'])) {
    $status = $_POST['status'];

    $i_q = "insert into roles(status) values('$status')";
    mysqli_query($conn, $i_q);
}

if (isset($_GET['drop'])) {
    $id = $_GET['drop'];

    mysqli_query($conn, "delete from roles where id ='$id'");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "select * from roles where id = '$id'");
    $row = mysqli_fetch_assoc($res);
    ?>

    <form method="post">
        <input type="text" name="status" value="<?= $row['status'] ?>">
        <br>
        <button name="edit">Edit Roles</button>
    </form>

    <?php
    if (isset($_POST['edit'])) {
        $status = mysqli_escape_string($conn, $_POST['status']);

        $q_i = "update roles set status='$status' where id='$id'";
        mysqli_query($conn, $q_i);
    }
}
?>