@extends('layouts.form')

@section('title','Formulario de Iniciar de Sesión')
@section('head')
    <title>Mi Página de Formulario</title>
    <meta name="description" content="Descripción de la página de formulario">
    <!-- Otros elementos del encabezado que desees agregar específicamente a esta página -->
@endsection
@section('content')

<!-- Page content -->
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">

          <div class="card-body px-lg-5 py-lg-5">

            @if($errors->any())
                <div class="text-center text-muted mb-2">
                    <h4>Mensaje de Error</h4>
                </div>
                <div class="alert alert-danger" role="alert">
                <center><h4>ingresaste mal los datos</h4></center>
                </div>
            @else 
                <div class="text-center text-muted mb-4">
                    <small>Ingrese los Siguientes Datos para Iniciar Sesión</small>
                </div>
            @endif

           
            <form role="form" method="POST" action="{{ route('login') }}">
                @csrf
              <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" placeholder="Email" type="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="contraseña" type="password" name="password" required autocomplete="current-password">
                </div>
              </div>
              <div class="custom-control custom-control-alternative custom-checkbox">
                {{-- <input class="custom-control-input" id=" remember" name="remember" type="checkbox"  {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for=" remember">
                  <span class="text-muted">recordar secion</span>
                </label> --}}
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Iniciar Sesión</button>
              </div>
            </form>
          </div>
        </div>
                <div class="row mt-3">
                  <div class="col-6">
                    {{--ççç <a href="{{ route('password.request') }}" class="text-light" ><small>olvidadste tu contraseña?</small></a>
                    <button  data-toggle="modal" data-target="#myModal3"  id="bonota" class="btn btn-sm btn-info"> olvidadste tu contraseña? 
                    <i class="fas fa-cogs"></i></button> --}}
                  </div>
          <div class="col-6 text-right">
            {{-- <a href="{{ route('register') }}" class="text-light"><small>crear cuenta neuva</small></a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $(document).ready(function() {

      $('#modal-button').on('click',function(){
        var emailInput = $('#modal-email');
        var modalBody = $('.fondo-mensage');
        var email = emailInput.val();
                
        
        $.ajax({
                    url: '{{ url("custom/password/email") }}', // Ruta a tu controlador Laravel
                    method: 'POST',                    
                    data: {
                        email: email, 
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                      
                    },
                    success: function(response) {    
                      var mensaje = $('<div role="alert" class="alert alert-'+response.alert+'"> '+
                      response.message +
                        '</div>');
                        modalBody.children('.alert').remove();                                        
                      modalBody.append(mensaje);
                    }  
                });
        
      });
      $('#myModal3').on('hidden.bs.modal', function () {
        var modalBody = $('.fondo-mensage');
        modalBody.children('.alert').remove(); 
});
        
        });
 </script> --}}
@endsection
<!--empeiza el modal-->
<div class="modal fade " id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content p-3 mb-2 bg-info">
           <div class="modal-body ">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                      <span aria-hidden="true">&times;</span>
                  </button>
                <div class="card shadow p-3 mb-2 ">
                {{-- <div class="card shadow p-3 mb-2 bg-info"> ESE BG-INFO PONE COLOR TRANS--}}
                           <div class="card-header border-0">
                                  <div class="row align-items-center">
                                      <div class="col fondo-mensage">
                                        <h3 class="mb-0">Formulario de recuperar contraseña</h3>
                                        <br>
                                          <div class="row">
                                              <div class="col">
                                                  <input type="text" name="email" id="modal-email" class="form-control" placeholder="ingrese su email"  autocomplete="off">
                                                  <snap class="text-sm">Email</snap>
                                                  </div>
                                                  <div class="col">
                                                    <button id="modal-button" class="btn btn-danger" type="button"><i class="far fa-paper-plane" ></i> enviar</button>
                                                </div>
                                          </div>
                                      </div>
                                </div>
                            </div>                              
               </div>
          </div>
      </div>
  </div>
</div>
    <!--filaliza el modal-->