@extends('layouts.panel')
@section('content')
<div class="container" >
    <div class="card shadow  p-3 mb-2 bg-info text-white">
        <div class="card-header border-0">
            <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">ASIGNAR MATERIA A PROFESOR</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('asignarproma/')}}" class="btn btn-sm btn-success">
                    <i class="fas fa-undo"></i>
                    Regresar</a>
            </div>
            </div>
        </div>
        <?php $fcha = date("Y-m-d"); ?>
<form method="post" action="{{ url('/asignarproma')}}" enctype="multipart/form-data">
 @csrf   
    <div class="row p-3 mb-2  text-white">
        <div class="col-12"> 
            <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                <div class="form-group m-form__group row">
                         <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class=" text-capitalize">profesor </label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <select type="text" name="profesor_id" id="profesor_id" class="form-control text text-capitalize"" required>
                                        @php
                                        $maximoPeriodos = $periodos->count();
                                        @endphp

                                        @foreach ($profesors as $profesor)
                                            @php
                                                $contpro = $asignarpromas->where('profesor_id', $profesor->id)->where('estado','activo')
                                                ->count();
                                            @endphp

                                            @if ($contpro < $maximoPeriodos)
                                      
                                            <option value="{{ $profesor->id }}" class="text text-capitalize">{{ $profesor->nombre." ".$profesor->apellidopaterno." ".$profesor->apellidomaterno}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class=" text-capitalize">materias </label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <select type="text" name="materia_id" id="materia_id" class="form-control text text-capitalize"">
                                        @foreach ($materias as $materia)
                                        <option value="{{ $materia->id }}" class="text text-capitalize">{{ $materia->materia }}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">aula</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <select type="text" name="aula_id" id="aula_id" class="form-control text text-capitalize" ">
                                    @php
                                        $maximoPeriodos = $periodos->count();
                                    @endphp

                                    @foreach ($aulas as $aula)
                                        @php
                                            $contAula = $asignarpromas->where('aula_id', $aula->id)->where('estado','activo')
                                            ->count();
                                        @endphp

                                        @if ($contAula < $maximoPeriodos)
                                            <option value="{{ $aula->id }}" class="text text-capitalize">{{ $aula->aula }}</option>
                                        @endif
                                    @endforeach
                                    </select><br>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">periodo </label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <select type="text" name="periodo_id" id="periodo_id" class="form-control text text-capitalize"">
                                    @foreach ($periodos as $periodo)
                                        @php
                                            $bandPeriodo = $asignarpromas->where('aula_id', 1)->where('periodo_id', $periodo->id)->isEmpty();
                                        @endphp

                                        @if ($bandPeriodo)
                                            <option value="{{ $periodo->id }}" class="text text-capitalize">{{ $periodo->periodo }}</option>
                                        @endif
                                    @endforeach
                                    </select><br>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text-black text-capitalize">fecha de asignación</label>
                                </div>
                                  <div class="col-8 col-md-9">
                                    <input class="form-control" placeholder="fechadeasignacion" type="date" name="fechadeasignacion"  value="<?php echo $fcha; ?>" readonly >
                                  </div>
                            </div>
                          </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                <div class="col-4 col-md-3">
                                    <label class="text text-capitalize">estado </label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <input type="text" name="estado" id="estado" class="form-control" value="activo" readonly><br>
                                </div>
                            </div>
                        </div>
                        
                </div>
                <center><input type="submit" value="Guardar Datos" class="btn btn-primary"></center>
                @if(Session::has('registro_duplicado'))
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                    {{ Session::get('registro_duplicado') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
    $(document).ready(function() {

        $('#aula_id').on('change', function() {

            var aulaId = $(this).val(); // Obtener el valor del aula seleccionada
            var profesorId = $('#profesor_id').val(); //obtener id del profesor

            // Realizar la solicitud Ajax
            $.ajax({
                url: '{{ url("obtener-periodos") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                    aula_id: aulaId, // Enviar el ID del aula seleccionada
                    profesor_id: profesorId,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                    // Limpiar el campo de selección de periodos
                    $('#periodo_id').empty();

                    // Agregar las opciones de periodos según la respuesta del servidor
                    $.each(response, function(key, value) {
                        $('#periodo_id').append(
                            '<option value="' + value.id + '">' + value.periodo + '</option>'
                        );
                    });
                }
            });
        });

        $('#profesor_id').on('change', function() {
         
            var profesorId = $(this).val(); // Obtener el valor del profesor seleccionado
           // var aulaId = $('#aula_id').val();
            // Realizar la solicitud Ajax
            $.ajax({
                url: '{{ url("obtener-aulas") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                   // aula_id: aulaId, // Enviar el ID del aula seleccionada
                    profesor_id: profesorId,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                    // Limpiar el campo de selección de periodos
                    $('#aula_id').empty();

                    // Agregar las opciones de periodos según la respuesta del servidor
                    $.each(response, function(key, value) {
                        $('#aula_id').append(
                            '<option value="' + value.id + '">' + value.aula + '</option>'
                        );
                    });
                    $('#aula_id').trigger('change');
                }
            });
        });
        // Simular el evento change al cargar la página
        $('#profesor_id').trigger('change');
    });
</script>
@endsection
