@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">LISTA DE NOTAS
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
                          <label class="text-primary text-capitalize">Buscar</label>
                          <div class="input-group">
                            <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Ingrese término de búsqueda">
                             <!--  <div class="input-group-append">
                                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i>Buscar</button>
                              </div>  -->
                          </div>
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
                          {{-- <button class="btn btn-danger btn-sm" type="button"><i class="fas fa-print"></i>imprimir</button> --}}
                          <a href="{{url('nota/create')}}" class="btn btn-sm btn-primary text-capitalize" > <i class="fas fa-plus-circle"></i> agregar nueva nota</a>
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
   <!-- Link to pdfmake font files -->
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
            var buscar = $('#buscar').val(); 
            var estado = $('#estado').val();   
            generartabla(fecha_ini,fecha_fin,buscar,estado);   
            //alert(estado)   
        });
        function generartabla(fecha_ini,fecha_fin,buscar,estado) {
              $.ajax({
                    url: '{{ url("obtener-fechainicionota") }}', // Ruta a tu controlador Laravel
                    type: 'POST',
                    data: {
                        fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                        fechafinal: fecha_fin,
                        buscarpro: buscar,// Enviar el ID del aula seleccionada
                        estadopro:estado,
                      // profesor_id: profesorId,
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                    },
                    success: function(response) {
                        // Limpiar el campo de selección de periodos
                        $('#tabla_nota').empty();
                       // profesorreporte=[];
  
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
                          //  profesorreporte.push(encontrarListaPorId(value.id)); //añadiendo elemtos a la nueva variable
                           // $('#miadelanto').find('td').css('border', '1px solid black');
                        });
                    }
                });
        }
        $('#fechafinal').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#buscar').on('input', function() {
         // alert($(this).val())
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#estado').on('change', function() {
         // alert($(this).val())
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
    });
  </script> 
@endsection