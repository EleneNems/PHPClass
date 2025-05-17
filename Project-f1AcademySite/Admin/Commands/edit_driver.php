<?php
include '../../Includes/connect.php';

$id = intval($_POST['driver_id']);
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$nationality = trim($_POST['nationality']);
$support = trim($_POST['support']);
$racing_number = intval($_POST['racing_number']);
$dob = $_POST['dob'];
$team_id = $_POST['team_id'] !== '' ? intval($_POST['team_id']) : null;

$errors = [];

if (strlen($firstname) < 2) $errors[] = "First name too short.";
if (strlen($lastname) < 2) $errors[] = "Last name too short.";
if (!$dob) $errors[] = "Date of birth required.";

$driverResult = mysqli_query($conn, "SELECT * FROM drivers WHERE id = $id");
if (mysqli_num_rows($driverResult) === 0) $errors[] = "Driver not found.";
$driver = mysqli_fetch_assoc($driverResult);

$mainPicPath = $driver['main_pic_path'];
$coverPicPath = $driver['cover_pic_path'];

function handleImageUpload($field, $targetName) {
    global $errors;
    if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES[$field]['tmp_name'];
        $name = $_FILES[$field]['name'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $errors[] = "$field must be an image file.";
            return null;
        }

        $newName = $targetName . "." . $ext;
        $subfolder = $field === 'cover_pic' ? 'Cover/' : '';
        $targetPath = "../../Assets/Drivers/{$subfolder}{$newName}";
        if (file_exists("../../" . ($field === 'cover_pic' ? $GLOBALS['coverPicPath'] : $GLOBALS['mainPicPath']))) {
            unlink("../../" . ($field === 'cover_pic' ? $GLOBALS['coverPicPath'] : $GLOBALS['mainPicPath']));
        }

        if (!move_uploaded_file($tmp, $targetPath)) {
            $errors[] = "Error saving $field.";
            return null;
        }

        return "Assets/Drivers/{$subfolder}{$newName}";
    }
    return null;
}

$formattedName = ucfirst($firstname) . ucfirst($lastname);
$mainUploaded = handleImageUpload('main_pic', $formattedName);
$coverUploaded = handleImageUpload('cover_pic', 'cover-' . strtolower($formattedName));

if (!empty($mainUploaded)) $mainPicPath = $mainUploaded;
if (!empty($coverUploaded)) $coverPicPath = $coverUploaded;

if (!empty($errors)) {
    header("Location: ../admin_dashboard.php?page=drivers&editErr=" . urlencode(implode(" ", $errors)));
    exit();
}

$stmt = mysqli_prepare($conn, "UPDATE drivers SET firstname=?, lastname=?, nationality=?, support=?, racing_number=?, dob=?, team_id=?, main_pic_path=?, cover_pic_path=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "ssssissssi", $firstname, $lastname, $nationality, $support, $racing_number, $dob, $team_id, $mainPicPath, $coverPicPath, $id);
mysqli_stmt_execute($stmt);

header("Location: ../admin_dashboard.php?page=drivers&success=1");
exit();
?>
