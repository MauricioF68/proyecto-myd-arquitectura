document.addEventListener('DOMContentLoaded', function() {
    
    // --- Lógica original del menú de perfil ---
    const userProfileMenu = document.getElementById('userProfileMenu');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (userProfileMenu) {
        userProfileMenu.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });
    }

    window.addEventListener('click', function(event) {
        if (dropdownMenu && dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        }
    });


    // --- NUEVA Lógica para la barra lateral (Sidebar) ---
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if (menuToggle && sidebar && overlay) {
        // Abrir la sidebar
        menuToggle.addEventListener('click', function() {
            sidebar.classList.add('is-active');
            overlay.classList.add('is-active');
        });

        // Cerrar la sidebar haciendo clic en el overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('is-active');
            overlay.classList.remove('is-active');
        });
    }
});