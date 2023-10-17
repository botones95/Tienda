document.addEventListener('DOMContentLoaded', function () {
    const botonesAumentarCantidad = document.querySelectorAll('.abrir-modal-aumentar');
    const modalProductoIdInput = document.getElementById('modal-producto-id');

    botonesAumentarCantidad.forEach(function (boton) {
        boton.addEventListener('click', function () {
            const productoId = boton.getAttribute('data-producto-id');
            modalProductoIdInput.value = productoId;
        });
    });
});
