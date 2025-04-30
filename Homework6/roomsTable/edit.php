<?php
$id = $_GET['edit'];
$result = mysqli_query($conn, "Select * from rooms where id = '$id'");
$r_row = mysqli_fetch_assoc($result);

$q_hotel = "select id, name from hotels";
$h_row = mysqli_query($conn, $q_hotel);
?>

<form method="post">
    <select name="hotel_name">
        <?php
        while ($row = mysqli_fetch_assoc($h_row)) {

            ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php
        }
        ?>
    </select>
    <br>
    <input type="text" name="number" value="<?= $r_row['number'] ?>">
    <br>
    <input type="text" name="capacity" value="<?= $r_row['capacity'] ?>">
    <br>
    <input type="text" name="price" value="<?= $r_row['price'] ?>">
    <br>
    <input type="text" name="status" value="<?= $r_row['status'] ?>">
    <br><br>
    <button name="edit">Edit</button>
</form>

<?php
if (isset($_POST['edit'])) {
    $hotel_id = mysqli_real_escape_string($conn, $_POST['hotel_name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $update_q = "UPDATE rooms SET hotel_id = '$hotel_id', number = '$number', capacity = '$capacity', price = '$price', status = '$status' WHERE id = '$id'";


    mysqli_query($conn, $update_q);
    header("Location: http://localhost/PHPClass/Homework6/roomsTable/");
}
?>