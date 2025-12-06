document.addEventListener('DOMContentLoaded', () => {
    // Función reutilizable para mostrar/ocultar contraseñas
    const setupPasswordToggle = (inputId, toggleId) => {
        const passwordInput = document.getElementById(inputId);
        const toggleButton = document.getElementById(toggleId);

        if (passwordInput && toggleButton) {
            toggleButton.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                const icon = toggleButton.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }
    };

    // Aplicar la funcionalidad a ambos campos de contraseña
    setupPasswordToggle('password', 'password-toggle');
    setupPasswordToggle('password_confirmation', 'password-confirmation-toggle');
});