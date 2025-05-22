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
                <div class="image-wrapper">
                    <img src="../<?= $row['photo_path'] ?>" alt="News Image">
                </div>
                <div class="card-content">
                    <h3><?= $row['Title'] ?></h3>
                    <p><strong><?= $row['Description'] ?></strong></p>
                    <p class="date"><?= date('F j, Y', strtotime($row['Date'])) ?></p>
                    <div class="card-actions">
                        <button onclick="openEditModal(<?= $row['id'] ?>)">Edit</button>
                        <button onclick="openDeleteNewsModal(<?= $row['id'] ?>)">Delete</button>
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

<div id="deleteNewsModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteNewsModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this news post?</p>
        <form id="confirmNewsDeleteForm" method="POST" action="Commands/delete_news.php">
            <input type="hidden" name="news_id" id="delete_news_id">
            <button type="submit" class="delete-btn">Yes, Delete</button>
            <button type="button" onclick="closeDeleteNewsModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="editNewsModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditNewsModal()">&times;</span>
        <h2>Edit News</h2>

        <form id="editNewsForm" action="Commands/edit_news.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="news_id" id="edit_news_id">

            <label>Title:</label>
            <input type="text" name="title" id="edit_news_title" required>

            <label>Description:</label>
            <textarea name="description" id="edit_news_description" rows="3" required></textarea>

            <label>Replace Main Photo (optional):</label>
            <input type="file" name="main_photo" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>

<script src="../JS/Form_modal.js?v=3"></script>
<script src="../JS/AddPhoto.js"></script>
<script src="../JS/Edit_modal.js"></script>