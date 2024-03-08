@extends('layouts.panel')
@section('title','registrate')
@section('content')
<div class="container mt--8 pb-5 ">
    <!-- Table -->
    <div class="row justify-content-center ">
      <div class="col-lg-6 col-md-8">
        <div class="card bg-secondary shadow border-0 ">
          <div class="card-body px-lg-5 py-lg-5 ">
                    @if($errors->any())
                    <div class="text-center text-muted mb-2">
                        <h4>se encontro el siguent error.</h4>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first()}}
                    </div>
                @else 
                    <div class="text-center text-muted mb-4">
                        <small>ingresa tus datos</small>
                    </div>
                @endif

            <form role="form" method="POST" action="{{ route('register') }}">
                @csrf
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                  </div>
                  <input class="form-control" placeholder="nombre" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
              </div> -->
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" placeholder="correo electronico" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="contraseña" type="password" name="password" required autocomplete="new-password">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="repetir contraseña" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                    <select type="text" name="role" id="role" class="form-control">
                   
                    <option value="admin">admin</option>
                    <option value="profesor">profesor</option>
                    <option value="secreataria">secreataria</option>
                </select><br>  
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">registrarse</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
