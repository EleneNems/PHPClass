document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".session-box .session-header").forEach(header => {
        if (header.textContent.trim() === "COMING SOON") return;

        header.addEventListener("click", () => {
            const sessionBox = header.closest(".session-box");
            sessionBox.classList.toggle("open");

            const rows = sessionBox.querySelectorAll(".result-table tbody tr");
            
            if (sessionBox.classList.contains("open")) {
                rows.forEach((row, index) => {
                    row.style.opacity = "0";
                    row.style.transform = "translateY(10px)";
                    row.style.transition = "none";

                    setTimeout(() => {
                        row.style.transition = "opacity 0.4s ease, transform 0.4s ease";
                        row.style.opacity = "1";
                        row.style.transform = "translateY(0)";
                    }, index * 100); 
                });
            } else {
                rows.forEach(row => {
                    row.style.transition = "none";
                    row.style.opacity = "0";
                    row.style.transform = "translateY(10px)";
                });
            }
        });
    });
});
