@extends('layouts.panel')

@section('content')
<div class="container" >
    <div class="card shadow p-3 mb-2 bg-info text-white">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">REGISTRO DE EMPLEADO</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('home/')}}" class="btn btn-sm btn-success text text-capitalize">
                        <i class="fas fa-undo"></i>
                        regresar</a>
                </div>
                </div>
            </div>
                
        <?php $fcha = date("Y-m-d"); ?>
       
        <form role="form" method="POST" action="{{ route('registroEmpleado') }}" enctype="multipart/form-data">
          @csrf
          <div class="row p-3 mb-2 " >
            <div class="col-12  " > 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                      <div class="form-group m-form__group row">

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text-black text-capitalize">email</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                  <input class="form-control @if($errors->has('email')) is-invalid @endif" id="email-input" placeholder="Correo electrónico" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @if($errors->has('email'))
                                        <span class="text-danger" id="email-error">{{ $errors->first('email') }}</span>
                                    @endif

                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >rol</label>
                                </div>
                                <div class="col-8 col-md-9">
                                      <select type="text" name="role" id="role" class="form-control" required value="{{ old('role') }}">
                                        <option selected disabled value=""  class="text text-capitalize" >seleccione el rol</option>
                                        <option value="profesor"  class="text text-capitalize" >profesor</option>
                                        <option value="secretaria"  class="text text-capitalize" >secretaria</option>
                                    </select>
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">contraseña</label>
                                </div>
                                  <div class="col-8 col-md-9">
        <input class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="contraseña" type="password" name="password" id="password" 
        required autocomplete="new-password" oninput="validateInputpassword()" >
        <span id="password-error" style="color: red; font-size: 14px;"></span>
                                    @if($errors->has('password'))
                                        <span class="text-danger" >{{ $errors->first('password') }}</span>
                                    @endif
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >repetir contraseña</label>
                                </div>
                                <div class="col-8 col-md-9">
<input class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="repetir contraseña" type="password" name="password_confirmation" id="password_confirmation" 
required autocomplete="new-password" oninput="validateInputpassword_confirmation()">
<span id="password_confirmation-error" style="color: red; font-size: 14px;"></span>
                                    @if($errors->has('password_confirmation'))
                                        <span class="text-danger" >{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">fecha de ingreso</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    <input class="form-control" placeholder="fechadeingreso" type="date" name="fechadeingreso"  value="<?php echo $fcha; ?>" readonly>
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >C.I.</label>
                                </div>
                                <div class="col-8 col-md-9">
                                  <input class="form-control" id="ci" placeholder="Ingrese su C.I." type="text" 
                                  name="ci" value="{{ old('ci') }}" required autocomplete="ci" autofocus oninput="validateInputci()">
                                  <span id="ci-error" style="color: red; font-size: 14px;"></span>
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">nombre</label>
                                </div>
                                  <div class="col-8 col-md-9">
         <input class="form-control @if($errors->has('nombre')) is-invalid @endif" id="nombre" placeholder="ingrese sus nombres" type="text" 
                                    name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus oninput="validateInput()">
                                    <span id="nombre-error" style="color: red; font-size: 14px;"></span>
                                    @if($errors->has('nombre'))
                                        <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                    @endif
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >apellido paterno</label>
                                </div>
                                <div class="col-8 col-md-9">
      <input class="form-control  @if($errors->has('nombre')) is-invalid @endif" id="apellidopaterno" placeholder="ingrese su apellido paterno" type="text" 
      name="apellidopaterno"  value="{{ old('apellidopaterno') }}" required autocomplete="apellidopaterno" autofocus oninput="validateInputapellidopaterno()">
                                  <span id="apellidopaterno-error" style="color: red; font-size: 14px;"></span>
                                  @if($errors->has('apellidopaterno'))
                                        <span class="text-danger">{{ $errors->first('apellidopaterno') }}</span>
                                    @endif
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">apellido materno</label>
                                </div>
                                  <div class="col-8 col-md-9">
        <input class="form-control  @if($errors->has('nombre')) is-invalid @endif" id="apellidomaterno" placeholder="ingrese su apellido materno" type="text" 
        name="apellidomaterno" value="{{ old('apellidomaterno') }}" required autocomplete="apellidomaterno" autofocus oninput="validateInputapellidomaterno()">
                                    <span id="apellidomaterno-error" style="color: red; font-size: 14px;"></span>
                                    @if($errors->has('apellidomaterno'))
                                        <span class="text-danger">{{ $errors->first('apellidomaterno') }}</span>
                                    @endif
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >celular</label>
                                </div>
                                <div class="col-8 col-md-9">
                                  <input class="form-control" id="celular" placeholder="ingrese su celular"  type="text"
                                  name="celular" value="{{ old('celular') }}" required autocomplete="celular" autofocus oninput="validateInputcelular()">
                                  <span id="celular-error" style="color: red; font-size: 14px;"></span>
                                </div>
                              </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">dirección</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                   <input class="form-control" placeholder="ingrese su dirección" type="text" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" autofocus>
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize" >estado</label>
                                </div>
                                <div class="col-8 col-md-9">
                                  {{-- <select type="text" name="estado" id="estado" class="form-control"required >
                                    <option selected disabled value="">seleccione el estado</option>
                                    <option value="activo">activo</option>
                                    <option value="inactivo">inactivo</option>
                                </select> --}}
                                <input type="text" name="estado" id="estado" class="form-control" required value="activo" readonly> <br>
                                </div>
                              </div>
                          </div>
                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">imagen</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    <input class="form-control" placeholder="imagen" type="file" name="imagen"   autofocus required  value="{{ old('imagen') }}">
                                  </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                  <label class="text text-capitalize">sueldo</label>
                                </div>
                                <div class="col-8 col-md-9">
                                  <input class="form-control" placeholder="sueldo" id="sueldo" type="text" name="sueldo" 
                                  value="{{ old('sueldo') }}" required autocomplete="sueldo" autofocus oninput="validateInputsueldo()">
                                  <span id="sueldo-error" style="color: red; font-size: 14px;"></span>
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
                                  <button type="submit" class="btn btn-primary btn-sm text text-capitalize">
                                    <i class="fas fa-book"></i>
                                    guardar datos</a></button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
 document.addEventListener('DOMContentLoaded', function () {
        var emailInput = document.getElementById('email-input');
        var emailErrorSpan = document.getElementById('email-error');
        
        emailInput.addEventListener('input', function () {
            if (emailInput.value === '') {
                emailErrorSpan.textContent = '';
            }
        });

        // Para detectar cuando se borra el contenido del input en dispositivos móviles
        emailInput.addEventListener('change', function () {
            if (emailInput.value === '') {
                emailErrorSpan.textContent = '';
            }
        });
    });
  
function validateInputpassword_confirmation() {
    var inputElement = document.getElementById('password_confirmation');
    var errorElement = document.getElementById('password_confirmation-error');
    
    
    if (inputElement.value.length < 5) {
          errorElement.textContent = "Minimo 5 letras o numero o mesclado sino no podras guardar.";
          inputElement.value = inputElement.value.slice(0, 5);
        }else if (inputElement.value.length > 8) {
        errorElement.textContent = "Maximo son 8 letras o numeros o meslado.";
        inputElement.value = inputElement.value.slice(0, 8);
      }  else {
          errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
      }
    }
function validateInputpassword() {
    var inputElement = document.getElementById('password');
    var errorElement = document.getElementById('password-error');
    
    
    if (inputElement.value.length < 5) {
          errorElement.textContent = "Minimo 5 letras o numero o mesclado sino no podras guardar.";
          inputElement.value = inputElement.value.slice(0, 5);
        }else if (inputElement.value.length > 8) {
        errorElement.textContent = "Maximo son 8 letras o numeros o meslado.";
        inputElement.value = inputElement.value.slice(0, 8);
      }  else {
          errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
      }
}
function validateInput() {
    var inputElement = document.getElementById('nombre');
    var errorElement = document.getElementById('nombre-error');
    var regex = /[^a-zA-Z\s]/g;
    
    if (regex.test(inputElement.value)) {
        errorElement.textContent = "Solo se deben ingresar letras en este campo.";
        inputElement.value = inputElement.value.replace(regex, '');
    }else if (inputElement.value.length < 3) {
        errorElement.textContent = "Minimo 3 letras sino no podras guardar.";
        inputElement.value = inputElement.value.slice(0, 3);
    }  else {
        errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
    }
    
    
    
}
function validateInputci() {
    var inputElement = document.getElementById('ci');
    var errorElement = document.getElementById('ci-error');
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
function validateInputapellidopaterno() {
    var inputElement = document.getElementById('apellidopaterno');
    var errorElement = document.getElementById('apellidopaterno-error');
    var regex = /[^a-zA-Z\s]/g;
    
    if (regex.test(inputElement.value)) {
        errorElement.textContent = "Solo se deben ingresar letras en este campo.";
        inputElement.value = inputElement.value.replace(regex, '');
      }else if (inputElement.value.length < 5) {
        errorElement.textContent = "Minimo 5 letras sino no podras guardar.";
        inputElement.value = inputElement.value.slice(0, 5);
    } else {
        errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
    }
}
function validateInputapellidomaterno() {
    var inputElement = document.getElementById('apellidomaterno');
    var errorElement = document.getElementById('apellidomaterno-error');
    var regex = /[^a-zA-Z\s]/g;
    
    if (regex.test(inputElement.value)) {
        errorElement.textContent = "Solo se deben ingresar letras en este campo.";
        inputElement.value = inputElement.value.replace(regex, '');
      }else if (inputElement.value.length < 5) {
        errorElement.textContent = "Minimo 5 letras sino no podras guardar.";
        inputElement.value = inputElement.value.slice(0, 5);
    } else {
        errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
    }
}
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
function validateInputsueldo() {
    var inputElement = document.getElementById('sueldo');
    var errorElement = document.getElementById('sueldo-error');
    var regex = /[^0-9]/g;
    
    if (regex.test(inputElement.value)) {
        errorElement.textContent = "Solo se deben ingresar números en este campo.";
        inputElement.value = inputElement.value.replace(regex, '');
    }  else if (inputElement.value.length > 5) {
        errorElement.textContent = "Máximo 5 dígitos permitidos.";
        inputElement.value = inputElement.value.slice(0, 5);
    } else {
        errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
    }
}
</script>


