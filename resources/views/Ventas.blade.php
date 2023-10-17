@extends('plantillas.base')

@section('page_title', 'Ventas')
@section('page_content')
<div class="container">
<!-- mensajes de ayuda -->
    @if (session('anadido'))
        <div class="alert alert-success">
            {{ session('anadido') }}
        </div>
    @endif
    @if (session('noencontrado'))
        <div class="alert alert-success">
            {{ session('noencontrado') }}
        </div>
    @endif
    

    
<!-- fin mensajes de ayuda -->
    <div class="row">
        <div class="col-sm-9">
            <form action="/Ventas/anadirProducto" method="POST">
            @csrf
            @method('POST')  
                <div class="row">
                    <div class="col-sm-3">
                        <button type="submit" value="anadir" class="btn btn-primary">Añadir Producto</button> 
                    </div>

                    <div class="col">
                        <input type="text" required="required" name="anadir" class="form-control" placeholder="Añadir Codigo de Barras"> 
                    </div>
                </div>
                   
            </form>   
        </div>
    
        <div class="col-sm-3">
            <form action="/Ventas/cancelarVenta" method="POST" id="contactUSForm">
                @csrf
                @method('POST')
                <button type="submit" value="anadir" class="btn btn-primary">Cancelar Venta</button>            
            </form>  
        </div>
    </div>

    <div class="row" style="margin-top:2%;">
        <div>
            <div class="card-box table-responsive">
            
            <table id="tablasdatatables-ventas" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Nombre de Productos</th>
                        <th>Código</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Precio Total</th>
                    </tr>
                </thead>
              
                <tbody>
                    @foreach ($listaventas as $venta)
                        <tr>
                            <td>
                                <form action="/Ventas/eliminarProducto/{{ $venta->id }}" method="POST" id="contactUSForm">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" value="anadir" class="btn btn-primary">Eliminar</button>            
                                </form>
                            </td>
                            <td>{{ $venta->Nombre }}</td>
                            <td>{{ $venta->Codigo }}</td>
                            <td>
                                <form action="/Ventas/actualizarCantidad/{{ $venta->Codigo }}" method="POST" id="form-{{ $venta->Codigo }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-link btn-up" data-key="{{ $venta->Codigo }}" name="action"  value="arriba">▲</button>
                                    <input type="number" required="required" name="cantidad" class="form-control input-cantidad" value="{{ $venta->Cantidad }}">
                                    <button type="submit" class="btn btn-link btn-down" data-key="{{ $venta->Codigo }}" name="action" value="abajo">▼</button>               
                                </form>
                            </td>
                            <td>{{ $venta->PT }}</td>
                            <td>{{ $venta->PTT }}</td>
                            
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
    <div class="row">
            <!-- Cuenta a pagar -->
            @php
                $totalAPagar = 0;
            @endphp

            @foreach ($listaventas as $venta)
                @php
                    $totalAPagar += $venta->PTT;
                @endphp
            @endforeach
            @php
                $totalAPagarFormateado = number_format($totalAPagar, 2);
            @endphp
            <p name="cuenta" style="font-size: 200%;">Total a pagar: {{ $totalAPagarFormateado }}</p>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#finalizarventa">
                Finalizar Venta
            </button>
    </div>
</div>


<!-- Ventanas modales -->

<!-- modal finalizar venta -->
<div class="modal fade" id="finalizarventa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5  id="exampleModalLabel" style="display: flex; justify-content: center; align-items: center;">Finalizar Venta</h5>
            </div>

            <div class="modal-body">
            <form id="registrarProductoForm" action="{{ route('finalizarventa') }}" method="POST">
                        @csrf
                        <table style="width:100%;border:solid black">
                            <thead style="border:solid black">
                                <tr style="border:solid black">

                                    <th style="border:solid black">Nombre de Productos</th>
                                    <th style="border:solid black">Cantidad</th>
                                    <th style="border:solid black">Precio Invividual</th>
                                    <th style="border:solid black">Precio total</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($listaventas as $listaventa)
                                    <tr style="border:solid black">
                                        <td style="border:solid black">{{ $listaventa->Nombre }}</td>
                                        <td style="border:solid black">{{ $listaventa->Cantidad }}</td>
                                        <td style="border:solid black">{{ $listaventa->PT }}</td>
                                        <td style="border:solid black">{{ $listaventa->PTT }}</td>
                            @endforeach            
                            </tbody>
                        </table>
                        @php
                            $totalAPagar = 0;
                        @endphp

                        @foreach ($listaventas as $producto)
                            @php
                                $totalAPagar += $producto->PTT;
                            @endphp
                        @endforeach
                        @php
                            $totalAPagarFormateado = number_format($totalAPagar, 2);
                        @endphp
                        <p name="cuenta" style="font-size: 200%;">Total a pagar: {{ $totalAPagarFormateado }}</p>

                        <input type="hidden" name="totalAPagar" value="{{ $totalAPagar }}">
                    
                        
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" name="ticket" value="ticketsi">Finalizar Con Ticket</button>
                <button type="submit" class="btn btn-primary" name="ticket" value="ticketno">Finalizar Sin Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection