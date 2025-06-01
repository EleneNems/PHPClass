<?php
include 'conn.php';
$result = mysqli_query($conn, "select * from hotels");
?>

<table>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Rate</th>
        <th>actions</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['rate'] ?></td>
            <td>
                <a href="?nav=hotels&drop=<?= $row['id'] ?>">Delete</a>
                <a href="?nav=hotels&edit=<?= $row['id'] ?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<br><br>
<a href="?nav=hotels&add"><button>Add</button></a>
<a href="?nav=hotels&write"><button>Write</button></a>

<?php
if (isset($_GET['write'])) {
    $filename = 'File/data.txt';
    $hotels = 'select * from hotels';
    $result = mysqli_query($conn, $hotels);
    if (!is_file($filename)) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $stream = fopen($filename, 'a');
            $data = $rows['id'].'-'.$rows['name'] . '-' . $rows['address'] . '-' . $rows['rate']."\n";
            fwrite($stream, $data);
            fclose($stream);
        }
    } else {
        echo "file already exists";
    }
}
if (isset($_GET['add'])) {
    ?>
    <form method="post">
        <input type="text" name="name">
        <br>
        <input type="text" name="address">
        <br>
        <input type="number" name="rate">
        <br>
        <button name="add">Add a hotel</button>
    </form>
    <?php
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $rate = $_POST['rate'];

    $i_q = "insert into hotels(name, address, rate) values('$name', '$address', '$rate')";
    mysqli_query($conn, $i_q);
}

if (isset($_GET['drop'])) {
    $id = $_GET['drop'];

    mysqli_query($conn, "delete from hotels where id ='$id'");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "select * from hotels where id = '$id'");
    $row = mysqli_fetch_assoc($res);
    ?>

    <form method="post">
        <input type="text" name="name" value="<?= $row['name'] ?>">
        <br>
        <input type="text" name="address" value="<?= $row['address'] ?>">
        <br>
        <input type="text" name="rate" value="<?= $row['rate'] ?>">
        <br>
        <button name="edit">Edit Hotel</button>
    </form>

    <?php
    if (isset($_POST['edit'])) {
        $name = mysqli_escape_string($conn, $_POST['name']);
        $address = mysqli_escape_string($conn, $_POST['address']);
        $rate = mysqli_escape_string($conn, $_POST['rate']);

        $q_i = "update hotels set name='$name', address='$address', rate='$rate' where id='$id'";
        mysqli_query($conn, $q_i);
    }
}
?>