document.addEventListener('DOMContentLoaded', function() {
    const soyPersonaRadio = document.getElementById('soy_persona');
    const soyEmpresaRadio = document.getElementById('soy_empresa');
    const camposEmpresaDiv = document.getElementById('campos_empresa');
    const rucInput = document.getElementById('ruc');
    const razonSocialInput = document.getElementById('razon_social');
    // El campo 'nombre_empresa' no es necesario si 'razon_social' cumple la función.

    // Función para mostrar/ocultar los campos de la empresa
    function toggleCamposEmpresa() {
        if (soyEmpresaRadio.checked) {
            camposEmpresaDiv.style.display = 'block';
        } else {
            camposEmpresaDiv.style.display = 'none';
        }
    }

    soyPersonaRadio.addEventListener('change', toggleCamposEmpresa);
    soyEmpresaRadio.addEventListener('change', toggleCamposEmpresa);
    // Ejecuta la función al cargar la página para establecer el estado inicial
    toggleCamposEmpresa();

    // Event listener para el campo RUC
    rucInput.addEventListener('input', function() {
        const ruc = rucInput.value.trim();

        // Limpiar campo si el RUC no es válido
        if (ruc.length !== 11) {
            razonSocialInput.value = '';
            return; // Salir de la función si no hay 11 dígitos
        }

        // Si es la longitud correcta, mostramos un estado de carga
        razonSocialInput.value = 'Consultando...';

        fetch(`/consultar-ruc/${ruc}`)
            .then(response => {
                if (!response.ok) {
                    // Lanza un error si la respuesta del servidor no es exitosa (ej. 404, 500)
                    throw new Error('Respuesta del servidor no fue exitosa.');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    razonSocialInput.value = data.error;
                } else {
                    razonSocialInput.value = data.razon_social || '';
                }
            })
            .catch(error => {
                console.error('Error en la consulta de RUC:', error);
                razonSocialInput.value = 'Error al consultar. Verifique el RUC.';
            });
    });
});