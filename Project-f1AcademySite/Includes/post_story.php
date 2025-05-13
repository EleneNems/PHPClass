<?php
include 'connect.php';
include 'auth.php';

$user_id = $_SESSION['user_id'];
$errors = [
    'title' => '',
    'type' => '',
    'main_picture' => '',
    'content' => '',
    'form' => ''
];

if (isset($_POST['post_story'])) {
    $title = trim($_POST['title'] ?? '');
    $type = $_POST['type'] ?? '';
    $main_pic = $_FILES['main_picture'] ?? null;
    $content = trim($_POST['story_content'] ?? '');
    $content_file = $_FILES['content_file'] ?? null;

    $valid_types = ['story', 'report', 'interview'];
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

    if (empty($title)) {
        $errors['title'] = "Title is required.";
    }

    if (!in_array($type, $valid_types)) {
        $errors['type'] = "Please select a valid story type.";
    }

    $main_ext = $main_pic && $main_pic['error'] === UPLOAD_ERR_OK
        ? strtolower(pathinfo($main_pic['name'], PATHINFO_EXTENSION))
        : '';

    if (!$main_pic || $main_pic['error'] !== UPLOAD_ERR_OK) {
        $errors['main_picture'] = "Main picture is required.";
    } elseif (!in_array($main_ext, $allowed_extensions)) {
        $errors['main_picture'] = "Invalid file type for main picture.";
    }

    if ($content_file && $content_file['error'] === UPLOAD_ERR_OK) {
        $file_ext = strtolower(pathinfo($content_file['name'], PATHINFO_EXTENSION));
        if ($file_ext !== 'txt') {
            $errors['content'] = "Only .txt files are allowed for upload.";
        } else {
            $file_contents = file_get_contents($content_file['tmp_name']);
            if ($file_contents === false) {
                $errors['content'] = "Failed to read uploaded .txt file.";
            } else {
                $content = trim($file_contents);
            }
        }
    }

    $word_count = str_word_count($content);
    if (empty($content)) {
        $errors['content'] = "Please provide story content either by writing or uploading a .txt file.";
    } elseif ($word_count < 300) {
        $errors['content'] = "Content must have at least 300 words. Currently: $word_count.";
    } elseif ($word_count > 50000) {
        $errors['content'] = "Content is too long. Limit is 50,000 words.";
    }

    if (empty(array_filter($errors))) {
        try {
            $stmt = mysqli_prepare($conn, "INSERT INTO stories (author_id, title, type, content, story_pic_path) VALUES (?, ?, ?, ?, '')");
            mysqli_stmt_bind_param($stmt, "isss", $user_id, $title, $type, $content);
            mysqli_stmt_execute($stmt);

            $story_id = mysqli_insert_id($conn);
            mysqli_stmt_close($stmt);

            $folder = "Assets/Stories/story" . $story_id;
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $main_filename = "story" . $story_id . "." . $main_ext;
            $main_path = "$folder/$main_filename";

            if (move_uploaded_file($main_pic['tmp_name'], $main_path)) {
                $stmt = mysqli_prepare($conn, "UPDATE stories SET story_pic_path = ? WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "si", $main_path, $story_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                $errors['form'] = "Failed to upload the main image.";
            }

            if (!empty($_FILES['photos']['name'][0])) {
                $image_index = 1;
                foreach ($_FILES['photos']['name'] as $index => $name) {
                    $caption = $_POST['captions'][$index] ?? '';
                    $tmp = $_FILES['photos']['tmp_name'][$index];
                    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                    if (in_array($ext, $allowed_extensions)) {
                        $filename = "img" . $image_index++ . "." . $ext;
                        $path = "$folder/$filename";

                        if (move_uploaded_file($tmp, $path)) {
                            $stmt = mysqli_prepare($conn, "INSERT INTO story_photos (story_id, caption, image_path) VALUES (?, ?, ?)");
                            mysqli_stmt_bind_param($stmt, "iss", $story_id, $caption, $path);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
            }

            if (empty($errors['form'])) {
                header("Location: /PHPClass/Project-f1AcademySite/my_stories.php");
                exit;


            }
        } catch (Exception $e) {
            $errors['form'] = "An error occurred while posting the story.";
        }
    }
}
?>