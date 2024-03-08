@extends('layouts.panel')

@section('content')
    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                      <div class="col">
                                        <h3 class="mb-0">REPORTE LISTA DE LOS SUELDOS PAGADOS DEL PROFESOR
                                            <i class="far fa-calendar-alt  text-blue"></i> 
                                        </h3>
                                        <div class="row">
                                                <div class="col">
                                                    <label class="text-primary text-capitalize">fecha de inicio</label>
                                                    <input type="date" name="fechainicio" id="fechainicio" class="form-control" >
                                                </div>
                                                <div class="col">
                                                    <label class="text-primary text-capitalize">fecha de final</label>
                                                    <input type="date" name="fechafinal" id="fechafinal" class="form-control">
                                                    {{-- <span class="text-muted"></span> --}}
                                                </div>
                                                <div class="col">
                                                    <label class="text-primary text-capitalize">profesores</label>
                                                    <select type="text" name="profesor_id" id="profesor_id" class="form-control" >
                                                      <option selected  value="">todos los profesores</option>
                                                      @foreach ($profesors as $profesor)
                                                      <option value="{{ $profesor->id }}">{{ $profesor->nombre." ".$profesor->apellidopaterno." ".$profesor->apellidomaterno}}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                                    <div class="col">
                                                      <label class="text-primary text-capitalize">ordenar</label>
                                                      <div class="input-group">
                                                          <select type="text" name="ordenar" id="ordenar" class="form-control">
                                                            <option value="fechadesueldo">fecha</option> 
                                                            <option value="mesdepago">mesdepago</option> 
                                                            <option value="sueldo">sueldo</option> 
                                                            <option value="totaldescuento">totaldescuento</option> 
                                                            <option value="totalpago">totalpago</option> 
                                                            <option value="nombre_profesor">profesor</option> 
                                                          </select>
                                                          <div class="input-group-append">
                                                            <select type="text" name="mayorymenor" id="mayorymenor" class="form-control">
                                                              <option value="desc">desc</option> 
                                                              <option value="asc">asc</option> 
                                                              </select>
                                                          </div>
                                                      </div>
                                                    </div>
                                                <div class="col text-right">
                                                  <button class="btn btn-danger btn-sm" type="button" onclick="generarpdflistaprofesor()"><i class="fas fa-print"></i>imprimir</button>
                                                    <a href="{{url('reporopciones')}}" class="btn btn-sm btn-success" >
                                                        <i class="fas fa-plus-circle"></i>
                                                        regresar</a>
                                              </div>  
                                        </div>
                                        <div class="row">
                                              <div class="col">
                                                <label class="text-primary text-capitalize">sueldo</label>
                                                  <div class="input-group">
                                                        <input type="numeber" name="sueldomin" id="sueldomin" class="form-control" placeholder="desde">   
                                                        <input type="numeber" name="sueldomax" id="sueldomax" class="form-control" placeholder="hasta">   
                                                  </div>
                                              </div>
                                              <div class="col">
                                                <label class="text-primary text-capitalize">totaldescuento</label>
                                                <div class="input-group">
                                                      <input type="numeber" name="todesmin" id="todesmin" class="form-control" placeholder="desde">
                                                      <input type="numeber" name="todesmax" id="todesmax" class="form-control"  placeholder="hasta">
                                                </div>
                                              </div>
                                              <div class="col">
                                                <label class="text-primary text-capitalize">totalpago</label>
                                                <div class="input-group">
                                                      <input type="numeber" name="topamin" id="topamin" class="form-control" placeholder="desde">
                                                      <input type="numeber" name="topamax" id="topamax" class="form-control"  placeholder="hasta">
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                            </div>
                          </div>
                        
                    <div  class="table-responsive">
                        <table id="tabla_id"  class="table align-items-center table-flush">
                            <thead class="thead-light table-primary">
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th scope="col"> fecha de pago</th>
                            <th scope="col"> mes</th>
                            <th scope="col">sueldo</th>
                            <th scope="col">total descuento</th>
                            <th scope="col">total pago</th>
                            <th scope="col">observación</th>
                            <th scope="col">profesor</th>
                            {{-- <th scope="col">acciones</th> --}}
                                </tr>
                            </thead>
                            <tbody  id="tabla_profesu">
                              @foreach ($sueldopros as $sueldopro)
                                <tr>
                                    {{-- <td>{{ $adelantopro->id }}</td> --}}
                                    <td>{{ $sueldopro->fechadesueldo }}</td>
                                    <td>{{ $sueldopro->mesdepago }}</td>
                                    <td>{{ $sueldopro->profesor->sueldo }}</td>
                                    <td>{{ $sueldopro->totaldescuento }}</td>
                                    <td>{{ $sueldopro->totalpago }}</td>
                                    <td>{{ $sueldopro->observacion }}</td>
                                    <td>{{ $sueldopro->nombre_profesor}} {{ $sueldopro->apepa_profesor}} {{ $sueldopro->apema_profesor}}</td>
                                    {{-- <td> 
                                      <a href="{{ url('/sueldopro/'.$sueldopro->id.'/show') }}" method="post"  class="btn btn-sm btn-danger"><i class="fas fa-print" ></i>
                                      </a>
                                    </td>            --}}
                                    
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
  var secreprosData = {!! json_encode($sueldopros) !!};
 var sueldoproreporte =  {!! json_encode($sueldopros) !!};
 function encontrarListaPorId(idLista) {
   return secreprosData.find(item => item.id === idLista);
 }
function generarpdflistaprofesor() {
 //Reemplazar las URLs de las imágenes con las imágenes en base64 en la lista profesorreporte
//  var totalImages = secretariareporte.length;
//  var imagesProcessed = 0;

   // secretariareporte.forEach(function (adelantosecre) {
      //  var img = new Image();
      //  img.crossOrigin = 'Anonymous';
      //  img.onload = function () {
      //    var canvas = document.createElement('canvas');
      //    var ctx = canvas.getContext('2d');
      //    canvas.width = img.width;
      //    canvas.height = img.height;
      //    ctx.drawImage(img, 0, 0, img.width, img.height);
      //    var dataURL = canvas.toDataURL('image/jpeg'); // Cambiar a 'image/png' si es necesario

      //    // Actualizar la URL de la imagen con la imagen en base64
      //    adelantosecre.ruta_imagen = dataURL;

      //    imagesProcessed++;
      //    if (imagesProcessed === totalImages) {
          // Una vez que todas las imágenes se hayan procesado, generar el PDF
          generarPDF();
      //    }
      //  };

      //  img.src = adelantosecre.ruta_imagen;

   // });
}

function generarPDF() {
 var currentDate = new Date();
var formattedDate = currentDate.toISOString().slice(0, 10);
 // Definir la estructura del documento PDF con estilos para la tabla
 const docDefinition = {
   pageSize: {  
     width: 1000, // Ajusta el ancho de la página según tus necesidades
     height: 800, // Puedes ajustar el alto de la página según lo requieras
   },
   pageOrientation: 'landscape',
   header: {
   text: "Instituto TEL C",
   alignment: "left",
   margin: [40, 10, 10, 20],
 },
       footer: function(currentPage, pageCount) {
       return {
         text: "direccion:av san martin entre uruguay - Página " + currentPage.toString() + " de " + pageCount,
         alignment: "left",
         margin: [40, 10, 10, 20],
       };
        },
   content: [
     { text: 'Lista de Pagos de Profesores', 
       //style: 'header'
      },
      {
     text: "Fecha: " + formattedDate,
     alignment: "right",
     margin: [0, 0, 0, 10],
      },
     {
       table: {

         headers: [ 'fecha de sueldo','mes de pago','sueldo','total descuento','total pago','observacion','profesor'],
         body: obtenerDatosTabla(),
       },
       // Estilo para la cabecera de la tabla
      // headerRows: 1,
       //fillColor: '#2c6aa6', // Color de fondo azul para la cabecera
       
     },
   ],
   
   styles: {
     header: { fontSize: 10, bold: true, margin: [0, 0, 0, 10] },
   },
   // Estilo para las celdas del cuerpo de la tabla
  // defaultStyle: { fillColor: '#bdd7e7' }, // Color de fondo azul claro para las celdas
 };

 // Generar el documento PDF
 pdfMake.createPdf(docDefinition).download(
   "reporte_sueldo_profesor-" + formattedDate + ".pdf"
 );
}

function obtenerDatosTabla() {
 // Obtener los datos de la tabla a partir de la lista profesorreporte (con las URLs de las imágenes convertidas a base64)
 var filas = [];
 var headers= [ 'fecha de sueldo','mes de pago','sueldo','total descuento','total pago','observacion','profesor'];
 filas.push(headers);
sueldoproreporte.forEach(function (sueldopro) {
   var fila = [
    // profesor.id,
    sueldopro.fechadesueldo,
    sueldopro.mesdepago,
    sueldopro.sueldo_profesor,
    sueldopro.totaldescuento,
    sueldopro.totalpago,
    sueldopro.observacion,
    sueldopro.nombre_profesor+' '+sueldopro.apepa_profesor+' '+sueldopro.apema_profesor,
   ];
   filas.push(fila);
 });
 return filas;
}
</script>
<script>
  $(document).ready(function() {

      $('#fechainicio').on('change', function() {
          var fecha_ini = $(this).val(); 
          var fecha_fin = $('#fechafinal').val();
          var profesorid = $('#profesor_id').val();  
          var sueldomin = $('#sueldomin').val();  
          var sueldomax = $('#sueldomax').val();  
          var todesmin = $('#todesmin').val();  
          var todesmax = $('#todesmax').val();  
          var topamin = $('#topamin').val();  
          var topamax = $('#topamax').val();  
          var ordenarsupro = $('#ordenar').val();
            var mayorymenorsupro = $('#mayorymenor').val();
          generartabla(fecha_ini,fecha_fin,profesorid,sueldomin ,sueldomax,todesmin,todesmax,topamin,topamax,ordenarsupro,mayorymenorsupro);      
   //    alert(profesorid)
      });
      function generartabla(fecha_ini,fecha_fin,profesorid,sueldomin ,sueldomax,todesmin,todesmax,topamin,topamax,ordenarsupro,mayorymenorsupro) {
            $.ajax({
                 url: '{{ url("obtener-fechainicioprosureporte") }}', // Ruta a tu controlador Laravel
                  type: 'POST',
                  data: {
                      fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                      fechafinal: fecha_fin,
                      profesorid: profesorid,// Enviar el ID del aula seleccionada
                      sueldomin: sueldomin,
                      sueldomax: sueldomax,
                      todesmin: todesmin,
                      todesmax: todesmax,
                      topamin: topamin,
                      topamax: topamax,
                      ordenarsupro:ordenarsupro,
                      mayorymenorsupro:mayorymenorsupro,
                    // profesor_id: profesorId,
                      _token: '{{ csrf_token() }}' // Agregar el token CSRF
                  },
                  success: function(response) {
                      // Limpiar el campo de selección de periodos
                      $('#tabla_profesu').empty();
                      sueldoproreporte=[];

                      $.each(response, function(key, value) {
                          // alert(value.id)
                          $('#tabla_profesu').append(
                              '<tr>'+
                              // ' <td>'+value.id+'</td>'+
                              '<td>'+value.fechadesueldo+'</td>'+
                                  ' <td>'+value.mesdepago+'</td>'+
                                  ' <td>'+value.sueldo_secre+'</td>'+
                                  ' <td>'+value.totaldescuento+'</td>'+
                                  ' <td>'+value.totalpago+'</td>'+
                                  ' <td>'+value.observacion+'</td>'+  
                                  '<td>'+value.nombre_profesor+' '+value.apellidopaterno+' '+value.apellidomaterno+'</td>'+
                                  // ' <td>'+
                                  //   // '<a href="/proyecto/public/profesor/' + value.id + '/edit" method="post" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>' +
                                  //   '<a href="/proyecto/public/profesor/' + value.id + '/" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+
                                  // ' </td>'+
                              ' </tr>'
                          );
                          //alert(value.id);
                          sueldoproreporte.push(encontrarListaPorId(value.id)); //añadiendo elemtos a la nueva variable
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
      $('#sueldomin').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#sueldomax').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#todesmin').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#todesmax').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#topamin').on('input', function() {
       // alert($(this).val())
         $('#fechainicio').trigger('change');
      });
      $('#topamax').on('input', function() {
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
