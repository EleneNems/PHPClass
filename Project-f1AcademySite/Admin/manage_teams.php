<?php
include '../Includes/connect.php';
$teamCount = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM teams"))[0];
$teams = mysqli_query($conn, "SELECT * FROM teams ORDER BY id ASC");
$nameErr = $_GET['nameErr'] ?? '';
$logoErr = $_GET['logoErr'] ?? '';
$oldName = $_GET['oldName'] ?? '';
?>

<div class="team-summary-cards">
    <div class="card"><i class="fas fa-flag-checkered animated-icon"></i> Total Teams: <?= $teamCount ?></div>
</div>

<table class="team-table">
    <thead>
        <tr>
            <th onclick="sortTable(0)">Team Name ↑↓</th>
            <th>Drivers</th>
            <th onclick="sortTable(2, 'num')">Total Points ↑↓</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($team = mysqli_fetch_assoc($teams)) { ?>
            <tr ondblclick="openEditModal(<?= $team['id'] ?>)" style="--i: <?= $team['id'] ?>;">
                <td>
                    <img src="<?= "../" . $team['logo'] ?>" alt="<?= $team['name'] ?> logo"
                        style="height: 30px; vertical-align: middle; margin-right: 10px; background: white; padding: 4px; border-radius: 6px;"
                        class="teams_logo">
                    <?= $team['name'] ?>
                </td>

                <td>
                    <div class="drivers-cell">
                        <?php
                        $teamId = $team['id'];
                        $driverResult = mysqli_query($conn, "
                            SELECT d.*, t.name AS team_name FROM drivers d LEFT JOIN teams t ON d.team_id = t.id WHERE d.team_id = $teamId
                        ");

                        if (mysqli_num_rows($driverResult) > 0) {
                            while ($driver = mysqli_fetch_assoc($driverResult)) {
                                ?>
                                <div class="driver-wrapper">
                                    <span class="driver-name">
                                        <?= $driver['firstname'] . ' ' . $driver['lastname'] ?> </span>
                                    <div class="driver-card">
                                        <img src="<?= '../' . $driver['main_pic_path'] ?>" alt="Driver photo">
                                        <div class="driver-info">
                                            <strong><?= $driver['firstname'] . ' ' . $driver['lastname'] ?></strong><br>
                                            🇳🇪 Nationality: <?= $driver['nationality'] ?><br>
                                            🎂 DOB: <?= $driver['dob'] ?><br>
                                            🏁 Supported: <?= $driver['support'] ?><br>
                                            🏎️ Number: <?= $driver['racing_number'] ?><br>
                                            🏆 Points: <?= $driver['total_points'] ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo 'No drivers';
                        }
                        ?>
                    </div>
                </td>

                <td><?= $team['total_points'] ?></td>

                <td>
                    <button class="delete-btn"
                        onclick="event.stopPropagation(); event.preventDefault(); confirmDelete(<?= $team['id'] ?>);">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="card add-team-card" onclick="openTeamModal()">
    <i class="fas fa-plus-circle animated-icon"></i> Add New Team
</div>

<div id="deleteConfirmModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this team?</p>
        <form id="confirmDeleteForm" method="POST" action="Commands/delete_team.php">
            <input type="hidden" name="team_id" id="delete_team_id">
            <button type="submit" class="delete-btn">Yes, Delete</button>
            <button type="button" onclick="closeDeleteModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="teamModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeTeamModal()">&times;</span>
        <h2>Add New Team</h2>
        <form action="Commands/add_team.php" method="POST" enctype="multipart/form-data">
            <label for="team_name">Team Name:</label>
            <input type="text" name="team_name" id="team_name" value="<?= $oldName ?>">
            <?php if (!empty($nameErr)) { ?>
                <p class="error-text"><?= $nameErr ?></p>
            <?php } ?>

            <label for="team_logo">Team Logo (Image):</label>
            <input type="file" name="team_logo" id="team_logo" accept="image/*">
            <?php if (!empty($logoErr)) { ?>
                <p class="error-text"><?= $logoErr ?></p>
            <?php } ?>

            <button type="submit">Add Team</button>
        </form>
    </div>
</div>

<div id="editTeamModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Team</h2>
        <form action="Commands/edit_team.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="team_id" id="edit_team_id">

            <label for="edit_team_name">Team Name:</label>
            <input type="text" name="team_name" id="edit_team_name" required>

            <label for="edit_team_logo">Team Logo (optional):</label>
            <input type="file" name="team_logo" id="edit_team_logo" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>


<script src="../JS/Form_modal.js"></script>
<script src="../JS/Sorting.js"></script>
<script>
    function openEditModal(teamId) {
        fetch(`Commands/get_team_data.php?id=${teamId}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById("edit_team_id").value = data.team.id;
                document.getElementById("edit_team_name").value = data.team.name;

                document.getElementById("editTeamModal").style.display = "block";
            });
    }

    function closeEditModal() {
        document.getElementById('editTeamModal').style.display = 'none';
    }

    function confirmDelete(teamId) {
        document.getElementById('delete_team_id').value = teamId;
        document.getElementById('deleteConfirmModal').style.display = 'block';
    }

    function closeDeleteModal() {
        document.getElementById('deleteConfirmModal').style.display = 'none';
    }

</script>