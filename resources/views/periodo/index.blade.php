@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">LISTA DE PERIODOS
                    <i class="far fa-calendar-alt  text-blue"></i>
                </h3>
                <div class="row">
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
                          <a href="{{url('periodo/create')}}" class="btn  btn-sm btn-primary text-capitalize" >
                              <i class="fas fa-plus-circle"></i>
                              agregar nuevo periodo</a>
                      </div>  
                </div>
            </div>
        </div>
    </div>
                        <div  class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                {{-- <tr>
                                    <th>#</th> --}}
                                    <th>periodo</th>
                                    <th>estado</th>
                                    <th>acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_periodo">
                                @foreach ($periodos as $periodo)
                                <tr>
                                    {{-- <td>{{ $periodo->id }}</td> --}}
                                    <td>{{ $periodo->periodo }}</td>
                                    <td>{{ $periodo->estado }}</td>
                                    <td>
                                        <a href="{{ url('/periodo/'.$periodo->id.'/edit') }}" method="post" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i></a>
                                          {{-- <a href="{{ url('/periodo/'.$periodo->id.'/') }}" method="post" class="btn btn-sm btn-danger">
                                            <i class="far fa-eye"></i></a>  --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $periodos->links() }}
                    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/pdfmake.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/vfs_fonts.js"></script>
<script>
 $(document).ready(function() {
     $('#buscar').on('input', function() {
         var buscar = $(this).val(); 
         var estado = $('#estado').val(); 
         generartabla(buscar,estado);      
      
     });
     function generartabla(buscar,estado) {
           $.ajax({
                 url: '{{ url("buscar-periodos") }}', // Ruta a tu controlador Laravel
                 type: 'POST',
                 data: {
                     buscarpe: buscar,// Enviar el ID del aula seleccionada
                     estadopro:estado,
                     _token: '{{ csrf_token() }}' // Agregar el token CSRF
                 },
                 success: function(response) {
                     // Limpiar el campo de selección de periodos
                     $('#tabla_periodo').empty();
                   // profesorreporte=[];
                     $.each(response, function(key, value) {
                         // alert(value.id)
                         $('#tabla_periodo').append(
                             '<tr>'+
                             // ' <td>'+value.id+'</td>'+
                                 '<td>'+value.periodo+'</td>'+
                                 ' <td>'+value.estado+'</td>'+
                                // ' <td>'+value.role+'</td>'+
                                 ' <td>'+
                                   '<a href="/proyecto/public/periodo/' + value.id + '/edit" method="post" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>' +
                                //    '<a href="/proyecto/public/periodo/' + value.id + '/" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+
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
     $('#estado').on('change', function() {
          // alert($(this).val())
            $('#buscar').trigger('input');
          });
 });
</script>
@endsection