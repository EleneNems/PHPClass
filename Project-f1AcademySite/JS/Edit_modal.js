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

function openEditDriverModal(driverId) {
    fetch(`Commands/get_driver_data.php?id=${driverId}`)
        .then(res => res.json())
        .then(data => {
            const d = data.driver;
            document.getElementById("edit_driver_id").value = d.id;
            document.getElementById("edit_firstname").value = d.firstname;
            document.getElementById("edit_lastname").value = d.lastname;
            document.getElementById("edit_nationality").value = d.nationality;
            document.getElementById("edit_support").value = d.support;
            document.getElementById("edit_number").value = d.racing_number;
            document.getElementById("edit_dob").value = d.dob;
            document.getElementById("edit_team").value = d.team_id || '';

            document.getElementById("editDriverModal").style.display = "block";
        });
}

function closeEditDriverModal() {
    document.getElementById('editDriverModal').style.display = 'none';
}