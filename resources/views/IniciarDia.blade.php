<!DOCTYPE html>
<html>

@include('plantillas.head')

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" alt="Sample image" width="80%">
                </div>

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Inicio del Dia</h2>
                <p>Hoy es: {{ $fechaCompleta }}</p>
                <form action="/iniciodia" method="POST" id="iniciodia">
                    @csrf

                    <button type="submit" name="action" value="iniciardia" class="btn btn-outline-light btn-lg px-5">Iniciar día</button>
                    
                </form>
            </div>

          </div>
        </div>    
                </div>
            </div>
        </div>
    </section>
</body>

</html>
