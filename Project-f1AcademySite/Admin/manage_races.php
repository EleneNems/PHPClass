<?php
include '../Includes/connect.php';

$query = "SELECT * FROM race_events ORDER BY start_date DESC";
$result = mysqli_query($conn, $query);

function old($key)
{
    return $_GET[$key] ?? '';
}
?>

<div class="races-container">
    <div class="card-wrapper">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card race-card">
                <div class="image-wrapper">
                    <img src="../<?= $row['circuit_path'] ?>" alt="Circuit Image">
                </div>
                <div class="card-content">
                    <h3><?= $row['name'] ?></h3>
                    <p><strong>Location:</strong> <?= $row['location'] ?></p>
                    <p><strong>Start:</strong> <?= date('F j, Y', strtotime($row['start_date'])) ?></p>
                    <p><strong>End:</strong> <?= date('F j, Y', strtotime($row['end_date'])) ?></p>
                    <div class="card-actions">
                        <button onclick="openEditRaceModal(<?= $row['id'] ?>)">Edit</button>
                        <button onclick="openDeleteRaceModal(<?= $row['id'] ?>)" class="delete-btn">Delete</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="card race-card add-race-card" onclick="openAddRaceModal()">
            <div class="add-card-content">
                <span>+ Add Race</span>
            </div>
        </div>
    </div>
</div>

<div id="addRaceModal" class="modal" style="display: <?= isset($_GET['nameErr']) ? 'block' : 'none' ?>;">
    <div class="modal-content">
        <span class="close" onclick="closeAddRaceModal()">&times;</span>
        <h2>Add Race</h2>
        <form action="Commands/add_race.php" method="POST" enctype="multipart/form-data">
            <label>Race Name:</label>
            <input type="text" name="name" value="<?= old('name') ?>">
            <?php if (isset($_GET['nameErr']))
                echo "<p class='error-text'>{$_GET['nameErr']}</p>"; ?>

            <label>Location:</label>
            <input type="text" name="location" value="<?= old('location') ?>">
            <?php if (isset($_GET['locationErr']))
                echo "<p class='error-text'>{$_GET['locationErr']}</p>"; ?>

            <label>Start Date:</label>
            <input type="date" name="start_date" value="<?= old('start_date') ?>">
            <?php if (isset($_GET['startErr']))
                echo "<p class='error-text'>{$_GET['startErr']}</p>"; ?>

            <label>Cover Image:</label>
            <div class="file-upload-wrapper">
                <label class="custom-upload-btn">Choose File
                    <input type="file" name="cover_image" class="hidden-input" accept="image/*">
                </label>
            </div>
            <?php if (isset($_GET['coverErr']))
                echo "<p class='error-text'>{$_GET['coverErr']}</p>"; ?>

            <label>Circuit Image:</label>
            <div class="file-upload-wrapper">
                <label class="custom-upload-btn">Choose File
                    <input type="file" name="circuit_image" class="hidden-input" accept="image/*">
                </label>
            </div>
            <?php if (isset($_GET['circuitErr']))
                echo "<p class='error-text'>{$_GET['circuitErr']}</p>"; ?>

            <button type="submit">Submit Race</button>
        </form>
    </div>
</div>

<div id="deleteRaceModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteRaceModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this race?</p>
        <form id="confirmRaceDeleteForm" method="POST" action="Commands/delete_race.php">
            <input type="hidden" name="race_id" id="delete_race_id">
            <button type="submit" class="delete-btn">Yes, Delete</button>
            <button type="button" onclick="closeDeleteRaceModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="editRaceModal" class="modal" style="display: <?= isset($_GET['edit_id']) ? 'block' : 'none' ?>;">
    <div class="modal-content">
        <span class="close" onclick="closeEditRaceModal()">&times;</span>
        <h2>Edit Race</h2>

        <form id="editRaceForm" action="Commands/edit_race.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="race_id" id="edit_race_id" value="<?= $_GET['edit_id'] ?? '' ?>">

            <label>Race Name:</label>
            <input type="text" name="name" id="edit_race_name" value="<?= $_GET['name'] ?? '' ?>">
            <?php if (isset($_GET['nameErr'])): ?>
                <p class="error-text"><?= $_GET['nameErr'] ?></p>
            <?php endif; ?>

            <label>Location:</label>
            <input type="text" name="location" id="edit_race_location" value="<?= $_GET['location'] ?? '' ?>">
            <?php if (isset($_GET['locationErr'])): ?>
                <p class="error-text"><?= $_GET['locationErr'] ?></p>
            <?php endif; ?>

            <label>Start Date:</label>
            <input type="date" name="start_date" id="edit_race_start" value="<?= $_GET['start_date'] ?? '' ?>">
            <?php if (isset($_GET['startErr'])): ?>
                <p class="error-text"><?= $_GET['startErr'] ?></p>
            <?php endif; ?>

            <label>Cover Image:</label>
            <div class="file-upload-wrapper">
                <label class="custom-upload-btn">Choose File
                    <input type="file" name="cover_image" class="hidden-input" accept="image/*">
                </label>
            </div>
            <?php if (isset($_GET['coverErr'])): ?>
                <p class="error-text"><?= $_GET['coverErr'] ?></p>
            <?php endif; ?>

            <label>Circuit Image:</label>
            <div class="file-upload-wrapper">
                <label class="custom-upload-btn">Choose File
                    <input type="file" name="circuit_image" class="hidden-input" accept="image/*">
                </label>
            </div>
            <?php if (isset($_GET['circuitErr'])): ?>
                <p class="error-text"><?= $_GET['circuitErr'] ?></p>
            <?php endif; ?>

            <button type="submit" class="update-btn">Save Changes</button>
        </form>
    </div>
</div>

<script src="../JS/Form_modal.js?v=5"></script>
<script src="../JS/Edit_modal.js?v=6" defer></script>