@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">LISTA DE ALUMNOS REPORTE  <label> <?php echo auth()->user()->email; ?></label></h3>
              <div class="row">
                      <div class="col">
                          <label class="text-primary text-capitalize">fecha de inicioA</label>
                          <input type="date" name="fechainicio" id="fechainicio" class="form-control" >
                          <span class="text-muted">desde</span>
                      </div>
                      <div class="col">
                          <label class="text-primary text-capitalize">fecha de final</label>
                          <input type="date" name="fechafinal" id="fechafinal" class="form-control">
                          <span class="text-muted">hasta</span>
                      </div>
                      <div class="col">
                          <label class="text-primary text-capitalize">materia</label>
                          <select type="text" name="materia_id" id="materia_id" class="form-control" >
                            <option selected value="">seleccione la materia</option>
                            @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->materia}}</option>
                            @endforeach
                          </select>
                        {{-- <input type="text" name="materia_id" id="materia_id" class="form-control" > --}}
                        </div>
                        <div class="col">
                          <label class="text-primary text-capitalize">aula</label>
                          <select type="text" name="aula_id" id="aula_id" class="form-control" >
                            <option selected  value="">seleccione el aula</option>
                            @foreach ($aulas as $aula)
                            <option value="{{ $aula->id }}">{{ $aula->aula }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="aula_id" id="aula_id" class="form-control" > --}}
                        </div>
                        <div class="col">
                          <label class="text-primary text-capitalize">periodo</label>
                          <select type="text" name="periodo_id" id="periodo_id" class="form-control" >
                            <option selected  value="">seleccione el periodo</option>
                            @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="periodo_id" id="periodo_id" class="form-control" > --}}
                        </div>
                      <div class="col text-right">
                        <button class="btn btn-danger btn-sm" type="button" onclick="generarpdflistaprofesor()"><i class="fas fa-print"></i>imprimir</button>
                    </div>  
              </div>
            

                @php
                $alumnosapeno = [];$alumnosapepa = [];$alumnosapema = [];
              @endphp
                 @foreach ($alumnos as $alumno)
                  @if (!in_array($alumno->nombre,  $alumnosapeno))
                            @php
                            $alumnosapeno[] = $alumno->nombre;
                            @endphp
                  @endif
                    @if (!in_array($alumno->apellidopaterno,  $alumnosapepa))
                    @php
                    $alumnosapepa[] = $alumno->apellidopaterno;
                    @endphp
                    @endif
                        @if (!in_array($alumno->apellidomaterno,  $alumnosapema))
                        @php
                        $alumnosapema[] = $alumno->apellidomaterno;
                        @endphp
                        @endif
                 @endforeach
              <div class="row">
                <div class="col">
                  <label class="text-primary text-capitalize">nombre_alumno</label>
                  <select type="text" name="alumno_nombre" id="alumno_nombre" class="form-control" >
                    <option selected  value="">seleccione el nombre del alumno</option>
                    @foreach ($alumnosapeno as $alumnonom)
                    <option value="{{ $alumnonom }}">{{ $alumnonom }}</option>
                    @endforeach
                </select>
              </div>
               <div class="col">
                  <label class="text-primary text-capitalize">apepaterno_alumno</label>
                  <select type="text" name="alumno_apepa" id="alumno_apepa" class="form-control" >
                    <option selected  value="">seleccione el apellidopaterno</option>
                    @foreach ($alumnosapepa as $alumnopa)
                    <option value="{{ $alumnopa}}">{{ $alumnopa}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col">
                  <label class="text-primary text-capitalize">apematerno_alumno</label>
                  <select type="text" name="alumno_apema" id="alumno_apema" class="form-control" >
                    <option selected  value="">seleccione el nombre del alumno</option>
                    @foreach ($alumnosapema as $alumnoma)
                    <option value="{{ $alumnoma}}">{{ $alumnoma}}</option>
                    @endforeach
                </select>
              </div> 

         
                <div class="col">
                  <label class="text-primary text-capitalize">estado</label>
                  <select type="text" name="estado" id="estado" class="form-control">
                    <option selected  value="">ambos</option>
                    <option value="activo">activo</option> 
                    <option value="inactivo">inactivo</option> 
                    </select>
                </div>
                <div class="col">
                  <label class="text-primary text-capitalize">ordenar</label>
                  <div class="input-group">
                    <select type="text" name="ordenar" id="ordenar" class="form-control">
                      <option value="fechadeingreso">fechadeingreso</option> 
                      <option value="ci">ci</option> 
                      <option value="nombre">nombre</option> 
                      <option value="apellidopaterno">apellidopaterno</option> 
                      <option value="apellidomaterno">apellidomaterno</option> 
                      <option value="materias.materia">materias</option> 
                      <option value="materias.costo">costo</option> 
                      <option value="aulas.aula">aulas</option> 
                      <option value="periodos.periodo">periodo</option> 
                      </select>
                      <div class="input-group-append">
                        <select type="text" name="mayorymenor" id="mayorymenor" class="form-control">
                          <option value="desc">desc</option> 
                          <option value="asc">asc</option> 
                          </select>
                      </div>
                  </div>
                </div>
              </div>
          </div>
  </div>
</div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                {{-- <th scope="col">id alum</th> --}}
                <th scope="col">fechadeingreso</th>
                <th scope="col">ci</th>
                <th scope="col">nombre</th>
                <th scope="col">apellidopaterno</th>
                <th scope="col">apellidomaterno</th>
                <th scope="col">materia</th>
                <th scope="col">materia costo</th>
                <th scope="col">periodo</th>
                <th scope="col">aula</th>
                <th scope="col">estado</th>
                <th scope="col">imagen</th>
                {{-- <th scope="col">acciones</th> --}}
              </tr>
            </thead>
            <tbody id="tabla_alu">
              @foreach ($alumnos as $alumno)
                        <tr>
                            {{-- <td scope="row">{{ $alumno->id }}</td>--}}
                            <td>{{ $alumno->fechadeingreso }}</td> 
                            <td>{{ $alumno->ci }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellidopaterno }}</td>
                            <td>{{ $alumno->apellidomaterno }}</td>
                            <td>{{ $alumno->materia }}</td>
                            <td>{{ $alumno->costo }}</td>
                            <td>{{ $alumno->periodo }}</td>
                            <td>{{ $alumno->aula }}</td>
                            <td>{{ $alumno->asignarpromas_estado }}</td>
                            <td>
                            <img src="{{ asset('storage').'/'.$alumno->imagen}}" alt=""  width="50px" height="50px"  class="img-thumbnail img-fluid">
                            </td>
                            {{-- <>
                            <a href="{{ url('/alumno/'.$alumno->id.'/edit') }}" method="post" class="btn btn-sm btn-danger">
                              <i class="fas fa-print"></i></a>
                            {{-- <a href="{{ url('/alumno/'.$alumno->id.'/') }}" method="post" class="btn btn-sm btn-danger">
                              <i class="far fa-eye"></i></a>      --}}
                              {{-- <a href="{{ url('/alumno/'.$alumno->id.'/edit') }}" method="post" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i></a>          --}}
                        </tr>
                        @endforeach
            </tbody>
          </table>
        </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
   <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/pdfmake.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/vfs_fonts.js"></script>

  
   <script>
    $(document).ready(function() {
      var estiloOriginal = $('#buscar').css('border');
  
      // Cuando se produzca el evento 'click' en cualquier input
      $('input').on('click', function() {
        // Restaurar el estilo original del borde en el input "nombre"
        $('#buscar').css('border', estiloOriginal)
      });
  
        $('#fechainicio').on('change', function() {
  
            var fecha_ini = $(this).val(); 
            var fecha_fin = $('#fechafinal').val();
            var profesorid = $('#profesor_id').val();
            var materiaid = $('#materia_id').val();
            var periodoid = $('#periodo_id').val();
            var aulaid = $('#aula_id').val();  
            var estado = $('#estado').val();  
            var alumno_nombre = $('#alumno_nombre').val();
            var alumno_apepa = $('#alumno_apepa').val();
            var alumno_apema = $('#alumno_apema').val();
            var ordenar = $('#ordenar').val();
            var mayorymenor = $('#mayorymenor').val();
            //alert(estado)
            generartabla(fecha_ini,fecha_fin,profesorid,materiaid,periodoid,aulaid,estado,alumno_nombre,alumno_apepa,alumno_apema,ordenar,mayorymenor); 
           
        });
        function generartabla(fecha_ini,fecha_fin,profesorid,materiaid,periodoid,aulaid,estado,alumno_nombre,alumno_apepa,alumno_apema,ordenar,mayorymenor) {
              $.ajax({
                    url: '{{ url("obtener-fechainicioalumnoprofereporte") }}', // Ruta a tu controlador Laravel
                    type: 'POST',
                    data: {
                        fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                        fechafinal: fecha_fin,
                        profesorid: profesorid,// Enviar el ID del aula seleccionada
                        materiaid: materiaid,
                        periodoid: periodoid,
                        aulaid: aulaid,
                        estado: estado,
                        alumno_nombre:alumno_nombre,
                        alumno_apepa:alumno_apepa,
                        alumno_apema:alumno_apema,
                        ordenarasig:ordenar,
                        mayorymenorasig:mayorymenor,
                      // profesor_id: profesorId,
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                      
                    },
                    success: function(response) {
                        // Limpiar el campo de selección de periodos
                        $('#tabla_asigre').empty();
                      // profesorreporte=[];
                        $.each(response, function(key, value) {
                            // alert(value.id)
                            var imagen='{{asset('storage').'/'}}';
                            $('#tabla_asigre').append(
                                '<tr>'+
                                // ' <td>'+value.id+'</td>'+
                                    '<td>'+value.fechadeingreso+'</td>'+
                                    '<td>'+value.ci+'</td>'+
                                    ' <td>'+value.nombre+'</td>'+
                                    '<td>'+value.apellidopaterno+'</td>'+
                                    '<td>'+value.apellidomaterno+'</td>'+
                                  
                                    ' <td>'+value.materia_nombre+'</td>'+
                                    ' <td>'+value.materia_costo+'</td>'+
                                    ' <td>'+value.periodo_nombre+'</td>'+
                                    ' <td>'+value.aula_nombre+'</td>'+
                                    ' <td>'+value.asignarpromas_estado+'</td>'+
                                    ' <td><img src="'+imagen+value.imagen+'" alt=""  width="50px"  height="50px" class="img-thumbnail img-fluid"></td>'+
                                   // ' <td>'+value.role+'</td>'+
                                    // ' <td>'+
                                    //    '<a href="/proyecto/public/asignacion/' + value.id + '/edit" method="post" class="btn btn-sm btn-danger"> <i class="fas fa-print"></i></a>' +
                                    //   // '<a href="/proyecto/public/asignacion/' + value.id + '/show" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+
                                    // ' </td>'+
                                ' </tr>'
                            );
                            //alert(value.id);
                           // profesorreporte.push(encontrarListaPorId(value.id)); //añadiendo elemtos a la nueva variable
                           // $('#miadelanto').find('td').css('border', '1px solid black');
                        });
                    }  
                });
        }
        $('#fechafinal').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#profesor_id').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#materia_id').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#periodo_id').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#aula_id').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#estado').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#alumno_nombre').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#alumno_apepa').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#alumno_apema').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#ordenar').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#mayorymenor').on('change', function() {
           $('#fechainicio').trigger('change');
        });
    });
  </script>
@endsection
