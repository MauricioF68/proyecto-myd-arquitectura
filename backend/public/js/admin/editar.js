document.addEventListener('DOMContentLoaded', () => {
    // Busca todos los contenedores de subida de archivos personalizados
    const fileInputs = document.querySelectorAll('.custom-file-input-wrapper');

    fileInputs.forEach(wrapper => {
        const input = wrapper.querySelector('input[type="file"]');
        const display = wrapper.querySelector('.file-name-display');
        const labelText = wrapper.querySelector('.custom-file-input-label span');
        const originalLabelText = labelText.textContent;
        const preview = wrapper.parentElement.querySelector('.file-preview'); // Busca el preview

        if (input && display && labelText) {
            input.addEventListener('change', () => {
                // Si se selecciona un archivo nuevo, oculta la previsualización de la imagen antigua
                if (preview) {
                    preview.style.display = 'none';
                }

                if (input.files.length > 0) {
                    if (input.multiple) {
                        display.textContent = `${input.files.length} archivos seleccionados`;
                    } else {
                        display.textContent = input.files[0].name;
                    }
                    labelText.textContent = '¡Archivos listos para subir!';
                } else {
                    display.textContent = '';
                    labelText.textContent = originalLabelText;
                    // Si se cancela la selección, vuelve a mostrar la previsualización si existía
                    if (preview) {
                        preview.style.display = 'block';
                    }
                }
            });
        }
    });
});