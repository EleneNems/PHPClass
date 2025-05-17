function filterDrivers() {
    const search = document.getElementById("driverSearch").value.toLowerCase();
    const minPoints = parseInt(document.getElementById("pointsFilter").value) || 0;
    const rows = document.querySelectorAll("#driversTable tbody tr");

    rows.forEach(row => {
        const name = row.children[0].textContent.toLowerCase();
        const points = parseInt(row.children[6].textContent);

        if (name.includes(search) && points >= minPoints) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
