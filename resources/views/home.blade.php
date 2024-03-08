@extends('layouts.panel')

@section('content')

<div class="container">
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">{{ __('BIENVENIDO') }}</div>

            <div class="card-body text-center">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                  <img src="{{asset ('img/brand/telc.jpg')}}" class="navbar-brand-img mx-auto" alt="..." width="50%" >
                  <br>
                  {{ __('') }}
                 
              </div>
           </div>
        </div>
     </div>
</div>
</div>
@endsection
