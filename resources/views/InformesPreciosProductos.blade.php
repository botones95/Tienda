@extends('plantillas.base')

@section('page_title', 'Informes Sobre Los Precios ')
@section('page_content')
<div class="container">
<!-- mensajes de ayuda -->
    
    

    
<!-- fin mensajes de ayuda -->
    <div class="row" style="margin-top:2%;">
        <div>
            <div class="card-box table-responsive">
            
            <table id="tablasdatatables-InformesHistorialPreciosProductos" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>PVP</th>
                        <th>Porciento</th>
                        <th>PT</th>
                    </tr>
                </thead>
              
                <tbody>
                    @foreach ($informesPreciosProductos as $informe)
                        <tr>
                            <td>{{ $informe->id }}</td>
                            <td>{{ $informe->Nombre }}</td>
                            <td>{{ $informe->Codigo }}</td>
                            <td>{{ $informe->Fecha }}</td>
                            <td>{{ $informe->PVP }}</td>
                            <td>{{ $informe->Porciento }}</td>
                            <td>{{ $informe->PT }}</td>
  
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
</div>
@endsection