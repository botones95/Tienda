@extends('plantillas.base')

@section('page_title', 'Administracion de Productos')
@section('page_content')
<div class="container">
<!-- mensajes de ayuda -->
    @if (session('repetido'))
        <div class="alert alert-success">
            {{ session('repetido') }}
        </div>
    @endif
    @if (session('anadido'))
        <div class="alert alert-success">
            {{ session('anadido') }}
        </div>
    @endif
    @if (session('Eliminado'))
        <div class="alert alert-success">
            {{ session('Eliminado') }}
        </div>
    @endif
    @if (session('aumentado'))
        <div class="alert alert-success">
            {{ session('aumentado') }}
        </div>
    @endif
    @if (session('edit'))
        <div class="alert alert-success">
            {{ session('edit') }}
        </div>
    @endif
    
<!-- fin mensajes de ayuda -->
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#RegistrarProducto">
                Registrar Producto
            </button>
        </div>
    </div>

    <div class="row" style="margin-top:2%;">
        <div>
            <div class="card-box table-responsive">
            
            <table id="tablasdatatables-productos" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre de Productos</th>
                        <th>Descripcion</th>
                        <th>Código</th>
                        <th>PVP</th>
                        <th>Beneficio %</th>
                        <th>PT</th>
                        <th>Cantidad</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
              
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->Nombre }}</td>
                            <td>{{ $producto->Descripcion }}</td>
                            <td>{{ $producto->Codigo }}</td>
                            <td>{{ $producto->PVP }}</td>
                            <td>{{ $producto->Porciento }}</td>
                            <td>{{ $producto->PT }}</td>
                            <td>{{ $producto->Cantidad }}</td>
                            <td>{{ $producto->Proveedor }}</td>
                            <td>

                                <button type="button" class="btn btn-primary abrir-modal-editar"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditar"
                                    data-producto-id="{{ $producto->id }}"
                                    data-producto-nombre="{{ $producto->Nombre }}"
                                    data-producto-descripcion="{{ $producto->Descripcion }}"
                                    data-producto-pvp="{{ $producto->PVP }}"
                                    data-producto-porciento="{{ $producto->Porciento }}"
                                    data-producto-pt="{{ $producto->PT }}"
                                    data-producto-cantidad="{{ $producto->Cantidad }}"
                                    data-producto-proveedor="{{ $producto->Proveedor }}">
                                        Editar
                                </button>
                                
                                <button type="button" class="btn btn-danger abrir-modal-eliminar"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEliminar"
                                    data-route="{{ route('eliminarProducto', $producto->id) }}">
                                        Eliminar
                                </button>

                                <button type="button" class="btn btn-success abrir-modal-aumentar"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAumentarCantidad"
                                    data-producto-id="{{ $producto->id }}">
                                        Aumentar Cantidad
                                </button>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>


<!-- Modales -->

<!-- modal de registrar Producto -->
<div class="modal fade" id="RegistrarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Productos</h5>
            </div>

            <div class="modal-body">
                <form id="registrarProductoForm" action="{{ route('RegistrarProducto') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion del Producto (Opcional)</label>
                        <input type="text" name="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="codigo">Codigo del Producto</label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pvp">PVP del Producto Ejemplos 1,00 o 14,45</label>
                        <input type="number" name="pvp" class="form-control modal-pvp" step="any" required>
                    </div>
                    <div class="form-group">
                        <label for="porciento">% del Producto Ejemplos 30,00 o 75,25 </label>
                        <input type="number" name="porciento" class="form-control modal-porciento" step="any" required>
                    </div>
                    <div class="form-group">
                        <label for="pt">PT del Producto Ejemplos 1,50 o 30,20</label>
                        <input type="number" name="pt" class="form-control modal-pt" step="any" required>
                        <span class="modal-pt-calculado"></span> <!-- Aquí se mostrará el valor calculado -->
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad del Producto</label>
                        <input type="number" name="cantidad" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="proveedor">Nombre del Proveedor</label>
                        <input type="text" name="proveedor" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal de Eliminar Producto -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar el producto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <form action="" method="POST" id="eliminar-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para aumentar la cantidad -->
<div class="modal fade" id="modalAumentarCantidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aumentar Cantidad</h5>
            </div>
            <div class="modal-body">
                <form id="aumentar-cantidad-form" action="{{ route('aumentarCantidad') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nuevaCantidad">Nueva Cantidad:</label>
                        <input type="number" name="nuevaCantidad" class="form-control" required>
                    </div>
                    <!-- Campo oculto para almacenar el ID del producto -->
                    <input type="hidden" name="producto_id" id="modal-producto-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="aumentar-cantidad-form" class="btn btn-success">Aumentar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar información del producto -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
            </div>
            <div class="modal-body">
                <form id="editar-producto-form" action="{{ route('editarProducto') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="producto_id" id="editar-producto-id">
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" name="Nombre" id="editar-producto-nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción del Producto</label>
                        <input type="text" name="Descripcion" id="editar-producto-descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PVP">PVP del Producto</label>
                        <input type="number" name="PVP" id="editar-producto-pvp" class="form-control modal-pvp" step="any">
                    </div>
                    <div class="form-group">
                        <label for="Porciento">Beneficio del Producto</label>
                        <input type="number" name="Porciento" id="editar-producto-porciento" class="form-control modal-porciento" step="any">
                    </div>
                    <div class="form-group">
                        <label for="PT">PT del Producto</label>
                        <input type="number" name="PT" id="editar-producto-pt" class="form-control modal-pt" step="any">
                        <span class="modal-pt-calculado"></span>
                    </div>
                    <div class="form-group">
                        <label for="Cantidad">Cantidad del Producto</label>
                        <input type="number" name="Cantidad" id="editar-producto-cantidad" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Proveedor">Proveedor del Producto</label>
                        <input type="text" name="Proveedor" id="editar-producto-preveedor" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="editar-producto-form" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>





@endsection
