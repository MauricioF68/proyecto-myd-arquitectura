document.addEventListener('DOMContentLoaded', () => {
    // --- LÓGICA PARA LA VENTANA MODAL DE DETALLES ---

    // 1. Seleccionar los elementos del DOM
    const modalOverlay = document.getElementById('solicitudModal');
    const closeBtn = document.getElementById('modalCloseBtn');
    const tableBody = document.querySelector('.content-table tbody');

    // Elementos del modal que se actualizarán
    const modalNombre = document.getElementById('modal-nombre');
    const modalCorreo = document.getElementById('modal-correo');
    const modalCelular = document.getElementById('modal-celular');
    const modalTipo = document.getElementById('modal-tipo');
    const modalMensaje = document.getElementById('modal-mensaje');
    const modalWhatsappLink = document.getElementById('modal-whatsapp-link');

    // 2. Función para mostrar el modal
    const showModal = () => {
        if (modalOverlay) modalOverlay.classList.add('is-visible');
    };

    // 3. Función para ocultar el modal
    const hideModal = () => {
        if (modalOverlay) modalOverlay.classList.remove('is-visible');
    };

    // 4. Escuchar clics en la tabla (usando delegación de eventos)
    if (tableBody) {
        tableBody.addEventListener('click', (event) => {
            // Buscamos si el clic fue en un botón de "ver" o dentro de él
            const viewButton = event.target.closest('.view-btn');

            if (viewButton) {
                // Prevenir cualquier acción por defecto
                event.preventDefault();

                // Obtener los datos desde los atributos data-* del botón
                const data = viewButton.dataset;
                
                
                // Poblar el modal con los datos
                if (modalNombre) modalNombre.textContent = data.nombre;
                if (modalCorreo) {
                    modalCorreo.textContent = data.correo;
                    modalCorreo.href = `mailto:${data.correo}`;
                }
                if (modalCelular) modalCelular.textContent = data.celular;
                if (modalTipo) modalTipo.textContent = data.tipo;
                if (modalMensaje) modalMensaje.textContent = data.mensaje;
                
                // Construir y asignar el enlace de WhatsApp
                if (modalWhatsappLink && data.celular) {
                    const whatsappNumber = data.celular.replace(/[^0-9]/g, ''); // Limpiar el número
                    modalWhatsappLink.href = `https://wa.me/51${whatsappNumber}`;
                    
                }

                // Finalmente, mostrar el modal
                showModal();
            }
            
        });
    }
    

    // 5. Asignar eventos para cerrar el modal
    if (closeBtn) closeBtn.addEventListener('click', hideModal);
    if (modalOverlay) {
        modalOverlay.addEventListener('click', (event) => {
            // Se cierra solo si se hace clic en el fondo, no en la tarjeta de contenido
            if (event.target === modalOverlay) {
                hideModal();
            }
        });
    }
});
