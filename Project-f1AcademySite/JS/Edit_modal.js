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