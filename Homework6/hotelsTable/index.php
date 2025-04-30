<?php
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Table</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Rate</th>
                <th>Created_At</th>
                <th>Actions</th>
            </tr>

            <?php
            $q_hotels = "Select * from hotels";
            $result = mysqli_query($conn, $q_hotels);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['name']?></td>
                <td><?=$row['address']?></td>
                <td><?=$row['rate']?></td>
                <td><?=$row['crated_at']?></td>
                <td>
                    <a href="?edit=<?=$row['id']?>">Edit</a> - 
                    <a href="?drop=<?=$row['id']?>">Drop</a>
                </td>
            </tr>
            <?php
            }

            if(isset($_GET['drop'])){
                $id = $_GET['drop'];
                mysqli_query($conn, "delete from hotels where id = '$id'");
                header("Location: http://localhost/PHPClass/Homework6/hotelsTable/");
            }else if(isset($_GET['edit'])){
                include "edit.php";
            }
            else if(isset($_GET['add']));
                include "add.php";
            ?>
        </table>

        <br>
        <button><a href="?add">Add</a></button>
    </main>
</body>

</html>