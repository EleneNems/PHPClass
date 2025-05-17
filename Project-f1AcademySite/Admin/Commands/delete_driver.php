<?php
include '../../Includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['driver_id'])) {
    $driverId = intval($_POST['driver_id']);

    $query = "SELECT main_pic_path, cover_pic_path FROM drivers WHERE id = $driverId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $mainPic = $row['main_pic_path'];
        $coverPic = $row['cover_pic_path'];

        if ($mainPic && file_exists("../../" . $mainPic)) {
            unlink("../../" . $mainPic);
        }

        if ($coverPic && file_exists("../../" . $coverPic)) {
            unlink("../../" . $coverPic);
        }

        $deleteQuery = "DELETE FROM drivers WHERE id = $driverId";
        mysqli_query($conn, $deleteQuery);
    }

    header("Location: ../admin_dashboard.php?page=drivers");
    exit();
}
?>