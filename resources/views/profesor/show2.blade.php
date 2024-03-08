@extends('layouts.panel')

@section('content')
<style>
  .card2 {
    width: 400px; /* Ajusta el ancho de la tarjeta */
    margin-bottom: 20px;
  }

  .card img {
    width: 100%;
    height: 100%; /* Ajusta la altura de la imagen */
    object-fit: cover;
  }

  .card-body {
    padding: 15px;
  }

  .card-title {
    font-size: 24px; /* Ajusta el tamaño de fuente del título */
    margin-bottom: 10px;
  }

  .card-text {
    font-size: 18px; /* Ajusta el tamaño de fuente del texto */
    margin-bottom: 5px;
  }
  .card-footer {
    display: flex;
    justify-content: space-around; /* Espacio entre los enlaces */
  }

  .card-footer a {
    flex: 1; /* Hace que los enlaces ocupen el mismo ancho */
    text-align: center; /* Alinea el texto en el centro */
  }
  .bold-text {
    font-weight: bold;
    color: #333; /* Cambia el color aquí según tu preferencia */
  }
</style>
  <div class="card shadow">

        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">DATOS DEL PROFESOR-rol secretaria</h3>
            </div>
            <div class="col text-right">
              <a href="{{url('indexsecre/')}}" class="btn btn-sm btn-success">
                <i class="fas fa-undo"></i>
                regresar</a>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="card-deck">
              <div class="card2">
                <div class="card-body">
                  <img src="{{ asset('storage').'/'.$profesor->imagen }}" alt="" class="img-thumbnail img-fluid" >
                  <h5 class="card-title">{{ $profesor->nombre }} {{ $profesor->apellidopaterno }} {{ $profesor->apellidomaterno }}</h5>
                  <p class="card-text"><span class="bold-text">CI:</span> {{ $profesor->ci }}</p>
                  <p class="card-text"><span class="bold-text">Celular:</span> {{ $profesor->celular }}</p>
                  <p class="card-text"><span class="bold-text">Correo:</span> {{ $profesor->user->email }}</p>
                  <p class="card-text"><span class="bold-text">Dirección:</span> {{ $profesor->direccion }}</p>
                  <p class="card-text"><span class="bold-text">Sueldo:</span> {{ $profesor->sueldo }}</p>
                  <p class="card-text"><span class="bold-text">Estado:</span> {{ $profesor->estado }}</p>
                  <!-- Agrega aquí cualquier otra información que desees mostrar en la postal -->
                </div>
                <div class="card-footer">
                  {{-- <a href="{{ url('/profesor/') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-external-link-alt"></i> IMPRIMIR
                  </a>
                  <a href="{{ url('/profesor/') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-external-link-alt"></i> IMPRIMIR
                  </a>
                  <a href="{{ url('/profesor/') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-external-link-alt"></i> IMPRIMIR
                  </a>
                  <a href="{{ url('/profesor/') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-external-link-alt"></i> IMPRIMIR
                  </a> --}}
                </div>
              </div>
          </div>
        </div>


       
  </div>
      
@endsection

