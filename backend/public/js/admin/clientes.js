document.addEventListener('DOMContentLoaded', () => {
    const modalOverlay = document.getElementById('clientModal');
    const closeBtn = document.getElementById('modalCloseBtn');
    const tableBody = document.querySelector('.content-table tbody');

    const modalName = document.getElementById('modal-name');
    const modalEmail = document.getElementById('modal-email');
    const modalStatus = document.getElementById('modal-status');
    const modalRegistered = document.getElementById('modal-registered');

    const showModal = () => {
        if (modalOverlay) modalOverlay.classList.add('is-visible');
    };
    const hideModal = () => {
        if (modalOverlay) modalOverlay.classList.remove('is-visible');
    };

    const handleStatusClick = () => {
        const userId = modalStatus.dataset.userId;
        if (!userId) return;

        modalStatus.textContent = 'Actualizando...';

        fetch(`/admin/clientes/${userId}/toggle-verification`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('La respuesta del servidor no fue exitosa.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const isVerified = data.nuevoEstado === 'Verificado';
                
                // 1. Actualizamos el modal (esto ya lo hacías bien)
                modalStatus.textContent = data.nuevoEstado;
                modalStatus.className = 'status ' + (isVerified ? 'status-verified' : 'status-not-verified');
                
                // 2. ✅ LA CORRECCIÓN: Actualizamos el atributo 'data-verified' en el botón de la tabla.
                //    Esta es la "memoria" que el modal leerá la próxima vez.
                const viewButtonInTable = document.querySelector(`.view-btn[data-user-id="${userId}"]`);
                if (viewButtonInTable) {
                    viewButtonInTable.dataset.verified = isVerified ? 'Sí' : 'No';
                }

            } else {
                 // Manejar el caso donde success es false
                 console.error('La operación no fue exitosa:', data.message);
                 modalStatus.textContent = 'Error al actualizar';
            }
        })
        .catch(error => {
            console.error('Error al cambiar estado:', error);
            modalStatus.textContent = 'Error';
        });
    };
    
    if (modalStatus) {
        modalStatus.addEventListener('click', handleStatusClick);
    }

    if (tableBody) {
        tableBody.addEventListener('click', (event) => {
            const viewButton = event.target.closest('.view-btn');
            if (viewButton) {
                event.preventDefault();
                const data = viewButton.dataset;
                
                if (modalName) modalName.textContent = data.name;
                if (modalEmail) {
                    modalEmail.textContent = data.email;
                    modalEmail.href = `mailto:${data.email}`;
                }
                if (modalRegistered) modalRegistered.textContent = data.created;
                
                if (modalStatus) {
                    modalStatus.dataset.userId = data.userId; 
                    const isVerified = data.verified === 'Sí';
                    modalStatus.textContent = isVerified ? 'Verificado' : 'No Verificado';
                    modalStatus.className = 'status ' + (isVerified ? 'status-verified' : 'status-not-verified');
                }
                showModal();
            }
        });
    }

    if (closeBtn) closeBtn.addEventListener('click', hideModal);
    if (modalOverlay) {
        modalOverlay.addEventListener('click', (event) => {
            if (event.target === modalOverlay) hideModal();
        });
    }
});