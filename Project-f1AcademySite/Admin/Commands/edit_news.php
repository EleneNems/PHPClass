<?php
include '../../Includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newsId = intval($_POST['news_id']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $query = mysqli_prepare($conn, "UPDATE news SET Title = ?, Description = ? WHERE id = ?");
    mysqli_stmt_bind_param($query, "ssi", $title, $description, $newsId);
    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);

    if (isset($_FILES['main_photo']) && $_FILES['main_photo']['error'] === UPLOAD_ERR_OK) {
        $photoQuery = mysqli_query($conn, "SELECT photo_path FROM news WHERE id = $newsId");
        $row = mysqli_fetch_assoc($photoQuery);
        $relativePath = $row['photo_path'];
        $fullPath = "../../" . $relativePath;

        move_uploaded_file($_FILES['main_photo']['tmp_name'], $fullPath);
    }

    header("Location: ../admin_dashboard.php?page=news&edited=1");
    exit();
} else {
    echo "Invalid request.";
}
?>
