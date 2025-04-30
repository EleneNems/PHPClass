<?php
$id = $_GET['edit'];
$select_q = "select * from courses where courseID = '$id'";

$cat_result = mysqli_query($conn, "select * from categories");
$users_result = mysqli_query($conn, "select * from users");

$result = mysqli_query($conn, $select_q);
$row = mysqli_fetch_assoc($result)
    ?>

<form method="post">
    <br><br>
    <select name="username">
        <?php
        while ($users_row = mysqli_fetch_assoc($users_result)) {
            ?>
            <option value="<?= $users_row['UserID'] ?>"><?= $users_row['Username'] ?></option>
            <?php
        }
        ?>
    </select>
    <br><br>
    <select name="category">
        <?php
        while ($cat_row = mysqli_fetch_assoc($cat_result)) {
            ?>
            <option value="<?= $cat_row['CategoryID'] ?>"><?= $cat_row['CategoryName'] ?></option>
            <?php
        }
        ?>
    </select>
    <br><br>
    <input type="text" name="title" value="<?= $row['Title'] ?>">
    <br><br>
    <input type="text" name="description" value="<?= $row['Description'] ?>">
    <br><br>
    <input type="number" name="price" value="<?= $row['Price'] ?>">
    <br><br>
    <button name="edit">Edit</button>
</form>

<?php
if (isset($_POST['edit'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['username']);
    $categoryid = mysqli_real_escape_string($conn, $_POST['category']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $update_q = "update courses set userID = '$userid', categoryID = '$categoryid', title = '$title', description = '$description', Price = '$price' where courseID = '$id'";

    mysqli_query($conn, $update_q);
    header("Location: http://localhost/PHPClass/Homework6/onlineLearningDB/coursesTable/");

}
?>