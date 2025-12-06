document.addEventListener('DOMContentLoaded', function() {
    function startVerticalCarousel(id, speed) {
        const container = document.getElementById(id);
        if (!container) return;
        
        const totalHeight = container.scrollHeight / 2;
        let scrollPosition = 0;
        let isHovering = false;
        
        container.innerHTML += container.innerHTML; // Duplicamos el contenido para el loop infinito

        container.addEventListener('mouseenter', () => { isHovering = true; });
        container.addEventListener('mouseleave', () => { isHovering = false; });
        
        setInterval(() => {
            if (!isHovering) {
                scrollPosition += speed;
                if (speed > 0) { // Carrusel hacia abajo
                if (scrollPosition >= totalHeight) {
                    scrollPosition = 0;
                }
            } else { // Carrusel hacia arriba (inverso)
                if (scrollPosition <= 0) {
                    scrollPosition = totalHeight;
                }
            }
                container.scrollTop = scrollPosition;
            }
        }, 50);
    }
    
    startVerticalCarousel('carousel1', 2);
    startVerticalCarousel('carousel2', -2); // SEGUNDO CARRUSEL EN DIRECCIÓN INVERSA
});