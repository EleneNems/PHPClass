<?php
$results = mysqli_query($conn, 'select * from hotels');
?>

<table>
    <tr>
        <th>name</th>
        <th>address</th>
        <th>rate</th>
        <th>Actions</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($results)) {
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['rate'] ?></td>
            <td>
                <a href="?nav=hotels&edit=<?= $row['id'] ?>">Edit</a>
                <a href="?nav=hotels&delete=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<br><br>
<a href="?nav=hotels&add">
    <button>Add</button>
</a>


<?php
if (isset($_GET['add'])) {
    ?>
    <form method="post">
        <input type="text" name="name">
        <br>
        <input type="text" name="address">
        <br>
        <input type="number" name="rate">
        <br>
        <button name="addBtn">Add Hotel</button>
    </form>
    <?php
}
?>

<?php
if (isset($_POST['addBtn'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $rate = $_POST['rate'];

    $query = "insert into hotels(name, address, rate) values('$name', '$address', '$rate')";
    mysqli_query($conn, $query);
    header('Location: first.php?nav=hotels');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "delete from hotels where id=$id";
    mysqli_query($conn, $query);
    header('Location: first.php?nav=hotels');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $s_q = 'select * from hotels where id=' . $id;
    $result = mysqli_query($conn, $s_q);
    $row1 = mysqli_fetch_assoc($result);
    ?>
    <form method="post">
        <input type="text" name="name" value="<?= $row1['name'] ?>">
        <br>
        <input type="text" name="address" value="<?= $row1['address'] ?>">
        <br>
        <input type="number" name="rate" value="<?= $row1['rate'] ?>">
        <br>
        <button name="editBtn">Edit Hotel</button>
    </form>
    <?php
    if (isset($_POST['editBtn'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $rate = $_POST['rate'];

        $u_q = "update hotels set name='$name', address='$address', rate='$rate' where id=$id";

        mysqli_query($conn, $u_q);
        header('Location: first.php?nav=hotels');
    }
}
?>