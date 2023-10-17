<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tienda</title>
    @include('plantillas.head')
</head>


<body style="height: 100vh; margin: 0;">

    <div class="container-fluid" style="height: 100%; display: flex; flex-direction: column;">
        <div class="row bg-dark" style="min-height: 7% !important;">
            <div class="col-2 rowunocoluno">
                <b>Área de gestión</b>
            </div>
            <div class="col bg-dark">
            
                <h1 style="text-align: center; color: white;">@yield('page_title')</h1> <!-- Agregar esta línea -->
            
            </div>
        </div>

        <div class="row" style="flex: 1;">
            <div class="col-2 bg-dark">
                @yield('menu')
            </div>

            <div class="col contenidoprincipal" style="overflow-y: auto;">
                @yield('page_content')
            </div>
        </div>
        
        <div class="row bg-dark" style="flex: 0 0 auto;">
            @yield('footer')
        </div>
    </div>

    
    
</body>

</html>
