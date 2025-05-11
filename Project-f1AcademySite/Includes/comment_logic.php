<?php
session_start();
include 'connect.php';
$userId = $_SESSION['user_id'] ?? null;

if (!$userId && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $userQuery = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($userQuery);
    $userId = $user['id'];
    $_SESSION['user_id'] = $userId; 
}


if (isset($_POST['post_comment'])) {
    $commentText = trim($_POST['comment_text']);
    $storyId = intval($_POST['story_id']);

    if (!empty($commentText)) {
        $email = $_SESSION['email'];
        $userQuery = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
        $user = mysqli_fetch_assoc($userQuery);
        $userId = $user['id'];

        $commentTextEscaped = mysqli_real_escape_string($conn, $commentText);

        $insertQuery = "INSERT INTO comments (comment_text, created_at, story_id, user_id)
                        VALUES ('$commentTextEscaped', NOW(), $storyId, $userId)";
        mysqli_query($conn, $insertQuery);
    }

    header("Location: ../story.php?id=$storyId");
    exit;
}

if (isset($_POST['delete_comment'])) {
    $commentId = intval($_POST['comment_id']);
    $storyId = intval($_POST['story_id']);

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $userQuery = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
        $user = mysqli_fetch_assoc($userQuery);
        $userId = $user['id'];

        $check = mysqli_query($conn, "SELECT id FROM comments WHERE id = $commentId AND user_id = $userId");
        if (mysqli_num_rows($check) > 0) {
            mysqli_query($conn, "DELETE FROM comments WHERE id = $commentId");
        }
    }

    header("Location: ../story.php?id=$storyId");
    exit;
}

if (isset($_POST['edit_comment']) && $userId !== null) {
    $commentId = intval($_POST['comment_id']);
    $storyId = intval($_POST['story_id']);
    $newText = trim($_POST['edited_text']);

    if (!empty($newText)) {
        $stmt = mysqli_prepare($conn, "SELECT id FROM comments WHERE id = ? AND user_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $commentId, $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $stmtUpdate = mysqli_prepare($conn, "UPDATE comments SET comment_text = ?, is_edited = 1 WHERE id = ?");
            mysqli_stmt_bind_param($stmtUpdate, "si", $newText, $commentId);
            mysqli_stmt_execute($stmtUpdate);
            mysqli_stmt_close($stmtUpdate);
        }

        mysqli_stmt_close($stmt);
    }

    header("Location: ../story.php?id=$storyId");
    exit;
}
?>