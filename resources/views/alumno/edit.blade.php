@extends('layouts.panel')

@section('content')
<br><br>
<div class="card shadow">
<div class="container " >
    <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">EDITAR ALUMNO</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('alumno/')}}" class="btn btn-sm btn-success">
                <i class="fas fa-undo"></i>
                regresar</a>
          </div>
        </div>
      </div>
<form method="post" action="{{ url('/alumno/'.$alumno->id)}}" enctype="multipart/form-data">
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
                            {{-- <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">nombre</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="nombre" id="nombre" class="form-control" " value="{{ $profesor->nombre }}"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">apellido paterno</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="apellidopaterno" id="apellidopaterno" class="form-control" value="{{ $profesor->apellidopaterno }}"> <br>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">correo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="" id="" class="form-control" value="{{ $alumno->correo }}"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">celular</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="celular" id="celular" class="form-control"  value="{{ $alumno->celular }}"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">direccion</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $alumno->direccion }}"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">estado</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <select type="text" name="estado" id="estado" class="form-control"  value="{{ $alumno->estado }}">
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
                                        <img src="{{asset('storage').'/'.$alumno->imagen }}" alt=""  width="50px" class="img-thumbnail img-fluid" >
                                    </div>
                                    <div class="col-8 col-md-9">
                                     <input type="file" name="imagen" id="imagen" class="form-control" value="{{ $alumno->imagen }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                      
                                      
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <center><input type="submit" value="editar alumno" class="btn btn-primary btn-sm"></center>
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

