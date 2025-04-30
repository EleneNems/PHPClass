<?php
    $username_q = "select * from users";
    $category_q = "select * from categories";

    $cat_row = mysqli_query($conn, $category_q);
    $user_row =mysqli_query($conn, $username_q);
?>

<form method="post">
    <br><br>
    <select name="username">
        <?php
            while ($u_row = mysqli_fetch_assoc($user_row)) {

        ?>
        <option value="<?=$u_row['UserID']?>"><?=$u_row['Username']?></option>
        <?php
        }
        ?>
    </select>
    <br><br>
    <select name="categories">
        <?php
            while ($c_row = mysqli_fetch_assoc($cat_row)) {
        ?>
        <option value="<?=$c_row['CategoryID']?>"><?=$c_row['CategoryName']?></option>
        <?php
            }
        ?>
    </select>
    <br><br>
    <input type="text" name="title">
    <br><br>
    <input type="text" name="Description">
    <br><br>
    <input type="number" name="Price">
    <br><br>
    <button name="add">Add a Course</button>
</form>

<?php
if(isset($_POST['add'])){
    $userid = mysqli_real_escape_string($conn, $_POST['username']);
    $categoryID = mysqli_real_escape_string($conn, $_POST['categories']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);

    $insert_q = "insert into courses(UserID, CategoryID, Title, Description, Price) Values('$userid', '$categoryID', '$title', '$description', '$price')";
    mysqli_query($conn, $insert_q);
    header("Location: http://localhost/PHPClass/Homework6/onlineLearningDB/coursesTable/");
    
}
?>