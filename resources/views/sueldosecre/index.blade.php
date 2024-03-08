@extends('layouts.panel')

@section('content')
<div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">LISTA DE PAGOS DE LAS SECRETARIAS
                        <i class="far fa-calendar-alt  text-blue"></i> 
                    </h3>
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
                            {{-- <div class="col">
                                <label class="text-primary text-capitalize">estado</label>
                                <select type="text" name="estado" id="estado" class="form-control">
                                  <option selected  value="">ambos</option>
                                  <option value="pendiente">pendiente</option> 
                                  <option value="pagado">pagado</option> 
                                  </select>
                              </div> --}}
                            <div class="col">
                                <label class="text-primary text-capitalize">Buscar</label>
                                <div class="input-group">
                                    <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Ingrese término de búsqueda">
                                    <!--  <div class="input-group-append">
                                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i>Buscar</button>
                                    </div>  -->
                                </div>
                            </div>
                            <div class="col text-right">
                                {{-- <button class="btn  btn-sm btn-danger" type="button"><i class="fas fa-print"></i>imprimir</button> --}}
                                <a href="{{url('sueldosecre/create')}}" class="btn  btn-sm btn-primary text-capitalize" >
                                    <i class="fas fa-plus-circle"></i>
                                    agregar nuevo pago</a>
                             </div>  
                    </div>
                </div>
            </div>
        </div>
            
        <div class="table-responsive">
          <table  id="tabla_id"  class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                             {{-- <th>#</th> --}}
                            <th scope="col" > Fecha de Pago</th>
                            <th scope="col" > Mes</th>
                            <th scope="col">Sueldo</th>
                            <th scope="col">Total descuento</th>
                            <th scope="col">Total a pagar</th>
                            <th scope="col">Observación</th>
                            <th scope="col">Secretaria</th>
                            {{-- <th scope="col">acciones</th> --}}
              </tr>
            </thead>
            <tbody id="tabla_susecre">
              @foreach ($sueldosecres as $sueldosecre)
                        <tr>
                            {{-- <td>{{ $sueldosecre->id }}</td> --}}
                            <td>{{ $sueldosecre->fechadesueldo }}</td>
                            <td>{{ $sueldosecre->mesdepago }}</td>
                            <td>{{ $sueldosecre->secretaria->sueldo }}</td>
                            <td>{{ $sueldosecre->totaldescuento }}</td>
                            <td>{{ $sueldosecre->totalpago }}</td>
                            <td>{{ $sueldosecre->observacion }}</td>
                            <td>{{ $sueldosecre->secretaria->nombre }} {{ $sueldosecre->secretaria->apellidopaterno }} {{ $sueldosecre->secretaria->apellidomaterno }}</td>
                            {{-- <td> <a href="{{ url('/sueldosecre/'.$sueldosecre->id.'/show') }}" method="post"  class="btn btn-sm btn-success"><i class="fas fa-donate" ></i> </a>      
                            </td> --}}
                        </tr>
                @endforeach
            </tbody>
          </table>
          {{ $sueldosecres->links() }}
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
          generartabla(fecha_ini,fecha_fin,buscar);      
       
      });
      function generartabla(fecha_ini,fecha_fin,buscar) {
            $.ajax({
                  url: '{{ url("obtener-fechainiciosusecre") }}', // Ruta a tu controlador Laravel
                  type: 'POST',
                  data: {
                      fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                      fechafinal: fecha_fin,
                      buscarpro: buscar,// Enviar el ID del aula seleccionada
                    // profesor_id: profesorId,
                      _token: '{{ csrf_token() }}' // Agregar el token CSRF
                  },
                  success: function(response) {
                      $('#tabla_susecre').empty();
                     //profesorreporte=[];
                      $.each(response, function(key, value) {
                          // alert(value.id)
                          $('#tabla_susecre').append(
                              '<tr>'+
                              // ' <td>'+value.id+'</td>'+
                                  '<td>'+value.fechadesueldo+'</td>'+
                                  ' <td>'+value.mesdepago+'</td>'+
                                  ' <td>'+value.sueldo+'</td>'+
                                  ' <td>'+value.totaldescuento+'</td>'+
                                  ' <td>'+value.totalpago+'</td>'+
                                  ' <td>'+value.observacion+'</td>'+
                                  ' <td>'+value.nombre+' '+value.apellidopaterno+' '+value.apellidomaterno+'</td>'+
                                  // ' <td>'+value.estado+'</td>'+
                                  // ' <td>'+
                                  //   '<a href="/proyecto/public/sueldosecre/' + value.id + '/show" method="post" class="btn btn-sm btn-success"> <i class="fas fa-donate"></i></a>'+
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
      $('#buscar').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
      });
  });
</script>
@endsection