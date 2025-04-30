<?php
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Table</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <table class="table1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Password</th>
                <th>Mobile</th>
                <th>Created_At</th>
                <th>Action</th>
            </tr>

            <?php
            $q_users = "Select * from Users";
            $result = mysqli_query($conn, $q_users);

            while ($row_users = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $row_users['id'] ?></td>
                    <td><?= $row_users['name'] ?></td>
                    <td><?= $row_users['lastname'] ?></td>
                    <td><?= $row_users['email'] ?></td>
                    <td><?= $row_users['password'] ?></td>
                    <td><?= $row_users['mobile'] ?></td>
                    <td><?= $row_users['created_at'] ?></td>
                    <td>
                        <a href="?edit=<?= $row_users['id'] ?>">Edit</a>
                        <a href="?drop=<?= $row_users['id'] ?>">Drop</a>
                    </td>
                </tr>

                <?php
            }

            if (isset($_GET['edit'])) {
                include "edit.php";
            } else if (isset($_GET['drop'])) {
                $id = $_GET['drop'];
                mysqli_query($conn, "Delete from users where id = '$id'");
                header("Location: http://localhost/PHPClass/Homework6/");
            } else if (isset($_GET['add'])) {
                include "add.php";
            }
            ?>
        </table>

        <button><a href="?add">Add</a></button>


    </main>
</body>

</html>