@extends('layouts.panel')



@section('content')

  <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
                      <div class="col">
                        <h3 class="mb-0">LISTA DE PROFESORES</h3>
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
                                <div class="col">
                                  <label class="text-primary text-capitalize">estado</label>
                                  <select type="text" name="estado" id="estado" class="form-control">
                                    <option selected  value="">ambos</option>
                                    <option value="activo">activo</option> 
                                    <option value="inactivo">inactivo</option> 
                                    </select>
                                </div>
                                <div class="col-md-4">
                                  <label class="text-primary text-capitalize">Buscar</label>
                                  <div class="input-group">
                                    <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Ingrese término de búsqueda">
                                     <!--  <div class="input-group-append">
                                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i>Buscar</button>
                                      </div>  -->
                                  </div>
                                </div>
                                <div class="col text-right">
                                  {{-- <button class="btn btn-danger btn-sm" type="button" onclick="generarpdflistaprofesor()"><i class="fas fa-print" ></i>imprimir</button> --}}
                              </div>  
                        </div>
                    </div>
            </div>
          </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table id="tabla_id" class="table align-items-center table-flush" >
            <thead class="thead-light">
              <tr>
                {{-- <th scope="col">id</th> --}}
                <th scope="col">fecha de ingreso</th>
                <th scope="col">ci</th>
                <th scope="col">nombre</th>
                <th scope="col">apellido paterno</th>
                <th scope="col">apellido materno</th>
                <th scope="col">celular</th>
                <th scope="col">dirección</th>
                <th scope="col">correo</th>
                <th scope="col">estado</th>
                <th scope="col">imagen</th>
                <th scope="col">sueldo</th>
                <th scope="col">acciones</th>
              </tr>
            </thead>
            <tbody id="tabla_profe2">
              @foreach ($profesors as $profesor)
                        <tr>
                            {{-- <td scope="row">{{ $profesor->id }}</td> --}}
                            <td>{{ $profesor->fechadeingreso }}</td>
                            <td>{{ $profesor->ci }}</td>
                            <td>{{ $profesor->nombre }}</td>
                            <td>{{ $profesor->apellidopaterno }}</td>
                            <td>{{ $profesor->apellidomaterno }}</td>
                            <td>{{ $profesor->celular }}</td>
                            <td>{{ $profesor->direccion }}</td>
                            <td>{{ $profesor->user->email }}</td>
                            <td>{{ $profesor->estado }}</td>
                            <td>
                            <img src="{{ asset('storage').'/'.$profesor->imagen}}" alt=""  width="50px"  height="50px" class="img-thumbnail img-fluid">
                            </td>
                            <td>{{ $profesor->sueldo }}</td>
                            <td>
                            {{-- <a href="{{ url('/profesor/'.$profesor->id.'/edit') }}" method="post" class="btn btn-sm btn-primary">
                              <i class="fas fa-edit"></i>
                              </a> --}}
                          
                              <a href="{{ route('show2', ['id' => $profesor->id]) }}" class="btn btn-sm btn-danger">
                        

                              <i class="far fa-eye"></i>
                            </a>                     
                            </td>
                        </tr>
                        @endforeach
            </tbody>
          </table>
         {{ $profesors->links() }}
        </div>
   </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/pdfmake.min.js"></script>
   <!-- Link to pdfmake font files -->
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/vfs_fonts.js"></script>
<script>
  var profeprosData = {!! json_encode($profesors) !!};
  var profesorreporte =  {!! json_encode($profesors) !!};
  function encontrarListaPorId(idLista) {
    return profeprosData.find(item => item.id === idLista);
  }
  function generarpdflistaprofesor() {
  // Construir el contenido del reporte utilizando los datos de adelantoprosData
  const filas = [];
  filas.push(['#', 'fechadeingreso', 'ci', 'nombre', 'apellidopaterno','apellidomaterno','celular','direccion','email','estado','imagen','sueldo','role']);
  for (let i = 0; i < profesorreporte.length; i++) {
    const profesor = profesorreporte[i];
    const id = profesor.id;
    const fechadeingreso = profesor.fechadeingreso;
    const ci = profesor.ci;
    const nombre = profesor.nombre;
    const apellidopaterno = profesor.apellidopaterno;
    const apellidomaterno = profesor.apellidomaterno;
    const celular = profesor.celular;
    const direccion = profesor.direccion;
    const user_id = profesor.user_id + "-" + profesor.user.email;
    const estado = profesor.estado;
    const imagen = profesor.imagen;
  //  {  image: 'myImageDictionary/image1.jpg' }
    const sueldo = profesor.sueldo;
    const role = profesor.user.role;
    filas.push([id, fechadeingreso, ci, nombre, apellidopaterno, apellidomaterno,celular,direccion,user_id,estado,imagen,sueldo,role]);
  }
 

  // Definir la estructura del documento PDF con estilos para la tabla
  const docDefinition = {
    pageSize: {  
    width: 1000, // Ajusta el ancho de la página según tus necesidades
    height: 800, // Puedes ajustar el alto de la página según lo requieras
      },
    pageOrientation: 'landscape',
    content: [
      { text: 'Lista de Profesor', style: 'header' },
      {
        table: {
          headers: ['#', 'Fechadeingreso', 'ci', 'nombre', 'apellidopaterno','apellidomaterno','celular','direccion','correo','estado','imagen','sueldo','role'],
          body: filas,
        },
        // Estilo para la cabecera de la tabla
        headerRows: 1,
        fillColor: '#2c6aa6', // Color de fondo azul para la cabecera
      },
    ],
    styles: {
      header: { fontSize: 10, bold: true, margin: [0, 0, 0, 10] },
    },
    // Estilo para las celdas del cuerpo de la tabla
    defaultStyle: { fillColor: '#bdd7e7' }, // Color de fondo azul claro para las celdas
  };

  // Generar el documento PDF
  pdfMake.createPdf(docDefinition).download('reporte_profesores.pdf');
}
</script>
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
      });
      function generartabla(fecha_ini,fecha_fin,buscar,estado) {
            $.ajax({
                  url: '{{ url("obtener-fechainicio2secre") }}', // Ruta a tu controlador Laravel
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
                      $('#tabla_profe2').empty();
                    //  profesorreporte=[];

                      $.each(response, function(key, value) {
                          // alert(value.id)
                          $('#tabla_profe2').append(
                              '<tr>'+
                              // ' <td>'+value.id+'</td>'+
                                  '<td>'+value.fechadeingreso+'</td>'+
                                  ' <td>'+value.ci+'</td>'+
                                  ' <td>'+value.nombre+'</td>'+
                                  ' <td>'+value.apellidopaterno+'</td>'+
                                  ' <td>'+value.apellidomaterno+'</td>'+
                                  ' <td>'+value.celular+'</td>'+
                                  ' <td>'+value.direccion+'</td>'+
                                  ' <td>'+value.email+'</td>'+
                                   ' <td>'+value.estado+'</td>'+
                                  ' <td><img src="'+value.ruta_imagen+'" alt=""  width="50px"  height="50px" class="img-thumbnail img-fluid"></td>'+
                                  ' <td>'+value.sueldo+'</td>'+
                                 // ' <td>'+value.role+'</td>'+
                                  ' <td>'+
                                    // '<a href="/proyecto/public/profesor/' + value.id + '/edit" method="post" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>' +
                                    '<a href="/proyecto/public/profesor/' + value.id + '/" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+
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

