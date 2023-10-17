@extends('plantillas.base')

@section('page_title', 'Informes Por Meses')
@section('page_content')
<div class="container">
<!-- mensajes de ayuda -->
    
    

    
<!-- fin mensajes de ayuda -->
    <div class="row" style="margin-top:2%;">
        <div>
            <div class="card-box table-responsive">
            
            <table id="tablasdatatables-informesMeses" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Total</th>
                    </tr>
                </thead>
              
                <tbody>
                    @foreach ($informesMeses as $informe)
                        <tr>
                            <td>{{ $informe->mes }} </td>
                            <td>{{ $informe->total_sum }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
</div>
@endsection