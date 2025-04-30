<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Table</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Hotel</th>
                <th>Number</th>
                <th>Capacity</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created_At</th>
                <th>Actions</th>
            </tr>
        <?php
            $q_room = "select * from rooms join hotels on rooms.hotel_id = hotels.id";
            $result = mysqli_query($conn, $q_room);

            while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['name']?></td>
                <td><?=$row['number']?></td>
                <td><?=$row['capacity']?></td>
                <td><?=$row['price']?></td>
                <td><?=$row['status']?></td>
                <td><?=$row['created_at']?></td>
                <td>
                    <a href="?edit=<?=$row['id']?>">Edit</a> - 
                    <a href="?drop=<?=$row['id']?>">Delete</a>
                </td>
            </tr>

        <?php
        }
        ?>
        </table>

        <br><br>
        <a href="?add"><button>Add</button></a>


        <?php
            if(isset($_GET['add'])){
                include "add.php";
            }
            else if(isset($_GET['drop'])){
                $id = $_GET['drop'];
                $d_q = "delete from rooms where id = '$id'";
                mysqli_query($conn, $d_q);
                header("Location: http://localhost/PHPClass/Homework6/roomsTable/");
            }
            else if(isset($_GET['edit'])){
                include "edit.php";
            }
        ?>
    </main>
</body>
</html>