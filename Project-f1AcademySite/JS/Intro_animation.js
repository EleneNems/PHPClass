document.body.classList.add("no-scroll");

window.addEventListener("load", () => {
    if (sessionStorage.getItem("introPlayed")) {
        document.getElementById("introAnimation").style.display = "none";
        document.body.classList.remove("no-scroll");
        document.querySelector("header").classList.remove("hidden-during-intro");
        return;
    }

    sessionStorage.setItem("introPlayed", "true");

    const intro = document.getElementById("introAnimation");
    const logo = document.querySelector(".logo-drop");
    const car = document.querySelector(".f1-car");
    const bubble = document.querySelector(".annoyed-bubble");
    const header = document.querySelector("header");

    document.body.classList.add("no-scroll");
    header.classList.add("hidden-during-intro");

    setTimeout(() => {
        logo.style.animation = "logoPushed 2.2s forwards ease-in-out";
        car.style.animation = "carPush 2.2s forwards ease-in-out";
        bubble.classList.add("bubble-hide");

        setTimeout(() => {
            intro.style.opacity = "0";
            intro.style.transition = "opacity 0.8s ease";
            header.classList.remove("hidden-during-intro");

            setTimeout(() => {
                intro.style.display = "none";
                document.body.classList.remove("no-scroll");
            }, 800);
        }, 1500);
    }, 5500);
});

document.body.classList.remove("no-scroll");