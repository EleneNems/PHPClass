<?php
    $q = "select id, name from hotels";
    $result= mysqli_query($conn, $q);
?>

<form method="post">
    <select name="hotel_name">
        <?php
            while($h_row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?=$h_row['id']?>"><?=$h_row['name']?></option>
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
    <input type="text" name="status">
    <br>
    <button name="add">Add a room</button>
</form>

<?php
    if(isset($_POST['add'])){
        $hotel_name = mysqli_real_escape_string($conn, $_POST['hotel_name']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $q_add = "insert into rooms(hotel_id, number, capacity, price, status) values('$hotel_name', '$number','$capacity', '$price', '$status')";
        
        mysqli_query($conn, $q_add);

        header("Location: http://localhost/PHPClass/Homework6/roomsTable/");
    }

?>