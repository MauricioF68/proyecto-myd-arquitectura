document.addEventListener('DOMContentLoaded', () => {
    // Busca todos los contenedores de subida de archivos personalizados
    const fileInputs = document.querySelectorAll('.custom-file-input-wrapper');

    fileInputs.forEach(wrapper => {
        const input = wrapper.querySelector('input[type="file"]');
        const display = wrapper.querySelector('.file-name-display');
        const labelText = wrapper.querySelector('.custom-file-input-label span');
        const originalLabelText = labelText.textContent;

        if (input && display && labelText) {
            input.addEventListener('change', () => {
                if (input.files.length > 0) {
                    // Si se seleccionan varios archivos, muestra el número de archivos
                    if (input.multiple) {
                        display.textContent = `${input.files.length} archivos seleccionados`;
                    } else {
                        // Si es un solo archivo, muestra el nombre
                        display.textContent = input.files[0].name;
                    }
                    labelText.textContent = '¡Archivos listos para subir!';
                } else {
                    // Si se cancela la selección, restaura el texto original
                    display.textContent = '';
                    labelText.textContent = originalLabelText;
                }
            });
        }
    });
});