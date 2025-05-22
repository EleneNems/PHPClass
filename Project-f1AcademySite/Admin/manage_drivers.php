<?php
include '../Includes/connect.php';
$driverCount = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM drivers"))[0];

$firstnameErr = $_GET['firstnameErr'] ?? '';
$lastnameErr = $_GET['lastnameErr'] ?? '';
$nationalityErr = $_GET['nationalityErr'] ?? '';
$numberErr = $_GET['numberErr'] ?? '';
$dobErr = $_GET['dobErr'] ?? '';
$mainErr = $_GET['mainErr'] ?? '';
$coverErr = $_GET['coverErr'] ?? '';
$old = fn($key) => htmlspecialchars($_GET[$key] ?? '');
?>

<div class="team-summary-cards">
    <div class="card"><i class="fas fa-car-side animated-icon"></i> Total Drivers: <?= $driverCount ?></div>
</div>

<div class="user-controls">
    <input type="text" id="driverSearch" placeholder="Search by name..." onkeyup="filterDrivers()">
    <input type="number" id="pointsFilter" placeholder="Min points..." oninput="filterDrivers()">
</div>

<table class="team-table" id="driversTable">
    <thead>
        <tr>
            <th>Photo</th>
            <th onclick="sortTable(0)">Full Name ↑↓</th>
            <th>Nationality</th>
            <th>Team</th>
            <th>Support</th>
            <th>Number</th>
            <th>DOB</th>
            <th onclick="sortTable(6, 'num')">Points ↑↓</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT d.*, t.name AS team_name FROM drivers d LEFT JOIN teams t ON d.team_id = t.id ORDER BY d.id ASC";
        $result = mysqli_query($conn, $query);

        while ($driver = mysqli_fetch_assoc($result)) { ?>
            <tr ondblclick="openEditDriverModal(<?= $driver['id'] ?>)">
                <td>
                    <img src="<?= '../' . $driver['main_pic_path'] ?>" alt="Driver photo"
                        style="height: 60px; border-radius: 5px; background-color: #c3047c;">
                </td>
                <td><?= $driver['firstname'] . ' ' . $driver['lastname'] ?></td>
                <td><?= $driver['nationality'] ?></td>
                <td><?= $driver['team_name'] ?? 'Unassigned' ?></td>
                <td><?= $driver['support'] ?></td>
                <td><?= $driver['racing_number'] ?></td>
                <td><?= $driver['dob'] ?></td>
                <td><?= $driver['total_points'] ?></td>
                <td>
                    <button class="delete-btn"
                        onclick="event.stopPropagation(); event.preventDefault(); confirmDeleteDriver(<?= $driver['id'] ?>);">Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="card add-team-card" onclick="openTeamModal()">
    <i class="fas fa-plus-circle animated-icon"></i> Add New Team
</div>

<div id="driverModal" class="modal" style="display: <?= isset($_GET['firstnameErr']) ? 'block' : 'none' ?>;">
    <div class="modal-content">
        <span class="close" onclick="closeDriverModal()">&times;</span>
        <h2>Add New Driver</h2>

        <form action="Commands/add_driver.php" method="POST" enctype="multipart/form-data">
            <label>First Name:</label>
            <input type="text" name="firstname" value="<?= $old('firstname') ?>">
            <?php if ($firstnameErr)
                echo "<p class='error-text'>$firstnameErr</p>"; ?>

            <label>Last Name:</label>
            <input type="text" name="lastname" value="<?= $old('lastname') ?>">
            <?php if ($lastnameErr)
                echo "<p class='error-text'>$lastnameErr</p>"; ?>

            <label>Nationality:</label>
            <input type="text" name="nationality" value="<?= $old('nationality') ?>">
            <?php if ($nationalityErr)
                echo "<p class='error-text'>$nationalityErr</p>"; ?>

            <label>Support:</label>
            <input type="text" name="support" value="<?= $old('support') ?>">

            <label>Racing Number:</label>
            <input type="number" name="racing_number" value="<?= $old('racing_number') ?>">
            <?php if ($numberErr)
                echo "<p class='error-text'>$numberErr</p>"; ?>

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="<?= $old('dob') ?>">
            <?php if ($dobErr)
                echo "<p class='error-text'>$dobErr</p>"; ?>

            <label>Team:</label>
            <select name="team_id">
                <option value="">None</option>
                <?php
                $selectedTeam = $_GET['team_id'] ?? '';
                $teamOptions = mysqli_query($conn, "SELECT id, name FROM teams");
                while ($team = mysqli_fetch_assoc($teamOptions)) {
                    $selected = ($selectedTeam == $team['id']) ? "selected" : "";
                    echo "<option value='{$team['id']}' $selected>{$team['name']}</option>";
                }
                ?>
            </select>

            <label>Driver Photo:</label>
            <input type="file" name="main_pic" accept="image/*">
            <?php if ($mainErr)
                echo "<p class='error-text'>$mainErr</p>"; ?>

            <label>Driver Cover Photo:</label>
            <input type="file" name="cover_pic" accept="image/*">
            <?php if ($coverErr)
                echo "<p class='error-text'>$coverErr</p>"; ?>

            <button type="submit">Add Driver</button>
        </form>
    </div>
</div>

<div id="deleteDriverModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteDriverModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this driver?</p>
        <form id="confirmDriverDeleteForm" method="POST" action="Commands/delete_driver.php">
            <input type="hidden" name="driver_id" id="delete_driver_id">
            <button type="submit" class="delete-btn">Yes, Delete</button>
            <button type="button" onclick="closeDeleteDriverModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="editDriverModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditDriverModal()">&times;</span>
        <h2>Edit Driver</h2>

        <form action="Commands/edit_driver.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="driver_id" id="edit_driver_id">

            <label>First Name:</label>
            <input type="text" name="firstname" id="edit_firstname" required>

            <label>Last Name:</label>
            <input type="text" name="lastname" id="edit_lastname" required>

            <label>Nationality:</label>
            <input type="text" name="nationality" id="edit_nationality" required>

            <label>Support:</label>
            <input type="text" name="support" id="edit_support">

            <label>Racing Number:</label>
            <input type="number" name="racing_number" id="edit_number" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" id="edit_dob" required>

            <label>Team:</label>
            <select name="team_id" id="edit_team">
                <option value="">None</option>
                <?php
                $teamOptions = mysqli_query($conn, "SELECT id, name FROM teams");
                while ($team = mysqli_fetch_assoc($teamOptions)) {
                    echo "<option value='{$team['id']}'>{$team['name']}</option>";
                }
                ?>
            </select>

            <label>New Main Photo:</label>
            <input type="file" name="main_pic" accept="image/*">

            <label>New Cover Photo:</label>
            <input type="file" name="cover_pic" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>

<script src="../JS/Form_modal.js?v=2" defer></script>
<script src="../JS/Sorting.js"></script>
<script src="../JS/Filter_drivers.js"></script>
<script src="../JS/Edit_modal.js?v=3"></script>