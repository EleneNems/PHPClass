<?php
session_start();
include "connect.php";

$user_id = $_SESSION['user_id'];

function deleteFolder($folder) {
    if (!$folder || !is_dir($folder)) return;
    $files = array_diff(scandir($folder), ['.', '..']);
    foreach ($files as $file) {
        $path = "$folder/$file";
        is_dir($path) ? deleteFolder($path) : unlink($path);
    }
    rmdir($folder);
}

if (isset($_GET['id'])) {
    $story_id = intval($_GET['id']);

    $query = "SELECT * FROM stories WHERE id = $story_id AND author_id = $user_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $story = mysqli_fetch_assoc($result);
        $folder_path = realpath(__DIR__ . '/../Assets/Stories/story' . $story_id);


        deleteFolder($folder_path);

        mysqli_query($conn, "DELETE FROM stories WHERE id = $story_id");

        header("Location: ../my_stories.php");
        exit();
    } else {
        echo "Unauthorized or story not found.";
    }
} else {
    echo "Invalid request.";
}
?>