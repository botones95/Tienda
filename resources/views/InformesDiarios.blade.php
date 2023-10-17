@extends('plantillas.base')

@section('page_title', 'Informes Diarios')
@section('page_content')
<div class="container">
<!-- mensajes de ayuda -->
    
    

    
<!-- fin mensajes de ayuda -->
    <div class="row" style="margin-top:2%;">
        <div>
            <div class="card-box table-responsive">
            
            <table id="tablasdatatables-informesdiarios" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Dia</th>
                        <th>Mañana</th>
                        <th>Tarde</th>
                        <th>Total</th>
                    </tr>
                </thead>
              
                <tbody>
                    @foreach ($informesDiarios as $informe)
                        <tr>
                            <td>{{ $informe->id }}</td>
                            <td>{{ $informe->Dia }}</td>
                            <td>{{ $informe->Manana }}</td>
                            <td>{{ $informe->Tarde }}</td>
                            <td>{{ $informe->Total }}</td>
  
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
</div>

@endsection