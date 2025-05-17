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

window.onclick = function(event){
    if (event.target.classList.contains("modal")) {
        closeTeamModal();
        closeDriverModal();
    }
}

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
};

function confirmDeleteDriver(driverId) {
    document.getElementById('delete_driver_id').value = driverId;
    document.getElementById('deleteDriverModal').style.display = 'block';
}

function closeDeleteDriverModal() {
    document.getElementById('deleteDriverModal').style.display = 'none';
}

function openAddNewsModal() {
    document.getElementById("addNewsModal").style.display = "block";
}

function closeAddNewsModal() {
    document.getElementById("addNewsModal").style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById("addNewsModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};