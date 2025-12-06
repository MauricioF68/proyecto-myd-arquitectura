document.addEventListener('DOMContentLoaded', () => {

    // --- LÓGICA PARA EL PANEL DE FILTROS AVANZADOS ---
    const toggleFiltersBtn = document.getElementById('toggleFiltersBtn');
    const advancedFiltersPanel = document.getElementById('advancedFiltersPanel');

    if (toggleFiltersBtn && advancedFiltersPanel) {
        toggleFiltersBtn.addEventListener('click', () => {
            // Alterna la clase que muestra u oculta el panel
            advancedFiltersPanel.classList.toggle('is-visible');

            // Cambia el ícono y el texto del botón para dar retroalimentación
            const icon = toggleFiltersBtn.querySelector('i');
            const text = toggleFiltersBtn.querySelector('span');
            if (advancedFiltersPanel.classList.contains('is-visible')) {
                icon.classList.remove('fa-filter');
                icon.classList.add('fa-times');
                text.textContent = 'Cerrar Filtros';
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-filter');
                text.textContent = 'Más Filtros';
            }
        });
    }


    // --- LÓGICA PARA LA ANIMACIÓN DE ENTRADA DE LAS TARJETAS ---
    const animatedItems = document.querySelectorAll('.fade-in-item');

    if (animatedItems.length > 0) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    entry.target.style.transitionDelay = `${index * 100}ms`;
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        animatedItems.forEach(item => {
            observer.observe(item);
        });
    }

});