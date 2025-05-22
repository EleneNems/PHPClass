
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

function openEditModal(id) {
    const card = document.querySelector(`.news-card button[onclick="openEditModal(${id})"]`).closest('.news-card');
    const title = card.querySelector('h3').innerText;
    const description = card.querySelector('strong').innerText;

    document.getElementById('edit_news_id').value = id;
    document.getElementById('edit_news_title').value = title;
    document.getElementById('edit_news_description').value = description;

    document.getElementById('editNewsModal').style.display = 'block';
}

function closeEditNewsModal() {
    document.getElementById('editNewsModal').style.display = 'none';
}

function openEditRaceModal(id) {
    const card = document.querySelector(`.race-card button[onclick="openEditRaceModal(${id})"]`).closest('.race-card');

    const name = card.querySelector('h3').innerText;
    const location = card.querySelector('p:nth-of-type(1)').innerText.replace('Location: ', '');
    const start = card.querySelector('p:nth-of-type(2)').innerText.replace('Start: ', '');

    const startDate = new Date(start).toISOString().split('T')[0];

    document.getElementById('edit_race_id').value = id;
    document.getElementById('edit_race_name').value = name;
    document.getElementById('edit_race_location').value = location;
    document.getElementById('edit_race_start').value = startDate;

    document.getElementById('editRaceModal').style.display = 'block';
}

function closeEditRaceModal() {
    document.getElementById('editRaceModal').style.display = 'none';
}