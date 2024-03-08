@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">LISTA DE DATOS REPORTE SECRETARIAS</h3>
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
                                <label class="text-primary text-capitalize">ci</label>
                                <input type="text" name="ci" id="ci" class="form-control">
                              </div>
                              <div class="col">
                                <label class="text-primary text-capitalize">nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                              </div>
                              <div class="col">
                                <label class="text-primary text-capitalize">apellido paterno</label>
                                <input type="text" name="apellidopaterno" id="apellidopaterno" class="form-control">
                              </div>
                              <div class="col">
                                <label class="text-primary text-capitalize">apellido materno</label>
                                <input type="text" name="apellidomaterno" id="apellidomaterno" class="form-control">
                              </div>
                                <div class="col text-right">
                                  <button class="btn btn-danger btn-sm" type="button" onclick="generarpdflistaprofesor()"><i class="fas fa-print"></i>imprimir</button>
                                  <a href="{{url('opciones-reportesecre')}}" class="btn btn-sm btn-success text-capitalize" >
                                      <i class="fas fa-plus-circle"></i>
                                      regresar</a>
                                </div>  
                      </div>
                      <div class="row">
                        <div class="col">
                            <label class="text-primary text-capitalize">celular</label>
                            <input type="text" name="celular" id="celular" class="form-control" >
                            <span class="text-muted"></span>
                        </div>
                        <div class="col">
                            <label class="text-primary text-capitalize">direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control">
                            <span class="text-muted"></span>
                        </div>
                        <div class="col">
                          <label class="text-primary text-capitalize">email</label>
                          <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="col">
                          <label class="text-primary text-capitalize">estado</label>
                          <select type="text" name="estado" id="estado" class="form-control">
                            <option value="">ambos</option> 
                            <option value="activo">activo</option> 
                            <option value="inactivo">inactivo</option> 
                            </select>
                        </div>
                        <div class="col">
                          <label class="text-primary text-capitalize">sueldo</label>
                          <input type="text" name="sueldomin" id="sueldomin" class="form-control">
                          <span class="text-muted">minimo</span>
                        </div>
                        <div class="col">
                          <label class="text-primary text-capitalize"></label>
                          <input type="text" name="sueldomax" id="sueldomax" class="form-control">
                          <span class="text-muted">maximo</span>
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
                              <option value="celular">celular</option> 
                              <option value="direccion">direccion</option> 
                              <option value="email">email</option> 
                              <option value="estado">estado</option> 
                              <option value="sueldo">sueldo</option> 
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
        <style>
      .img-custom {
        width: 50px;
        height: 50px;
      }
        </style>
        <div class="table-responsive">
          <!-- Projects table -->
          <table id="tabla" class="table align-items-center table-flush" >
            <thead class="thead-light">
              <tr>
                <th scope="col" data-column="id" class="sortable">Id</th>
                <th scope="col" data-column="fechadeingreso" class="sortable">Fecha de Ingreso</th>
                <th scope="col" data-column="ci" class="sortable">Ci</th>
                <th scope="col" data-column="nombre" class="sortable">Nombre</th>
                <th scope="col" data-column="apellidopaterno" class="sortable">Apellido Paterno</th>
                <th scope="col" data-column="apellidomaterno" class="sortable">Apellid Materno</th>
                <th scope="col" data-column="celular" class="sortable">Celular</th>
                <th scope="col" data-column="direccion" class="sortable">Direccion</th>
                <th scope="col" data-column="correo" class="sortable">Correo</th>
                <th scope="col" data-column="estado" class="sortable">Estado</th>
                <th scope="col">Imagen</th>
                <th scope="col" data-column="sueldo" class="sortable">Sueldo</th>
                <th scope="col">Rol</th>
              </tr>
            </thead>
            <tbody id="tabla_profe">
              @foreach ($secretarias as $secretaria)
                        <tr>
                            <td scope="row">{{ $secretaria->id }}</td>
                            <td>{{ $secretaria->fechadeingreso }}</td>
                            <td>{{ $secretaria->ci }}</td>
                            <td>{{ $secretaria->nombre }}</td>
                            <td>{{ $secretaria->apellidopaterno }}</td>
                            <td>{{ $secretaria->apellidomaterno }}</td>
                            <td>{{ $secretaria->celular }}</td>
                            <td>{{ $secretaria->direccion }}</td>
                            <td>{{ $secretaria->user->email }}</td>
                            <td>{{ $secretaria->estado }}</td>
                            <td>
                            <img src="{{ asset('storage').'/'.$secretaria->imagen}}" alt="" class="img-thumbnail img-fluid img-custom">
                            </td>
                            <td>{{ $secretaria->sueldo }}</td>
                            <td>{{ $secretaria->user->role }}</td>
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
  var secreprosData = {!! json_encode($secretarias) !!};
 var secretariareporte =  {!! json_encode($secretarias) !!};
 function encontrarListaPorId(idLista) {
   return secreprosData.find(item => item.id === idLista);
 }
function generarpdflistaprofesor() {
 // Reemplazar las URLs de las imágenes con las imágenes en base64 en la lista profesorreporte
 var totalImages = secretariareporte.length;
 var imagesProcessed = 0;

secretariareporte.forEach(function (secretaria) {
   var img = new Image();
   img.crossOrigin = 'Anonymous';
   img.onload = function () {
     var canvas = document.createElement('canvas');
     var ctx = canvas.getContext('2d');
     canvas.width = img.width;
     canvas.height = img.height;
     ctx.drawImage(img, 0, 0, img.width, img.height);
     var dataURL = canvas.toDataURL('image/jpeg'); // Cambiar a 'image/png' si es necesario

     // Actualizar la URL de la imagen con la imagen en base64
     secretaria.ruta_imagen = dataURL;

     imagesProcessed++;
     if (imagesProcessed === totalImages) {
       // Una vez que todas las imágenes se hayan procesado, generar el PDF
       generarPDF();
     }
   };

   img.src = secretaria.ruta_imagen;
 });
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
     { text: 'Lista de Secretarias', 
       //style: 'header'
      },
      {
     text: "Fecha: " + formattedDate,
     alignment: "right",
     margin: [0, 0, 0, 10],
      },
     {
       table: {

         headers: ['Fechadeingreso', 'ci', 'nombre', 'apellidopaterno','apellidomaterno','celular','direccion','correo','estado','imagen','sueldo','role'],
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
   "reporte_lista_de_secretarias-" + formattedDate + ".pdf"
 );s
}

function obtenerDatosTabla() {
 // Obtener los datos de la tabla a partir de la lista profesorreporte (con las URLs de las imágenes convertidas a base64)
 var filas = [];
 var headers= [ 'Fechadeingreso', 'ci', 'nombre', 'apellidopaterno','apellidomaterno','celular','direccion','correo','estado','imagen','sueldo','role'];
 filas.push(headers);
 secretariareporte.forEach(function (secretaria) {
   var fila = [
    // profesor.id,
    secretaria.fechadeingreso,
    secretaria.ci,
    secretaria.nombre,
    secretaria.apellidopaterno,
    secretaria.apellidomaterno,
    secretaria.celular,
    secretaria.direccion,
    secretaria.email,
    secretaria.estado,
     { image: secretaria.ruta_imagen, width: 50, height: 50 }, // Mostrar la imagen en base64 en la tabla
     secretaria.sueldo,
     secretaria.role,
   ];
   filas.push(fila);
 });
 return filas;
}
</script>

<script>
    $(document).ready(function() {
      var estiloOriginal = $('#nombre').css('border');

      // Cuando se produzca el evento 'click' en cualquier input
      $('input').on('click', function() {
        // Restaurar el estilo original del borde en el input "nombre"
        $('#ci').css('border', estiloOriginal),$('#nombre').css('border', estiloOriginal);$('#apellidopaterno').css('border', estiloOriginal),
        $('#apellidomaterno').css('border', estiloOriginal),$('#celular').css('border', estiloOriginal);$('#direccion').css('border', estiloOriginal),
        $('#email').css('border', estiloOriginal);$('#estado').css('border', estiloOriginal);$('#sueldomin').css('border', estiloOriginal);$('#sueldomax').css('border', estiloOriginal);
        $('#ordenar').css('border', estiloOriginal);$('#mayorymenor').css('border', estiloOriginal);
      });

        $('#fechainicio').on('change', function() {

            var fecha_ini = $(this).val(); 
            var fecha_fin = $('#fechafinal').val();
            var ci = $('#ci').val();  
            var nombre = $('#nombre').val();  
            var apellidopaterno = $('#apellidopaterno').val(); 
            var apellidomaterno = $('#apellidomaterno').val(); 
            var celular = $('#celular').val(); 
            var direccion = $('#direccion').val(); 
            var email = $('#email').val(); 
            var estado = $('#estado').val();  
            var sueldomin = $('#sueldomin').val();
            var sueldomax = $('#sueldomax').val();
            var ordenar = $('#ordenar').val();
            var mayorymenor = $('#mayorymenor').val();
            generartabla(fecha_ini,fecha_fin,ci,nombre,apellidopaterno,apellidomaterno,celular,direccion,email,estado,sueldomin,sueldomax,ordenar,mayorymenor);      
          //  alert(ordenar+mayorymenor);
        });

        function generartabla(fecha_ini,fecha_fin,ci,nombre,apellidopaterno,apellidomaterno,celular,direccion,email,estado,sueldomin,sueldomax,ordenar,mayorymenor) {
              $.ajax({
                    url: '{{ url("obtener-fechainiciosecre") }}', // Ruta a tu controlador Laravel
                    type: 'POST',
                    data: {
                        fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                        fechafinal: fecha_fin,
                        cisecre: ci,// Enviar el ID del aula seleccionada
                        nombresecre:nombre,
                        apellidopaternosecre:apellidopaterno,
                        apellidomaternosecre:apellidomaterno,
                        celularsecre:celular,
                        direccionsecre:direccion,
                        emailsecre:email,
                        estadosecre:estado,
                        sueldominsecre:sueldomin,
                        sueldomaxsecre:sueldomax,
                        ordenarsecre:ordenar,
                        mayorymenorsecre:mayorymenor,
                      // profesor_id: profesorId,
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                    },
                    success: function(response) {
                        
                  
                        // Limpiar el campo de selección de periodos
                        $('#tabla_profe').empty();
                        secretariareporte=[];

                        $.each(response, function(key, value) {
                            // alert(value.id)
                            $('#tabla_profe').append(
                                '<tr>'+
                                ' <td>'+value.id+'</td>'+
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
                                    ' <td>'+value.role+'</td>'+
                                ' </tr>'
                            );
                            //alert(value.id);
                            secretariareporte.push(encontrarListaPorId(value.id)); //añadiendo elemtos a la nueva variable
                          //  $('#miadelanto').find('td').css('border', '1px solid black');
                        });
                    }
                });
        }
        $('#fechafinal').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#ci').on('input', function() {
         // alert($(this).val())
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
           $(this).val($(this).val().replace(/[^\d]/g, ''));
        });
        $('#nombre').on('input', function() {
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
           $(this).val($(this).val().replace(/[^a-zA-Z]/g, ''));
        });
        $('#apellidopaterno').on('input', function() {
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#apellidomaterno').on('input', function() {
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#celular').on('input', function() {
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#direccion').on('input', function() {
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#email').on('input', function() {
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#estado').on('input', function() {
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#sueldomin').on('input', function() {
         // alert($(this).val())
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#sueldomax').on('input', function() {
         // alert($(this).val())
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#ordenar').on('change', function() {
         // alert($(this).val())
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        $('#mayorymenor').on('change', function() {
         // alert($(this).val())
           $('#fechainicio').trigger('change');$(this).css('border', '3px solid #0000ff');
        });
        //evento keydown
          // Evento 'keydown' para el input con id "nombre"
          $('#nombre').on('keydown', function(event) {
            // Obtener el código de la tecla presionada
            var keyCode = event.keyCode || event.which;
             // Permitir las teclas "Borrar" (Eliminar o Backspace)
              if (keyCode === 8) {
                return true;
              }
             // Verificar si el código de la tecla corresponde a una letra del alfabeto (mayúscula o minúscula)
            if ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122)) {
              // Permitir que la tecla se refleje en el valor del input (es una letra)
              return true;
            } else {
              // Bloquear todas las demás teclas (no es una letra)
              event.preventDefault();
              return false;
            }
          });
          // Evento 'keydown' para el input con id "ci"
          $('#ci').on('keydown', function(event) {
            // Obtener el código de la tecla presionada
            var keyCode = event.keyCode || event.which;

            // Permitir las teclas "Borrar" (Eliminar o Backspace)
            if (keyCode === 8) {
              return true;
            }

            // Verificar si el código de la tecla corresponde a un número (0-9)
            if ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105)) {
              // Permitir que la tecla se refleje en el valor del input (es un número)
              return true;
            } else {
              // Bloquear todas las demás teclas (no es un número ni la tecla "Borrar")
              event.preventDefault();
              return false;
            }
          });
    });
</script>

@endsection

