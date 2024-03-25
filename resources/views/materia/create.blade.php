@extends('layouts.panel')

@section('content')
<div class="container" >
    <div class="card shadow shadow p-3 mb-2 bg-info text-white">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">REGISTRO DE NUEVA MATERIA</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('materia/')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-undo"></i>
                        Regresar</a>
                </div>
                </div>
            </div>
    <form method="post" action="{{ url('/materia')}}" enctype="multipart/form-data">
     @csrf   
        <div class="row p-3 mb-2  text-white"   >
            <div class="col-12"> 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                    <div class="form-group m-form__group row">
                        
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">

                                    <div class="col-4 col-md-3">
                                         <label class="text text-capitalize">materia</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="materia" id="materia" class="form-control" placeholder="ingrese una materia" required> <br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px"> 
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">costo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" placeholder="costo" id="costo" type="text" name="costo" 
                                        value="{{ old('costo') }}" required autocomplete="costo" autofocus oninput="validateInputcosto()"><br>
                                        <span id="costo-error" style="color: red; font-size: 14px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px"> 
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">estado</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                            {{-- <select type="text" name="estado" id="estado" class="form-control" required>
                                                <option selected disabled value="">seleccione el estado</option>
                                            <option value="activo">activo</option> 
                                            <option value="inactivo">inactivo</option> 
                                            </select><br> --}}
                                            <input type="text" name="estado" id="estado" class="form-control" required value="activo" readonly> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="form-group m-form__group row " style="display: flex; margin-left: 2px"> 
                                  

                                    <div class="col-6 col-md-6 ">
                                            <input type="submit" value="Guardar Datos" class="btn btn-primary">
                                     </div>
                                        
                                </div>
                            </div>
                                    
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
<script>
    function validateInputcosto() {
        var inputElement = document.getElementById('costo');
        var errorElement = document.getElementById('costo-error');
        var regex = /[^0-9]/g;
        
        if (regex.test(inputElement.value)) {
            errorElement.textContent = "Solo se deben ingresar números en este campo.";
            inputElement.value = inputElement.value.replace(regex, '');
        }else {
            errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
        }
    }
</script>