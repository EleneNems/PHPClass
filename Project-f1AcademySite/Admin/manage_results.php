<?php
include '../Includes/connect.php';
$sql = "SELECT id, name FROM race_events ORDER BY start_date asc";
$result = mysqli_query($conn, $sql);

function old($key)
{
    return $_GET[$key] ?? '';
}
?>

<div class="manage-results-container">
    <h2>Manage Results</h2>

    <label for="race_select">Select Race:</label>
    <select id="race_select" name="race_select" class="race_select" onchange="fetchSessions(this.value)">
        <option value="">Choose a Race</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        ?>
    </select>

    <div id="sessions_section" class="hidden">
        <div id="event_dates" class="event-dates"></div>
        <h3>Sessions</h3>
        <button onclick="openAddSessionModal()">+ Add Session</button>

        <div class="session-list">
        </div>
    </div>
</div>

<div id="addSessionModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddSessionModal()">&times;</span>
        <h3>Add Session</h3>
        <form id="addSessionForm" method="POST" action="Commands/add_session.php">
            <input type="hidden" name="event_id" id="modal_event_id" value="<?= $_GET['event_id'] ?? '' ?>">

            <label>Session Type:</label>
            <select name="type">
                <option value="practice" <?= old('type') === 'practice' ? 'selected' : '' ?>>Practice</option>
                <option value="qualifying" <?= old('type') === 'qualifying' ? 'selected' : '' ?>>Qualifying</option>
                <option value="race_1" <?= old('type') === 'race_1' ? 'selected' : '' ?>>Race 1</option>
                <option value="race_2" <?= old('type') === 'race_2' ? 'selected' : '' ?>>Race 2</option>
            </select>
            <?php if (isset($_GET['typeErr']))
                echo "<p class='error-text'>{$_GET['typeErr']}</p>"; ?>

            <label>Date & Time:</label>
            <input type="datetime-local" name="date_time" value="<?= old('date_time') ?>">
            <?php if (isset($_GET['dateErr']))
                echo "<p class='error-text'>{$_GET['dateErr']}</p>"; ?>
            <button type="submit">Add Session</button>
        </form>
    </div>
</div>

<div id="deleteSessionModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteSessionModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this session?</p>
        <form id="confirmSessionDeleteForm" method="POST" action="Commands/delete_session.php">
            <input type="hidden" name="session_id" id="delete_session_id">
            <input type="hidden" name="event_id" id="delete_event_id">
            <button type="submit" class="delete-btn">Yes, Delete</button>
            <button type="button" onclick="closeDeleteSessionModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="uploadResultsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUploadResultsModal()">&times;</span>
        <h3>Upload Session Results (JSON)</h3>
        <form id="uploadResultsForm" method="POST" enctype="multipart/form-data" action="Commands/upload_results.php">
            <input type="hidden" name="session_id" id="upload_session_id">
            <input type="file" name="results_file" accept=".json" required>
            <button type="submit">Upload</button>
        </form>
    </div>
</div>

<script src="../JS/Fetch_sessions.js"></script>
<script src="../JS/Form_modal.js?v=3" defer></script>

<script defer>
    window.openAddSessionModal = function () {
        const raceId = document.getElementById("race_select").value;
        if (raceId) {
            document.getElementById("modal_event_id").value = raceId;
            document.getElementById("addSessionModal").style.display = "block";
        }
    };

    window.closeAddSessionModal = function () {
        document.getElementById("addSessionModal").style.display = "none";
    };

    window.onload = function () {
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('event_id');
        const typeErr = urlParams.get('typeErr');
        const dateErr = urlParams.get('dateErr');

        if (eventId) {
            const raceSelect = document.getElementById('race_select');
            raceSelect.value = eventId;

            const changeEvent = new Event('change');
            raceSelect.dispatchEvent(changeEvent);

            document.getElementById('modal_event_id').value = eventId;

            const sessionsSection = document.getElementById('sessions_section');
            sessionsSection.style.display = 'block';

            if (typeof fetchSessions === 'function') {
                fetchSessions(eventId);
            }

            if (typeErr || dateErr) {
                setTimeout(() => {
                    openAddSessionModal();
                }, 300);
            }
        }
    };

    function openDeleteSessionModal(sessionId) {
        document.getElementById('delete_session_id').value = sessionId;
        document.getElementById('deleteSessionModal').style.display = 'block';
    }

    function closeDeleteSessionModal() {
        document.getElementById('deleteSessionModal').style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('event_id');
        const typeErr = urlParams.get('typeErr');
        const dateErr = urlParams.get('dateErr');

        if (eventId) {
            const raceSelect = document.getElementById('race_select');
            raceSelect.value = eventId;

            const changeEvent = new Event('change');
            raceSelect.dispatchEvent(changeEvent);

            document.getElementById('modal_event_id').value = eventId;

            document.getElementById('sessions_section').style.display = 'block';

            if (typeof fetchSessions === 'function') {
                fetchSessions(eventId);
            }

            if (typeErr || dateErr) {
                setTimeout(() => {
                    openAddSessionModal();
                }, 300);
            }
        }
    });

    function uploadResults(sessionId) {
        document.getElementById('upload_session_id').value = sessionId;
        document.getElementById('uploadResultsModal').style.display = 'block';
    }
    function closeUploadResultsModal() {
        document.getElementById('uploadResultsModal').style.display = 'none';
    }

</script>