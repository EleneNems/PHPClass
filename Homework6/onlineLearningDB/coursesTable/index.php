<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online learning - Couses Table </title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        main {
            background-color: lightgreen;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
        }

        table tr td,
        tr th {
            border: solid 1px black;
        }
    </style>
</head>

<body>
    <main>
        <table>
            <tr>
                <th>CourseID</th>
                <th>Username</th>
                <th>Category</t>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>

            <?php
            $course_q = "Select * from courses join categories on courses.categoryID = categories.categoryID join users on courses.userID = users.userID";

            $course_result = mysqli_query($conn, $course_q);
            while ($course_row = mysqli_fetch_assoc($course_result)) {
                ?>
                <tr>
                    <td><?= $course_row['CourseID'] ?></td>
                    <td><?= $course_row['Username'] ?></td>
                    <td><?= $course_row['CategoryName'] ?></td>
                    <td><?= $course_row['Title'] ?></td>
                    <td><?= $course_row['Description'] ?></td>
                    <td><?= $course_row['Price'] ?></td>
                    <td>
                        <a href="?edit=<?= $course_row['CourseID'] ?>">Edit</a> -
                        <a href="?drop=<?= $course_row['CourseID'] ?>">Delete</a>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>

        <br><br>
        <a href="?add"><button>Add</button></a>

        <?php
        if (isset($_GET['add'])) {
            include "add.php";
        } else if (isset($_GET['drop'])) {
            $id = $_GET['drop'];
            mysqli_query($conn, "delete from courses where courseID = '$id'");
            header("Location: http://localhost/PHPClass/Homework6/onlineLearningDB/coursesTable/");
        }else if(isset($_GET['edit'])){
            include "edit.php";
        }
        ?>

    </main>
</body>

</html>