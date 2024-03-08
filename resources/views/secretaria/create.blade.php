@extends('layouts.panel')

@section('content')
<div class="container" >
    <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">REGISTRO DE SECRETARIA</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('secretaria/')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-undo"></i>
                        Regresar</a>
                </div>
                </div>
            </div>
        <?php $fcha = date("Y-m-d"); ?>
        <form method="post" action="{{ url('/secretaria')}}" enctype="multipart/form-data">
         @csrf   
        <div class="row p-3 mb-2 " >
            <div class="col-12  " > 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                    <div class="form-group m-form__group row">
                        
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                         <label class="text-primary text-capitalize">fecha de Ingreso</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="date" name="fechadeingreso" id="fechadeingreso" class="form-control" value="<?php echo $fcha; ?>" readonly> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize" >ci</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="ci" id="ci" class="form-control"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">nombre</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="nombre" id="nombre" class="form-control"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">apellido paterno</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="apellidopaterno" id="apellidopaterno" class="form-control"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">apellido materno</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="apellidomaterno" id="apellidomaterno" class="form-control"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">celular</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="celular" id="celular" class="form-control"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">direccion</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="direccion" id="direccion" class="form-control"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">correo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="correo" id="correo" class="form-control"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">estado</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <select type="text" name="estado" id="estado" class="form-control">
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
                                    </div>
                                    <div class="col-8 col-md-9">
                                     <input type="file" name="imagen" id="imagen" class="form-control"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text-primary text-capitalize">rol</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <select type="text" name="user_id" id="user_id" class="form-control">
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->role }}</option>
                                            @endforeach
                                        </select><br>
                                    </div>
                                </div>
                            </div>

                           

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-12 col-md-12 " >
                                    <center><input type="submit" value="crear profesor" class="btn btn-primary btn-sm"></center>
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

