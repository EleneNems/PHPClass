<?php
include 'conn.php';
$result = mysqli_query($conn, "SELECT rooms.id AS room_id, hotels.name, rooms.number, rooms.capacity, rooms.price, rooms.status
FROM rooms
JOIN hotels ON hotels.id = rooms.hotel_id
");
?>

<table>
    <tr>
        <th>Hotel</th>
        <th>number</th>
        <th>capacity</th>
        <th>price</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['number'] ?></td>
            <td><?= $row['capacity'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="?nav=rooms&drop=<?= $row['room_id'] ?>">Delete</a>
                <a href="?nav=rooms&edit=<?= $row['room_id'] ?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<br><br>
<a href="?nav=rooms&add"><button>Add</button></a>

<?php
if (isset($_GET['add'])) {
    $hotres=mysqli_query($conn, "select * from hotels");
    ?>
    <form method="post">
        <select name="id">
            <?php
            while ($hotrow=mysqli_fetch_assoc($hotres)) {
            ?>
                <option value="<?=$hotrow['id']?>"><?=$hotrow['name']?></option>
            <?php
            }
            ?>
        </select>
        <br>
        <input type="number" name="number">
        <br>
        <input type="number" name="capacity">
        <br>
        <input type="number" name="price">
        <br>
        <select name="status">
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
        </select>
        <button name="add">Add a room</button>
    </form>
    <?php
}

if (isset($_POST['add'])) {
    $hotel = $_POST['id'];
    $number = $_POST['number'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $i_q = "insert into rooms(hotel_id, number, capacity, price, status) values('$hotel','$number', '$capacity', '$price', '$status')";
    mysqli_query($conn, $i_q);
}

if (isset($_GET['drop'])) {
    $id = $_GET['drop'];

    mysqli_query($conn, "delete from rooms where id ='$id'");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $res = mysqli_query($conn, "SELECT * FROM rooms join hotels on hotels.id=rooms.hotel_id WHERE rooms.id = '$id'");
    $row1 = mysqli_fetch_assoc($res);

    $hotres = mysqli_query($conn, "SELECT * FROM hotels");
    ?>

    <form method="post">
        <select name="hotel_id">
            <?php
            while ($hotrow = mysqli_fetch_assoc($hotres)) {
                ?>
                <option value="<?= $hotrow['id'] ?>">
                    <?= $hotrow['name'] ?>
                </option>
                <?php
            }
            ?>
        </select>
        <br>
        <input type="number" name="number" value="<?= $row1['number'] ?>">
        <br>
        <input type="number" name="capacity" value="<?= $row1['capacity'] ?>">
        <br>
        <input type="number" name="price" value="<?= $row1['price'] ?>">
        <br>
        <select name="status">
            <option value="available">Available</option>
            <option value="booked">Booked</option>
        </select>
        <br>
        <button name="edit">Edit a room</button>
    </form>

    <?php
    if (isset($_POST['edit'])) {
        $hotel = mysqli_real_escape_string($conn, $_POST['hotel_id']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $q_i = "UPDATE rooms set hotel_id='$hotel', number='$number', capacity='$capacity', price='$price', status='$status' WHERE id='$id'";
        mysqli_query($conn, $q_i);
    }
}
?>