@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">REPORTE DE NOTAS
                    <i class="far fa-calendar-alt  text-blue"></i>
                </h3>
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
                            <label class="text-primary text-capitalize">profesores</label>
                              <select type="text" name="profesor_id" id="profesor_id" class="form-control" >
                                <option selected  value="">seleccione el profesor</option>
                                @foreach ($profesors as $profesor)
                                <option value="{{ $profesor->id }}">{{ $profesor->nombre." ".$profesor->apellidopaterno." ".$profesor->apellidomaterno}}</option>
                                @endforeach
                            </select> 
                            {{-- <input type="text" name="profesor_id" id="profesor_id" class="form-control" > --}}
                          </div>
                          <div class="col">
                            <label class="text-primary text-capitalize">alumnos</label>
                              <select type="text" name="alumno_id" id="alumno_id" class="form-control" >
                                <option selected  value="">seleccione al alumno</option>
                                @foreach ($alumnos as $alumno)
                                <option value="{{ $alumno->id }}">{{ $alumno->nombre." ".$alumno->apellidopaterno." ".$alumno->apellidomaterno}}</option>
                                @endforeach
                            </select> 
                            {{-- <input type="text" name="profesor_id" id="profesor_id" class="form-control" > --}}
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
                            <label class="text-primary text-capitalize">estado</label>
                            <select type="text" name="estado" id="estado" class="form-control">
                              <option selected  value="">ambos</option>
                              <option value="activo">activo</option> 
                              <option value="inactivo">inactivo</option> 
                              </select>
                          </div>
                        <div class="col text-right">
                          <button class="btn btn-danger btn-sm" type="button"><i class="fas fa-print"></i>imprimir</button>
                          <a href="{{url('reporopciones')}}" class="btn btn-sm btn-success" >
                            <i class="fas fa-plus-circle"></i>
                            regresar</a>
                      </div>  
                </div>
                <div class="row">
                      <div class="col">
                        <label class="text-primary text-capitalize">actividad</label>
                        <select type="text" name="actividad_id" id="actividad_id" class="form-control" >
                          <option selected value="">seleccione la actividad</option>
                          @foreach ($actividads as $actividad)
                          <option value="{{ $actividad->id }}">{{ $actividad->actividad}}</option>
                          @endforeach
                      </select>
                      {{-- <input type="text" name="materia_id" id="materia_id" class="form-control" > --}}
                      </div>
                      <div class="col">
                        <label class="text-primary text-capitalize">nota</label>
                        <input type="text" name="notamin" id="notamin" class="form-control">
                        <span class="text-muted">minimo</span>
                      </div>
                      <div class="col">
                        <label class="text-primary text-capitalize">-</label>
                        <input type="text" name="notamax" id="notamax" class="form-control">
                        <span class="text-muted">maximo</span>s
                      </div>
                      <div class="col">
                        <label class="text-primary text-capitalize">ordenar</label>
                        <div class="input-group">
                          <select type="text" name="ordenar" id="ordenar" class="form-control">
                            <option value="fechadenota">fechadenota</option> 
                            <option value="alumno_nombre">nombre_alumno</option> 
                            <option value="actividad_nombre">nombre_actividad</option> 
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
                    <div  class="table-responsive">
                        <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>fechadenota</th>
                                    <th>actividad_id</th>
                                    <th>alumno_id</th>
                                    <th>materia_id</th>
                                    <th>nota</th>
                                    <th>profesor</th>
                                    <th>estado</th>
                                    <th>acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_nota">
                                @foreach ($notas as $nota)
                                <tr>
                                    {{-- <td>{{ $inscripcion->id }}</td> --}}
                                <!--  <td> /* $inscripcion->asignarproma->materia->materia."--".$inscripcion->asignarproma->profesor->user->name}} */</td>-->
                           
                                    <td>{{ $nota->fechadenota}}</td>
                                    <td>{{ $nota->actividad_nombre}}</td>
                                    <td>{{ $nota->alumno_nombre}}</td>
                                    <td>{{ $nota->materia_nombre }}</td>
                                    <td>{{ $nota->nota}}</td>
                                    <td>{{ $nota->profesor_nombre}}</td> 
                                    <td>{{ $nota->estado}}</td>
                                    
                                    <td> <a href="{{ url('/nota/'.$nota->id.'/show') }}" method="post" class="btn btn-sm btn-danger">
                                        <i class="far fa-eye"></i></a>
                                    </td>
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

      $('#fechainicio').on('change', function() {

          var fecha_ini = $(this).val(); 
          var fecha_fin = $('#fechafinal').val();
          var profesorid = $('#profesor_id').val();  
          var alumnoid = $('#alumno_id').val();  
          var materiaid = $('#materia_id').val(); 
          var estado = $('#estado').val();  
          var actividadid = $('#actividad_id').val(); 
          var notamin = $('#notamin').val(); 
          var notamax = $('#notamax').val(); 
          var ordenarnot = $('#ordenar').val();
          var mayorymenornot= $('#mayorymenor').val();
          generartabla(fecha_ini,fecha_fin,profesorid,alumnoid,materiaid,estado,actividadid,notamin,notamax,ordenarnot,mayorymenornot);      
        //alert(actividadid)
      });
      function generartabla(fecha_ini,fecha_fin,profesorid,alumnoid,materiaid,estado,actividadid,notamin,notamax,ordenarnot,mayorymenornot) {
            $.ajax({
                 url: '{{ url("obtener-fechainicionotareporte") }}', // Ruta a tu controlador Laravel
                  type: 'POST',
                  data: {
                      fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                      fechafinal: fecha_fin,
                      profesorid: profesorid,// Enviar el ID del aula seleccionada
                      alumnoid: alumnoid,
                      materiaid: materiaid,
                      estado: estado,
                      actividadid: actividadid,
                      notamin: notamin,
                      notamax: notamax,
                      ordenarnot:ordenarnot,
                      mayorymenornot:mayorymenornot,
                    // profesor_id: profesorId,
                      _token: '{{ csrf_token() }}' // Agregar el token CSRF
                  },
                  success: function(response) {
                    
                
                      // Limpiar el campo de selección de periodos
                      $('#tabla_nota').empty();
                      //profesorreporte=[];

                      $.each(response, function(key, value) {
                          // alert(value.id)
                          $('#tabla_nota').append(
                              '<tr>'+
                              // ' <td>'+value.id+'</td>'+
                                  '<td>'+value.fechadenota+'</td>'+
                                  ' <td>'+value.actividad_nombre+'</td>'+
                                  ' <td>'+value.alumno_nombre+'</td>'+
                                  ' <td>'+value.materia_nombre+'</td>'+
                                  ' <td>'+value.nota+'</td>'+
                                  ' <td>'+value.profesor_nombre+'</td>'+
                                  ' <td>'+value.estado+'</td>'+
                                //   '<td>'+value.nombre_profesor+'</td>'+
                                  ' <td>'+
                                    // '<a href="/proyecto/public/profesor/' + value.id + '/edit" method="post" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>' +
                                    '<a href="/proyecto/public/nota/' + value.id + '/" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+
                                  ' </td>'+
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
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#alumno_id').on('change', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#actividad_id').on('change', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#materia_id').on('change', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#notamin').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#notamax').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#estado').on('input', function() {
       // alert($(this).val())
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