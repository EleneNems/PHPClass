<?php
session_start();
include '../../Includes/connect.php';

function redirectWithError($errors)
{
    $query = http_build_query($errors);
    header("Location: ../admin_dashboard.php?page=news&" . $query);
    exit();
}

function sanitize($data)
{
    return trim($data);
}

$title = isset($_POST['title']) ? sanitize($_POST['title']) : '';
$description = isset($_POST['description']) ? sanitize($_POST['description']) : '';
$content = isset($_POST['content']) ? sanitize($_POST['content']) : '';
$date = date('Y-m-d H:i:s');

$errors = [];
if (strlen($title) < 10)
    $errors['titleErr'] = "Title is too short";
if (strlen($description) < 20)
    $errors['descriptionErr'] = "Description too short";
if (strlen($content) < 300)
    $errors['contentErr'] = "Content too short, can't be shorter than 300 words";
if (empty($date))
    $errors['dateErr'] = "Date is required";

if (!isset($_FILES['main_photo']) || $_FILES['main_photo']['error'] != 0) {
    $errors['mainErr'] = "Main photo is required";
}

if (!empty($errors)) {
    redirectWithError($errors);
}

$title = mysqli_real_escape_string($conn, $title);
$description = mysqli_real_escape_string($conn, $description);
$content = mysqli_real_escape_string($conn, $content);
$date = mysqli_real_escape_string($conn, $date);

$sql = "INSERT INTO news (title, description, content, date) VALUES ('$title', '$description', '$content', '$date')";
if (!mysqli_query($conn, $sql)) {
    die("Error inserting news: " . mysqli_error($conn));
}
$news_id = mysqli_insert_id($conn);

$main_photo = $_FILES['main_photo'];
$main_ext = pathinfo($main_photo['name'], PATHINFO_EXTENSION);
$news_folder = "../../Assets/News/news$news_id/";
if (!is_dir($news_folder))
    mkdir($news_folder, true);

$main_photo_path = "Assets/News/news$news_id/news$news_id." . $main_ext;
$main_photo_fullpath = $news_folder . "news$news_id." . $main_ext;

if (!move_uploaded_file($main_photo['tmp_name'], $main_photo_fullpath)) {
    die("Failed to upload main photo.");
}

$sql = "UPDATE news SET photo_path = '$main_photo_path' WHERE id = $news_id";
if (!mysqli_query($conn, $sql)) {
    die("Error updating main photo path: " . mysqli_error($conn));
}

if (isset($_FILES['extra_photos']) && !empty($_FILES['extra_photos']['name'][0])) {
    $extra_photos = $_FILES['extra_photos'];
    $captions = $_POST['captions'] ?? [];

    $count = count($extra_photos['name']);

    for ($i = 0; $i < $count; $i++) {
        if ($extra_photos['error'][$i] == 0) {
            $ext = pathinfo($extra_photos['name'][$i], PATHINFO_EXTENSION);
            $filename = "img" . ($i + 1) . "." . $ext;
            $filepath = $news_folder . $filename;
            $db_path = "Assets/News/news$news_id/" . $filename;

            if (move_uploaded_file($extra_photos['tmp_name'][$i], $filepath)) {
                $caption = isset($captions[$i]) ? trim($captions[$i]) : '';
                $caption_escaped = mysqli_real_escape_string($conn, $caption);

                $sql_photo = "INSERT INTO news_photos (news_id, image_path, caption) VALUES ($news_id, '$db_path', '$caption_escaped')";
                if (!mysqli_query($conn, $sql_photo)) {
                    error_log("Failed to insert photo record: " . mysqli_error($conn));
                }
            }
        }
    }
}

header("Location: ../admin_dashboard.php?page=news&success=1");
exit();
?>