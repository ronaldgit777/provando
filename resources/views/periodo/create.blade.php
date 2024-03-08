@extends('layouts.panel')

@section('content')
<div class="container" >
    <div class="card shadow shadow p-3 mb-2 bg-info text-white">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">REGISTRO DE PERIODO</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('periodo/')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-undo"></i>
                        regresar</a>
                </div>
                </div>
            </div>
        <form method="post" action="{{ url('/periodo')}}" enctype="multipart/form-data">
        @csrf   
            <div class="row p-3 mb-2  text-white"   >
                <div class="col-12"> 
                    <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                        <div class="form-group m-form__group row">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <div class="form-group m-form__group row" style="display: flex; margin-left: 2px"> 
                                            <div class="col-4 col-md-3">
                                                        <label class=" text-capitalize">periodo</label>
                                            </div>
                                            <div class="col-8 col-md-9">
                                                            {{-- <select type="text" name="periodo" id="periodo" class="form-control" required>
                                                                <option selected disabled value="">seleccione el periodo</option>
                                                            <option value="manana">mañana</option> 
                                                            <option value="tarde">tarde</option> 
                                                            <option value="noche">noche</option> 
                                                            </select><br> --}}
                                                            <input type="text" name="periodo" id="periodo" class="form-control" required> <br>
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
                                                <input type="submit" value="guardar datos" class="btn btn-primary">
                                    </div>                                       
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>  
</div>
@endsection
