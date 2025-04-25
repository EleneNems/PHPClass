<?php
    $id = $_GET['edit'];
    
    $result = mysqli_query($conn, "SELECT * FROM roles WHERE id = '$id'");
    $rows = mysqli_fetch_assoc($result);
?>

<form method="post">
    <input type="text" name="role" value="<?=$rows['status']?>"> - 
    <button name="edit">რედაქტირება</button>
</form>

<?php
    if (isset($_POST['edit'])) {
        $status = mysqli_real_escape_string($conn, $_POST['role']); 

        $query = "UPDATE roles SET status = '$status' WHERE id = '$id'";
        
        if (mysqli_query($conn, $query)) {
            header("Location: ?nav=role&edit=$id");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
?>
