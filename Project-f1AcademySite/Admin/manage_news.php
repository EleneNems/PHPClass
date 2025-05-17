<?php
include '../Includes/connect.php';

$query = "SELECT * FROM news ORDER BY date DESC";
$result = mysqli_query($conn, $query);
function old($key)
{
    return $_GET[$key] ?? '';
}
?>

<div class="news-container">
    <div class="card-wrapper">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card news-card">
                <img src="../<?= $row['photo_path'] ?>" alt="News Image">
                <div class="card-content">
                    <h3><?= $row['Title'] ?></h3>
                    <p><strong><?= $row['Description'] ?></strong></p>
                    <p class="date"><?= date('F j, Y', strtotime($row['Date'])) ?></p>
                    <div class="card-actions">
                        <button onclick="openEditModal(<?= $row['id'] ?>)">Edit</button>
                        <button onclick="deleteNews(<?= $row['id'] ?>)">Delete</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="card news-card add-news-card" onclick="openAddNewsModal()">
            <div class="add-card-content">
                <span>+ Add News</span>
            </div>
        </div>
    </div>
</div>

<div id="addNewsModal" class="modal" style="display: <?= isset($_GET['titleErr']) ? 'block' : 'none' ?>;">
    <div class="modal-content">
        <span class="close" onclick="closeAddNewsModal()">&times;</span>
        <h2>Add News</h2>
        <form action="Commands/add_news.php" method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" value="<?= old('title') ?>">
            <?php if (isset($_GET['titleErr']))
                echo "<p class='error-text'>{$_GET['titleErr']}</p>"; ?>

            <label>Description:</label>
            <textarea name="description" rows="3"><?= old('description') ?></textarea>
            <?php if (isset($_GET['descriptionErr']))
                echo "<p class='error-text'>{$_GET['descriptionErr']}</p>"; ?>

            <label>Content:</label>
            <textarea name="content" rows="6"><?= old('content') ?></textarea>
            <?php if (isset($_GET['contentErr']))
                echo "<p class='error-text'>{$_GET['contentErr']}</p>"; ?>

            <label>Main News Photo:</label>
            <div class="file-upload-wrapper">
                <label class="custom-upload-btn">Choose File
                    <input type="file" name="main_photo" class="hidden-input" accept="image/*">
                </label>
            </div>
            <?php if (isset($_GET['mainErr'])) { ?>
                <p class="error-text"><?= $_GET['mainErr'] ?></p>
            <?php } ?>

            <div id="extra-photos">
                <label>Additional Photos (Optional)</label>
                <div class="photo-set">
                    <div class="file-upload-wrapper">
                        <label class="custom-upload-btn">Choose File
                            <input type="file" name="extra_photos[]" class="hidden-input additional-photo">
                        </label>
                    </div>
                    <input type="text" name="captions[]" placeholder="Caption">
                </div>
            </div>
            <button type="button" onclick="addPhotoField()">Add Another Photo</button>

            <button type="submit">Submit News</button>
        </form>
    </div>
</div>


<script src="../JS/Form_modal.js"></script>
<script src="../JS/AddPhoto.js"></script>