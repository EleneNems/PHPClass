function openTeamModal() {
    document.getElementById("teamModal").style.display = "block";
}

function closeTeamModal() {
    document.getElementById("teamModal").style.display = "none";
}

window.onclick = function(event) {
    if (event.target.classList.contains("modal")) {
        closeTeamModal();
    }
}

window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    if (params.has('nameErr') || params.has('logoErr')) {
        openTeamModal(); 
    }
};

window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('nameErr') || urlParams.has('logoErr')) {
        document.getElementById('teamModal').style.display = 'block';
    }
};