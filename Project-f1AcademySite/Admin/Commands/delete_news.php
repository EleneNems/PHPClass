<?php
include '../../Includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['news_id'])) {
    $newsId = intval($_POST['news_id']);

    $folderPath = "../../Assets/News/news" . $newsId;

    function deleteFolder($folder) {
        if (!file_exists($folder)) return;

        $files = array_diff(scandir($folder), ['.', '..']);
        foreach ($files as $file) {
            $filePath = "$folder/$file";
            if (is_dir($filePath)) {
                deleteFolder($filePath);
            } else {
                unlink($filePath);
            }
        }
        rmdir($folder); 
    }

    deleteFolder($folderPath);

    $stmt = mysqli_prepare($conn, "DELETE FROM news WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $newsId);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../admin_dashboard.php?page=news&deleted=1");
        exit();
    } else {
        echo "Error deleting news: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}
?>
