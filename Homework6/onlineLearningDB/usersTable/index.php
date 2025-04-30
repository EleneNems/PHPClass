<?php
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online learning-users Table</title>
    <style>
        body{
            padding: 0;
            margin: 0;
        }

        main{
            background-color: lightcyan;
            width: 100%;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        table{
            width: 80%;
            border-collapse: collapse;
        }

        table tr td, tr th{
            border: solid 1px black;
        }
    </style>
</head>
<body>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>FullName</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php
                $q_all = "select * from users";
                $result = mysqli_query($conn, $q_all);

                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?=$row['UserID']?></td>
                <td><?=$row['Username']?></td>
                <td><?=$row['Password']?></td>
                <td><?=$row['Email']?></td>
                <td><?=$row['FullName']?></td>
                <td><?=$row['Role']?></td>
                <td>
                    <a href="?edit=<?=$row['UserID']?>">Edit</a>
                    <a href="?drop=<?=$row['UserID']?>">Delete</a>
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
                $delete_q = "delete from users where userid = '$id'";
                mysqli_query($conn, $delete_q);
                header("Location: http://localhost/PHPClass/Homework6/onlineLearningDB/usersTable/");
            }
            else if(isset($_GET['edit'])){
                include "edit.php";
            }
        ?>
    </main>
</body>
</html>