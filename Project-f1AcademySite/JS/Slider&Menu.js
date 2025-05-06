console.log("Slider JS loaded") 

document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.getElementById("news-container");
    const btnLeft = document.getElementById("btn-left");
    const btnRight = document.getElementById("btn-right");

    const scrollAmount = 300;

    btnLeft.addEventListener("click", () => {
        wrapper.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    btnRight.addEventListener("click", () => {
        wrapper.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });
});

function toggleMenu() {
    const menu = document.querySelector('.list');
    menu.classList.toggle('active');
}