@extends('plantillas.base')

@section('page_title', 'Informes Sobre Los Precios ')
@section('page_content')
<div class="container">
<!-- mensajes de ayuda -->
    
    

    
<!-- fin mensajes de ayuda -->

    <div class="row" style="margin-top:2%;">
        <div>
            <div class="card-box table-responsive">
            
            <table id="tablasdatatables-informeshistorialventas" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
              
                <tbody>
                    @foreach ($informesVentaProductos as $informe)
                        <tr>
                            <td>{{ $informe->id }}</td>
                            <td>{{ $informe->Fecha }}</td>
                            <td>{{ $informe->Nombre }}</td>
                            <td>{{ $informe->Codigo }}</td>
                            <td>{{ $informe->Cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
</div>
@endsection