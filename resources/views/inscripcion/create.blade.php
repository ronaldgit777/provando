@extends('layouts.panel')

@section('content')

<div class="container" >
    <div class="card shadow p-3 mb-2 bg-info text-white">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">REGISTRAR NUEVA INSCRIPCION</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('inscripcion/')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-undo"></i>
                        regresar</a>
                </div>
                </div>
            </div>
        <?php $fcha = date("Y-m-d"); ?>
       
    <form method="post" action="{{ url('/inscripcion')}}" enctype="multipart/form-data">
     @csrf   
     <input type="text"  id="asignarproma_id"  name="asignarproma_id" class="d-none"  value=""  readonly> 
     
        <div class="row p-3 mb-2  text-white">
            <div class="col-12"> 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                    <div class="form-group m-form__group row">

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">fecha de inscripcion</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input class="form-control" placeholder="fechadeinscripcion" type="date" name="fechadeinscripcion"  value="<?php echo $fcha; ?>" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">alumno </label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                       
                                        <select type="text" name="alumno_id" id="alumno_id" class="form-control" required>
                                            <option selected disabled value="">seleccione el alumno</option>
                                            @foreach ($alumnos as $alumno)
                                            <option value="{{ $alumno->id }}">{{ $alumno->nombre."-".$alumno->apellidopaterno }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">profesores </label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                    <select type="text"  id="profesor_id"  class="form-control" required disabled>
                                        <option selected disabled value="">seleccione el profesor</option>
                                        @foreach ($asignarpromas as $asignarproma)
                                        <option value="{{ $asignarproma->profesor_id }}">{{$asignarproma->profesor->nombre}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">materia </label>
                                    </div>
                                    <div class="col-8 col-md-9">   
                                        <select type="text"  id="materia_id" class="form-control" required disabled>
                                            <option selected disabled value="">seleccione la materia</option>
                                            @foreach ($materias as $materia)
                                            <option value="{{ $materia->id }}">{{ $materia->materia}}</option>
                                            @endforeach
                                        </select>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">periodo </label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                      
                                        <select type="text"  id="periodo_id" class="form-control" required disabled>
                                            <option selected disabled value="">seleccione el periodo</option>
                                            @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">aula </label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        {{-- <select type="text" name="" id="" class="form-control" required>
                                            <option selected disabled value="">seleccione el aula</option>
                                            @foreach ($aulas as $aula)
                                            <option value="{{ $aula->id }}">{{ $aula->aula }}</option>
                                            @endforeach
                                        </select> --}}
                                        <input type="text"  id="aula_id"    class="form-control"  value=""  readonly> 
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">costo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text"  id="costomateria"  class="form-control"  value=""  readonly> 
                                    </div>
                                </div>
                            </div>
                                                     
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">estado </label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        {{-- <select type="text" name="estado" id="estado" class="form-control" required>
                                            <option value="activo">activo</option> 
                                            <option value="inactivo">inactivo</option> 
                                            </select><br> --}}
                                            <input type="text" name="estado" id="estado" class="form-control" required value="activo" readonly> <br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize"></label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <center><input type="submit" value="guardar datos" class="btn btn-primary" id="bo" disabled></center>
                                          
                                    </div>
                                </div>
                            </div>
                                                              
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    {{-- <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">mensajse </label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        @if(session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="mensaje">
                                            El registro ya existe.
                                        </div>
                                        @endif
                                        
                                    </div> --}}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
@if(session('profesor_id'))
    <script>
         $(document).ready(function() {
	var selectElement = document.getElementById('profesor_id');
    var selectElement2 = document.getElementById('alumno_id');

	var valueToSelect = '{{ session('profesor_id') }}';// Valor a buscar y seleccionar

	for (var i = 0; i < selectElement.options.length; i++) {
    	var option = selectElement.options[i];
    
    		if (option.value === valueToSelect) {
        	option.selected = true; 
        	break; // Terminar el bucle una vez que se encuentra la opción
    		}
	}

    var valueToSelect2 = '{{ session('alumno_id') }}';// Valor a buscar y seleccionar

	for (var i = 0; i < selectElement2.options.length; i++) {
    	var option = selectElement2.options[i];
    
    		if (option.value === valueToSelect2) {
        	option.selected = true; 
        	break; // Terminar el bucle una vez que se encuentra la opción
    		}
	}
});
    </script>
@endif

<script>


    $(document).ready(function() {
                $('#alumno_id').on('change', function() {

                var alumnoid = $(this).val(); // Obtener el valor del aula seleccionada
                // Realizar la solicitud Ajax
                $('#mensaje').addClass('d-none');
                $.ajax({
                    url: '{{ url("obtener-profesoresid") }}', // Ruta a tu controlador Laravel
                    type: 'POST',
                    data: {
                        alumnoid: alumnoid,
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                    },
                    success: function(response) {
                        // Limpiar el campo de selección de periodos
                        
                        if(response!=''){
                            //alert(response)
                        
                        $("#profesor_id").prop("disabled", false); 
                        $('#profesor_id').empty();
                        $("#bo").prop("disabled", false); 
                       
                        // Agregar las opciones de periodos según la respuesta del servidor
                        $.each(response, function(key, value) {
                          
                            $('#profesor_id').append(
                                '<option value="' + value.id + '">' + value.nombre +'-'+ value.apellidopaterno+'-'+ value.apellidomaterno+'</option>'
                            );
                        });

                        $('#profesor_id').trigger('change');
                        }
                        else{
                            $("#profesor_id").prop("disabled", true);  $('#profesor_id').empty();$('#profesor_id').append($('<option>', { value: '', text: 'seleccione el profesor'}));
                                $("#materia_id").prop("disabled", true);  $('#materia_id').empty();$('#materia_id').append($('<option>', { value: '', text: 'seleccione la materia'}));
                                    $("#periodo_id").prop("disabled", true);  $('#periodo_id').empty();$('#periodo_id').append($('<option>', { value: '', text: 'seleccione el periodo'}));  
                                        $("#aula_id").prop("disabled", true);  $('#aula_id').val(''); 
                                        $("#costomateria").prop("disabled", true);  $('#costomateria').val('');  $("#bo").prop("disabled", true); 
                        }
                    },
                    error: function (xhr, status, error) {
                    console.error('Error en la solicitud:', error);
                    }

                });
                });
        $('#profesor_id').on('change', function() {

            var profesorid = $(this).val(); // Obtener el valor del aula seleccionada
            var alumnoid = $('#alumno_id').val(); 
            // Realizar la solicitud Ajax
            $('#mensaje').addClass('d-none');
            $.ajax({
                url: '{{ url("obtener-materiasdelprofesorid") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                    profesorid: profesorid,
                    alumnoid: alumnoid,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                    // Limpiar el campo de selección de periodos
                    $("#materia_id").prop("disabled", false); 
                    $('#materia_id').empty();

                    // Agregar las opciones de periodos según la respuesta del servidor
                    $.each(response, function(key, value) {
                        $('#materia_id').append(
                            '<option value="' + value.id + '">' + value.materia + '</option>'
                        );
                    });
                    $('#materia_id').trigger('change');
                },
                error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                }

            });
        });
             $('#materia_id').on('change', function() {

            var materiaid = $(this).val(); // Obtener el valor del aula seleccionada
            var profesorid = $('#profesor_id').val(); 
            var alumnoid = $('#alumno_id').val(); 
            // Realizar la solicitud Ajax
           // alert(materiaid+profesorid);
            $.ajax({
                url: '{{ url("obtener-periodosmateriaprofesor") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                    materiaid: materiaid,
                    profesorid: profesorid,
                    alumnoid:alumnoid,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                    // Limpiar el campo de selección de periodos
                    $("#periodo_id").prop("disabled", false); 
                    $('#periodo_id').empty();

                    // Agregar las opciones de periodos según la respuesta del servidor
                    $.each(response, function(key, value) {
                        $('#periodo_id').append(
                            '<option value="' + value.periodo_id + '">' + value.periodo_nombre + '</option>'
                        );
                    });
                    $('#periodo_id').trigger('change');
                },
                error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                }

            });
            });
            $('#periodo_id').on('change', function() {
                   
            var periodoid = $(this).val(); // Obtener el valor del aula seleccionada
            var profesorid = $('#profesor_id').val(); 
            var materiaid = $('#materia_id').val(); 
            // Realizar la solicitud Ajax
           // alert(materiaid+profesorid+periodoid);
            $.ajax({
                url: '{{ url("obtener-aulaperiodosmateriaprofesor") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                    materiaid: materiaid,
                    profesorid: profesorid,
                    periodoid: periodoid,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                    var costoma = response[0].costo_ma;
                    var aulanom = response[0].aula_nombre;
                    var asigpromasid =response[0].asig_id;
                    // Agregar las opciones de periodos según la respuesta del servidor
                    $('#costomateria').val(costoma);  
                    $('#aula_id').val(aulanom);    
                    $('#asignarproma_id').val(asigpromasid);                  
                },
                error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                }

            });
            });
        // Simular el evento change al cargar la página
        $('#aula_id').trigger('change');
    });
</script>
@endsection
