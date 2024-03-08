@extends('layouts.panel')

@section('content')
<br><br>
<div class="card shadow">
<div class="container " >
    <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">EDITAR SECRETARIA</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('secretaria/')}}" class="btn btn-sm btn-success">
                <i class="fas fa-undo"></i>
                Regresar</a>
          </div>
        </div>
      </div>
<form method="post" action="{{ url('/secretaria/'.$secretaria->id)}}" enctype="multipart/form-data">
    @csrf    
    {{ method_field('PATCH')}} 
        <div class="row p-3 mb-2 " >
            <div class="col-12  " > 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                    <div class="form-group m-form__group row">
                        
                            {{-- <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                         <label class="text-primary text-capitalize">fecha de ingreso</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="date" name="fechadeingreso" id="fechadeingreso" class="form-control" value="{{ $profesor->fechadeingreso }}"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize" >ci</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="ci" id="ci" class="form-control" value="{{ $profesor->ci }}"> <br>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">contraseña</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="" id="" class="form-control" " value="{{ $secretaria->user->password }}" disabled> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">constraseña nueva</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" value="" > <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">sueldo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" placeholder="sueldo" id="sueldo" type="text" name="sueldo" 
                                        value="{{ $secretaria->sueldo }}" required autocomplete="sueldo" autofocus oninput="validateInputsueldo()">
                                        <span id="sueldo-error" style="color: red; font-size: 14px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">celular</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" id="celular" placeholder="celular"  type="text"
                                        name="celular"  value="{{ $secretaria->celular }}"  required autocomplete="celular" autofocus oninput="validateInputcelular()">
                                        <span id="celular-error" style="color: red; font-size: 14px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">direccion</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $secretaria->direccion }}" required> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">correo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $secretaria->user->email }}" required><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">estado</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <select type="text" name="estado" id="estado" class="form-control"  value="{{ $secretaria->estado }}">
                                            <option value="activo">activo</option>
                                            <option value="inactivo">inactivo</option>
                                        </select><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">imagen</label>
                                        <img src="{{asset('storage').'/'.$secretaria->imagen }}" alt=""  width="50px" class="img-thumbnail img-fluid" >
                                    </div>
                                    <div class="col-8 col-md-9">
                                     <input type="file" name="imagen" id="imagen" class="form-control" value="{{ $secretaria->imagen }}" >
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
                                    <div class="col-12 col-md-12 " >
                                    <center><input type="submit" value="editar secretaria" class="btn btn-primary btn-sm"></center>
                                    </div>
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