function toggleLogout() {
    const menu = document.getElementById("logoutMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

function closeLogoutMenu() {
    const menu = document.getElementById("logoutMenu");
    if (menu) menu.style.display = "none";
}

function openDeleteConfirm(event) {
    event.preventDefault();
    closeLogoutMenu();
    document.getElementById("confirmDeleteModal").style.display = "flex";
}

function closeConfirmModal() {
    document.getElementById("confirmDeleteModal").style.display = "none";
}

function proceedToPassword() {
    closeConfirmModal();
    document.getElementById("passwordModal").style.display = "flex";
}

function closePasswordModal() {
    document.getElementById("passwordModal").style.display = "none";
    document.getElementById("deletePassword").value = "";
    document.getElementById("deleteError").style.display = "none";
}

function submitAccountDeletion() {
    const password = document.getElementById("deletePassword").value

    const formData = new URLSearchParams()
    formData.append('password', password)

    fetch('Includes/delete_account.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    })

    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.href = 'index.php';
        } else {
            document.getElementById("deleteError").style.display = "block";
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
        document.getElementById("deleteError").textContent = "Server error. Try again later.";
        document.getElementById("deleteError").style.display = "block";
    });
}