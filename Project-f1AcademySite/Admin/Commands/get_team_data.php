<?php
include '../../Includes/connect.php';

$id = intval($_GET['id']);
$team = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teams WHERE id = $id"));

header('Content-Type: application/json');
echo json_encode(['team' => $team]);
?>
