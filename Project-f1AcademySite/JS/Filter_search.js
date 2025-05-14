const searchInput = document.getElementById('userSearch');
const roleFilter = document.getElementById('roleFilter');
const rows = document.querySelectorAll('.user-table tbody tr');

function filterUsers() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedRole = roleFilter.value;

    rows.forEach(row => {
        const firstName = row.children[1].textContent.toLowerCase();
        const lastName = row.children[2].textContent.toLowerCase();
        const fullName = firstName + " " + lastName;
        const email = row.children[3].textContent.toLowerCase();
        const role = row.querySelector('.badge')?.textContent.trim().toLowerCase();

        const matchesSearch = fullName.includes(searchTerm) || email.includes(searchTerm);
        const matchesRole = selectedRole === "" || role === selectedRole;

        if (matchesSearch && matchesRole) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

searchInput.addEventListener('input', filterUsers);
roleFilter.addEventListener('change', filterUsers);
