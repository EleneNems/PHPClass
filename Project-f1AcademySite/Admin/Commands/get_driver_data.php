<?php
include '../../Includes/connect.php';

$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM drivers WHERE id = $id");

if (mysqli_num_rows($res) === 0) {
    echo json_encode(['error' => 'Driver not found']);
    exit;
}

$driver = mysqli_fetch_assoc($res);
echo json_encode(['driver' => $driver]);
?>