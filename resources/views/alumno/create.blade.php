@extends('layouts.panel')

@section('content')
<div class="container" >
    <div class="card shadow shadow p-3 mb-2 bg-info text-white">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">REGISTRO DE ALUMNO</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('alumno/')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-undo"></i>
                        Regresar</a>
                </div>
                </div>
            </div>
        <?php $fcha = date("Y-m-d"); ?>
        <form method="post" action="{{ url('/alumno')}}" enctype="multipart/form-data">
         @csrf   
        <div class="row p-3 mb-2 " >
            <div class="col-12  " > 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                    <div class="form-group m-form__group row">
                        
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                         <label class="text text-capitalize">fecha de ingreso</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="date" name="fechadeingreso" id="fechadeingreso" class="form-control" value="<?php echo $fcha; ?>" READONLY> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize" >C.I.</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" id="ci" placeholder="ingrese su C.I." type="text" 
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
                                        <input class="form-control" id="nombre" placeholder="ingrese los nombres" type="text" 
                                        name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus oninput="validateInput()">
                                        <span id="nombre-error" style="color: red; font-size: 14px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">apellido paterno</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" id="apellidopaterno" placeholder="ingrese el apellido paterno" type="text" name="apellidopaterno" 
                                        value="{{ old('apellidopaterno') }}" required autocomplete="apellidopaterno" autofocus oninput="validateInputapellidopaterno()">
                                        <span id="apellidopaterno-error" style="color: red; font-size: 14px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">apellido materno</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" id="apellidomaterno" placeholder="ingrese el apellido materno" type="text" name="apellidomaterno" 
                                    value="{{ old('apellidomaterno') }}" required autocomplete="apellidomaterno" autofocus oninput="validateInputapellidomaterno()">
                                    <span id="apellidomaterno-error" style="color: red; font-size: 14px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">celular</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" id="celular" placeholder="ingrese el celular"  type="text"
                                        name="celular" value="{{ old('celular') }}" required autocomplete="celular" autofocus oninput="validateInputcelular()">
                                        <span id="celular-error" style="color: red; font-size: 14px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">direccion</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="direccion" id="direccion" class="form-control" required placeholder="ingrese la dirección"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">correo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="email" name="correo" id="correo" class="form-control" required placeholder="ingrese el correo"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">estado</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="estado" id="estado" class="form-control" value="activo" readonly> <br>
                                       <!-- <select type="text" name="estado" id="estado" class="form-control" required>
                                            <option selected disabled value="">seleccione un estado</option>
                                            <option value="activo">activo</option>
                                            <option value= "inactivo">inactivo</option>
                                        </select><br> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">imagen</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                     <input type="file" name="imagen" id="imagen" class="form-control" required><br>
                                    </div>
                                </div>
                            </div>

                           

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-12 col-md-12 " >
                                    <center><input type="submit" value="Crear Alumno" class="btn btn-primary btn-sm"></center>
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
    function validateInput() {
        var inputElement = document.getElementById('nombre');
        var errorElement = document.getElementById('nombre-error');
        var regex = /[^a-zA-Z\s]/g;
        
        if (regex.test(inputElement.value)) {
            errorElement.textContent = "Solo se deben ingresar letras en este campo.";
            inputElement.value = inputElement.value.replace(regex, '');
        } else {
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
    </script>