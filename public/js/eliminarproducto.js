document.addEventListener('DOMContentLoaded', function () {
    const botonesEliminar = document.querySelectorAll('.abrir-modal-eliminar');
    const eliminarForm = document.getElementById('eliminar-form');

    botonesEliminar.forEach(function (boton) {
        boton.addEventListener('click', function () {
            const route = boton.getAttribute('data-route');

            // Actualiza la acción del formulario de eliminación con la ruta correcta
            eliminarForm.setAttribute('action', route);

            // Obtiene y muestra el ID del producto en el modal
            const productoId = boton.getAttribute('data-producto-id');
            const productoIdSpan = document.getElementById('producto-id');
            productoIdSpan.textContent = productoId;
        });
    });
});