document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');

    toggle.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggle.classList.toggle('fa-eye');
        toggle.classList.toggle('fa-eye-slash');
    });
});
