@extends('layouts.panel')

@section('content')
<div class="container" >
    <div class="card shadow p-3 mb-2 bg-info text-white">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">PERFIL DE USUARIO</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('home/')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-undo"></i>
                        regresar</a>
                </div>
                </div>s
            </div>
                        @if($errors->any())
                        <div class="text-center text-muted mb-2">
                            <h4>se encontro el siguent error.</h4>
                        </div>
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first()}}
                        </div>
                         @else 
                        <div class="text-center text-muted mb-4">
                            <small></small>
                        </div>
                         @endif
        <?php $fcha = date("Y-m-d");  
        if ($user->profesor)    {  $role='profesor';}
        else{ $role='secretaria';}
         ?>
        <form method="post"  action="{{ url('/editaruser/'.$user->id . '/' . $role)}}" enctype="multipart/form-data">
            {{-- action="{{ url('/materia/'.$materia->id)}}" --}}
          @csrf
         

          <div class="row p-3 mb-2 " >s
            <div class="col-12  " > 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                      <div class="form-group m-form__group row">

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text-black text-capitalize">email</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                <input class="form-control" placeholder="correo electronico" type="email" name="email"  required autocomplete="email" value="{{ $user->email }}">
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >role</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <input class="form-control" placeholder="contraseña" type="text" name="role" required autocomplete="new-password" value="{{ $user->role }}" disabled>
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">contraseña</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    <input class="form-control" placeholder="contraseña" type="text" name="password" required autocomplete="new-password" value="{{ $user->password }}" disabled>

                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >contraseña nueva</label>
                                </div>
                                <div class="col-8 col-md-9">
                                  <input class="form-control" placeholder="repetir contraseña" type="password" name="password_confirmation"  autocomplete="new-password">
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">nombre</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    @if ($user->profesor)
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="{{ $user->profesor->nombre ?? '' }}" disabled>
                                    <input class="form-control d-none" placeholder="nombre" type="text" name="tipouser" value="profesor" disabled>
                                @elseif ($user->secretaria)
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="{{ $user->secretaria->nombre ?? '' }}" disabled>
                                    <input class="form-control d-none" placeholder="nombre" type="text" name="tipouser" value="secretaria" disabled>
                                @else
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="" disabled>
                                @endif

                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >ci</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    @if ($user->profesor)
                                    <input class="form-control" placeholder="ci" type="text" name="ci" value="{{ $user->profesor->ci ?? '' }}" disabled>
                                @elseif ($user->secretaria)
                                    <input class="form-control" placeholder="ci" type="text" name="ci" value="{{ $user->secretaria->ci ?? '' }}" disabled>
                                @else
                                    <input class="form-control" placeholder="v" type="text" name="ci" value="" disabled>
                                @endif
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">apellidopaterno</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    @if ($user->profesor)
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="{{ $user->profesor->apellidopaterno ?? '' }}" disabled>
                                @elseif ($user->secretaria)
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="{{ $user->secretaria->apellidopaterno ?? '' }}" disabled>
                                @else
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="" disabled>
                                @endif
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >apellidomaterno</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    @if ($user->profesor)
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="{{ $user->profesor->apellidomaterno ?? '' }}" disabled>
                                @elseif ($user->secretaria)
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="{{ $user->secretaria->apellidomaterno ?? '' }}" disabled>
                                @else
                                    <input class="form-control" placeholder="nombre" type="text" name="nombre" value="" disabled>
                                @endif
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">celular</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    @if ($user->profesor)
                                  
                                    <input class="form-control" id="celular" placeholder="celular"  type="text"
                                    name="celular" value="{{ $user->profesor->celular ?? '' }}" required autocomplete="celular" autofocus oninput="validateInputcelular()">
                                    <span id="celular-error" style="color: red; font-size: 14px;"></span>
                                @elseif ($user->secretaria)
                                   
                                    <input class="form-control" id="celular" placeholder="celular"  type="text"
                                    name="celular" value="{{ $user->secretaria->celular ?? '' }}"  required autocomplete="celular" autofocus oninput="validateInputcelular()">
                                    <span id="celular-error" style="color: red; font-size: 14px;"></span>
                                @else
                                    <input class="form-control" placeholder="celular" type="text" name="celular" value="" disabled>
                                @endif
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >direccion</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    @if ($user->profesor)
                                    <input class="form-control" placeholder="direccion" type="text" name="direccion" value="{{ $user->profesor->direccion ?? '' }}" >
                                @elseif ($user->secretaria)
                                    <input class="form-control" placeholder="direccion" type="text" name="direccion" value="{{ $user->secretaria->direccion ?? '' }}" >
                                @else
                                    <input class="form-control" placeholder="direccion" type="text" name="direccion" value="" >
                                @endif
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">estado</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    @if ($user->profesor)
                                    <input class="form-control" placeholder="estado" type="text" name="estado" value="{{ $user->profesor->estado ?? '' }}" disabled>
                                @elseif ($user->secretaria)
                                    <input class="form-control" placeholder="estado" type="text" name="estado" value="{{ $user->secretaria->estado ?? '' }}" disabled>
                                @else
                                    <input class="form-control" placeholder="estado" type="text" name="estado" value="" disabled>
                                @endif
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >sueldo</label>
                                </div>
                                <div class="col-8 col-md-9">
                                  {{-- <select type="text" name="estado" id="estado" class="form-control"required >
                                    <option selected disabled value="">seleccione el estado</option>
                                    <option value="activo">activo</option>
                                    <option value="inactivo">inactivo</option>
                                </select> --}}
                                @if ($user->profesor)
                                <input class="form-control" placeholder="sueldo" type="text" name="sueldo" value="{{ $user->profesor->sueldo ?? '' }}" disabled>
                            @elseif ($user->secretaria)
                                <input class="form-control" placeholder="sueldo" type="text" name="sueldo" value="{{ $user->secretaria->sueldo ?? '' }}" disabled>
                            @else
                                <input class="form-control" placeholder="sueldo" type="text" name="sueldo" value="">
                            @endif
                            
                                </div>
                              </div>
                          </div>
                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">imagen</label>
                                    @if ($user->profesor)
                                    <img src="{{asset('storage').'/'.$user->profesor->imagen ?? '' }}" alt=""  width="50px" class="img-thumbnail img-fluid" >
                                @elseif ($user->secretaria)
                                <img src="{{asset('storage').'/'.$user->secretaria->imagen ?? '' }}" alt=""  width="50px" class="img-thumbnail img-fluid" >
                                @else
                                    <input class="form-control" placeholder="imagen" type="text" name="imagen" value="" disabled>
                                @endif
                                </div>
                                  <div class="col-8 col-md-9">
                                     <input type="file" name="imagen" id="imagen" class="form-control" value="{{  $user->profesor->imagen ?? '' }}" >
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                  <label class="text text-capitalize"></label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-book"></i>
                                        editar datos</a></button>
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                </div>
                                  <div class="col-8 col-md-9">
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                </div>
                                <div class="col-8 col-md-9">
                                
                                </div>
                              </div>
                          </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
<script>
    function validateInputcelular() {
        var inputElement = document.getElementById('celular');
        var errorElement = document.getElementById('celular-error');
        var regex = /[^0-9]/g;
        
        if (regex.test(inputElement.value)) {
            errorElement.textContent = "Solo se deben ingresar números en este campo.";
            inputElement.value = inputElement.value.replace(regex, '');
        } else if (inputElement.value.length > 8) {
            errorElement.textContent = "Máximo 8 dígitos permitidos.";
            inputElement.value = inputElement.value.slice(0, 8);
        } else {
            errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
        }
    }
</script>