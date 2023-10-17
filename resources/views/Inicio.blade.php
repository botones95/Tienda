@extends('plantillas.base')
@section('page_title', 'Inicio')
@section('page_content')
<div>
    <!-- mensajes de error -->
        @if (session('conexionBD'))
            <div class="alert alert-success">
                {{ session('conexionBD') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif
        

    <!-- fin mensajes de error -->
    <div>
        <div class="row">

            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/inicio"><i class="fs-1 bi bi-house"></i>
                        <h4>Inicio</h4></a>
                        <p>Inicio de nuestra tienda</p>
                </div>
            </div>
            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/Productos"><i class="fs-1 bi bi-archive"></i>
                        <h4>Productos</h4></a>
                        <p>Acceso a los productos, donde podrá editar y modificar sus datos.</p>
                </div>
            </div>
            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/Ventas"><i class="fs-1 bi bi-cart-check"></i>
                        <h4>Ventas</h4></a>
                        <p>Le redirije a ventas, donde podrá realizar las operaciones de venta al cliente.</p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/Devoluciones"><i class="fs-1 bi bi-cart-dash"></i>
                        <h4>Devoluciones</h4></a>
                        <p>Le redirije a devoluciones, donde podrá realizar las operaciones de devolucion al cliente.</p>
                </div>
            </div>
            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/InformesDiarios"><i class="fs-1 bi bi-paperclip"></i>
                        <h4>Informes Diarios</h4></a>
                        <p>Podrá ver y descargar todos los informes diarios que se han emitido.</p>
                </div>
            </div>
            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/InformesMeses"><i class="fs-1 bi bi-paperclip"></i>
                        <h4>Informes Por Meses</h4></a>
                        <p>Podrá ver y descargar todos los informes agrupados y ordenados por meses que se han emitido.</p>
                </div>
            </div>
            
        </div>

        <div class="row">

            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/InformesHistorialPreciosProductos"><i class="fs-1 bi bi-paperclip"></i>
                        <h4>Informes De Precios</h4></a>
                        <p>Podrá ver y descargar todos los informes sobre los precios de los productos que se han emitido.</p>
                </div>
            </div>
            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/InformesHistorialVentaProductos"><i class="fs-1 bi bi-paperclip"></i>
                        <h4>Informes Sobre Ventas</h4></a>
                        <p>Podrá ver y descargar todos los informes sobre los productos y las ventas de estos agrupados por mes que se han emitido.</p>
                </div>
            </div>
            <div class="col">
                <div class="animate__animated animate__bounce mi-div">
                        <a href="/Finalizarturno"><i class="fs-1 bi bi-calendar2-check"></i>
                        <h4>Finalizar Turno</h4></a>
                        <p>Finalizaria el turno actual mostrando la suma de las ventas realizadas en el dia.</p>
                </div>
            </div>
            
        </div>
        

        
        
        
    </div>
</div>
    
@endsection