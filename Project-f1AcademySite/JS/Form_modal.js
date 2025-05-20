function openDriverModal(){
    document.getElementById('driverModal').style.display = 'block';
}

function closeDriverModal(){
    document.getElementById('driverModal').style.display = 'none';
}

function openTeamModal(){
    document.getElementById("teamModal").style.display = "block";
}

function closeTeamModal(){
    document.getElementById("teamModal").style.display = "none";
}

function openAddNewsModal() {
    document.getElementById("addNewsModal").style.display = "block";
}

function closeAddNewsModal() {
    document.getElementById("addNewsModal").style.display = "none";
}

function openAddRaceModal() {
    document.getElementById("addRaceModal").style.display = "block";
}

function closeAddRaceModal() {
    document.getElementById("addRaceModal").style.display = "none";
}

function confirmDeleteDriver(driverId) {
    document.getElementById('delete_driver_id').value = driverId;
    document.getElementById('deleteDriverModal').style.display = 'block';
}

function closeDeleteDriverModal() {
    document.getElementById('deleteDriverModal').style.display = 'none';
}

function openDeleteNewsModal(newsId) {
    document.getElementById('delete_news_id').value = newsId;
    document.getElementById('deleteNewsModal').style.display = 'block';
}

function closeDeleteNewsModal() {
    document.getElementById('deleteNewsModal').style.display = 'none';
}

function openDeleteRaceModal(raceId) {
    document.getElementById('delete_race_id').value = raceId;
    document.getElementById('deleteRaceModal').style.display = 'block';
}

function closeDeleteRaceModal() {
    document.getElementById('deleteRaceModal').style.display = 'none';
}

window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
};

window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('nameErr') || urlParams.has('logoErr')) {
        openTeamModal();
    }

    if (
        urlParams.has('firstnameErr') ||
        urlParams.has('lastnameErr') ||
        urlParams.has('nationalityErr') ||
        urlParams.has('numberErr') ||
        urlParams.has('dobErr') ||
        urlParams.has('mainErr') ||
        urlParams.has('coverErr')
    ) {
        openDriverModal();
    }

    if (
        urlParams.has('nameErr') ||
        urlParams.has('locationErr') ||
        urlParams.has('startErr') ||
        urlParams.has('endErr') ||
        urlParams.has('coverErr') ||
        urlParams.has('circuitErr')
    ) {
        openAddRaceModal();
    }

    if (
        urlParams.has('titleErr') ||
        urlParams.has('descErr') ||
        urlParams.has('contentErr') ||
        urlParams.has('mainErr')
    ) {
        openAddNewsModal();
    }
};

window.onclick = function(event) {
    const raceModal = document.getElementById('deleteRaceModal');
    if (event.target === raceModal) {
        raceModal.style.display = 'none';
    }
};