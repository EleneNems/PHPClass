function addPhotoField() {
    const container = document.getElementById('extra-photos');
    const photoSet = document.createElement('div');
    photoSet.classList.add('photo-set');

    const uniqueId = `photo-${Date.now()}`;

    photoSet.innerHTML = `
        <div class="file-upload-wrapper">
            <label class="custom-upload-btn">Choose File
                <input type="file" name="photos[]" class="hidden-input additional-photo">
            </label>
            <span class="file-name">No file chosen</span>
        </div>
        <input type="text" name="captions[]" placeholder="Caption">
    `;

    container.appendChild(photoSet);
}

document.getElementById("main_picture").addEventListener("change", function () {
    const fileName = this.files[0] ? this.files[0].name : "No file chosen";
    document.getElementById("main-file-name").textContent = fileName;
});

document.addEventListener("change", function (e) {
    if (e.target.matches(".additional-photo")) {
        const fileName = e.target.files[0] ? e.target.files[0].name : "No file chosen";
        const fileNameSpan = e.target.closest(".file-upload-wrapper").querySelector(".file-name");
        if (fileNameSpan) fileNameSpan.textContent = fileName;
    }
});


document.getElementById("main_picture").addEventListener("change", function () {
    const fileName = this.files[0] ? this.files[0].name : "No file chosen";
    document.getElementById("main-file-name").textContent = fileName;
});

document.getElementById("content_file").addEventListener("change", function () {
    const fileName = this.files[0] ? this.files[0].name : "No file chosen";
    document.getElementById("content-file-name").textContent = fileName;
});