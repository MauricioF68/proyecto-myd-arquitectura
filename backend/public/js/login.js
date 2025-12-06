document.addEventListener('DOMContentLoaded', () => {
    // --- Lógica para mostrar/ocultar contraseña ---
    const passwordInput = document.getElementById('password');
    const toggleButton = document.getElementById('password-toggle');

    if (passwordInput && toggleButton) {
        toggleButton.addEventListener('click', () => {
            // Cambiar el tipo de input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Cambiar el icono del botón
            const icon = toggleButton.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }
});