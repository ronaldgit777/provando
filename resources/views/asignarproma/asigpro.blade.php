@extends('layouts.panel')

@section('content')
<div class="card shadow">
         <div class="card-header border-0">
                <div class="row align-items-center">
                      <div class="col">
                        <h3 class="mb-0">LISTA DE ASIGNACIONES</h3>
                        <div class="row">
                                <div class="col">
                                    <label class="text-primary text-capitalize">fecha de inicio</label>
                                    <input type="date" name="fechainicio" id="fechainicio" class="form-control" >
                                    <span class="text-muted"></span>
                                </div>
                                <div class="col">
                                    <label class="text-primary text-capitalize">fecha de final</label>
                                    <input type="date" name="fechafinal" id="fechafinal" class="form-control">
                                    <span class="text-muted"></span>
                                </div>
                                <div class="col text-right">
                                  {{-- <button class="btn btn-danger btn-sm" type="button"><i class="fas fa-print"></i>imprimir</button> --}}
                                  {{-- <a href="{{url('home')}}" class="btn btn-sm btn-success" >
                                  <i class="fas fa-plus-circle"></i>
                                  regresar</a> --}}
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
                                    <th>fecha de asignaciÓn</th>
                                    <th>profesor</th>
                                    <th>materia</th>
                                    <th>costo</th>
                                    <th>aula</th>
                                    <th>periodo</th>
                                    <th>estado</th>
                                    {{-- <th>acciones</th> --}}
                                </tr>
                            </thead>
                            <tbody id="tabla_asigre">
                            @if(isset($asignarpromas) && count($asignarpromas) > 0)
                                @foreach ($asignarpromas as $asignarproma)
                                <tr>
                                    {{-- <td>{{ $asignarproma->id }}</td> --}}
                                    <td>{{ $asignarproma->fechadeasignacion }}</td>
                                    <td>{{ $asignarproma->nombre." ".$asignarproma->profesor->apellidopaterno." ".$asignarproma->profesor->apellidomaterno }}</td>
                                    {{-- <td>{{ $asignarproma->profesor->nombre."-".$asignarproma->profesor->apellidopaterno }}</td> --}}
                                    <td>{{ $asignarproma->nombre_materia}}</td>
                                    <td>{{ $asignarproma->materia->costo}}</td>
                                    <td>{{ $asignarproma->nombre_aula }}</td>
                                    <td>{{ $asignarproma->nombre_periodo }}</td>
                                    <td>{{ $asignarproma->estado }}</td>
                                    {{-- <td> <a href="{{ url('/asignarproma/'.$asignarproma->id.'/show') }}" method="post">ver</a> --}}
                                    </td>
                                </tr>
                                @endforeach
                                @else
            <tr>
            <td colspan="12">No hay materias asignadas.</td>
            </tr>
            @endif
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
           // alert(estado);
            generartabla(fecha_ini,fecha_fin,profesorid,materiaid,periodoid,aulaid,estado); 
           
        });
        function generartabla(fecha_ini,fecha_fin,profesorid,materiaid,periodoid,aulaid,estado) {
              $.ajax({
                    url: '{{ url("obtener-fechainicioasigprofeuser") }}', // Ruta a tu controlador Laravel
                    type: 'POST',
                    data: {
                        fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                        fechafinal: fecha_fin,
                        profesorid: profesorid,// Enviar el ID del aula seleccionada
                        materiaid: materiaid,
                        periodoid: periodoid,
                        aulaid: aulaid,
                        estadoasig:estado,
                      // profesor_id: profesorId,
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                      
                    },
                    success: function(response) {
                        // Limpiar el campo de selección de periodos
                        $('#tabla_asigre').empty();
                      // profesorreporte=[];
                        $.each(response, function(key, value) {
                            // alert(value.id)
                            $('#tabla_asigre').append(
                                '<tr>'+
                                // ' <td>'+value.id+'</td>'+
                                    '<td>'+value.fechadeasignacion+'</td>'+
                                    ' <td>'+value.profesor_nombre+'</td>'+
                                    ' <td>'+value.materia_nombre+'</td>'+
                                    ' <td>'+value.materia_costo+'</td>'+
                                    ' <td>'+value.aula_nombre+'</td>'+
                                    ' <td>'+value.periodo_nombre+'</td>'+
                                    ' <td>'+value.estado+'</td>'+
                                   // ' <td>'+value.role+'</td>'+
                                    // ' <td>'+
                                    //    '<a href="/proyecto/public/asignacion/' + value.id + '/edit" method="post" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>' +
                                    //   '<a href="/proyecto/public/asignacion/' + value.id + '/show" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+
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
        $('#estado').on('change', function() {
           $('#fechainicio').trigger('change');
        });
    });
  </script>
@endsection