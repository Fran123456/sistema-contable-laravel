
    const tipoDescuentoSelect = document.getElementById('tipo_descuento');
    const descuentoInput = document.getElementById('descuento');
    const descuentoLabel = document.getElementById('descuento_label');

    tipoDescuentoSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        
        // Cambiar el texto del label al valor del select
        descuentoLabel.textContent = `Descuento (${selectedValue})`;

        if (selectedValue === '0') {
            // Bloquear el input si es "Sin descuento"
            descuentoInput.disabled = true;
            descuentoInput.value = 0;
        } else {
            // Desbloquear el input si hay descuento
            descuentoInput.disabled = false;

            if (selectedValue === '%') {
                // Establecer el rango para el porcentaje
                descuentoInput.min = 1;
                descuentoInput.max = 100;
            } else {
                // Eliminar el máximo para cantidad en $
                descuentoInput.min = 0.01;
                descuentoInput.removeAttribute('max');
            }
        }
    });

    // Inicializar el estado del input al cargar la página
    tipoDescuentoSelect.dispatchEvent(new Event('change'));
