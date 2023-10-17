document.addEventListener('DOMContentLoaded', function () {
    const botonesEditar = document.querySelectorAll('.abrir-modal-editar');
    const editarForm = document.getElementById('editar-producto-form');
    const editarProductoIdInput = document.getElementById('editar-producto-id');
    const editarProductoNombreInput = document.getElementById('editar-producto-nombre');
    const editarProductoDescripcionInput = document.getElementById('editar-producto-descripcion');
    const editarProductoCodigoInput = document.getElementById('editar-producto-codigo');
    const editarProductoPVPInput = document.getElementById('editar-producto-pvp');
    const editarProductoPorcientoInput = document.getElementById('editar-producto-porciento');
    const editarProductoPTInput = document.getElementById('editar-producto-pt');
    const editarProductoCantidadInput = document.getElementById('editar-producto-cantidad');
    const editarProductoProveedorInput = document.getElementById('editar-producto-preveedor');

    botonesEditar.forEach(function (boton) {
        boton.addEventListener('click', function () {
            const productoId = boton.getAttribute('data-producto-id');
            const productoNombre = boton.getAttribute('data-producto-nombre');
            const productoDescripcion = boton.getAttribute('data-producto-descripcion');
            const productoPVP = boton.getAttribute('data-producto-pvp');
            const productoPorciento = boton.getAttribute('data-producto-porciento');
            const productoPT = boton.getAttribute('data-producto-pt');
            const productoCantidad = boton.getAttribute('data-producto-cantidad');
            const productoProveedor = boton.getAttribute('data-producto-proveedor');

            // Configura los valores de los campos del formulario con los datos del producto
            editarProductoIdInput.value = productoId;
            editarProductoNombreInput.value = productoNombre;
            editarProductoDescripcionInput.value = productoDescripcion;
            editarProductoPVPInput.value = productoPVP;
            editarProductoPorcientoInput.value = productoPorciento;
            editarProductoPTInput.value = productoPT;
            editarProductoCantidadInput.value = productoCantidad;
            editarProductoProveedorInput.value = productoProveedor;
        });
    });
});
