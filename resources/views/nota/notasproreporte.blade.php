@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">LISTA DE PROMEDIOS DE LOS ALUMNOS REPORTE  <label > {{ $usuario[0]->nombre.'-'.$usuario[0]->apellidopaterno.'-'.$usuario[0]->apellidomaterno }} </label></h3>
              <input id="nombreprofesor" class="d-none" value=" {{ $usuario[0]->nombre.'-'.$usuario[0]->apellidopaterno.'-'.$usuario[0]->apellidomaterno }}" >
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
                        <div class="col">
                          <label class="text-primary text-capitalize">estado</label>
                          <select type="text" name="estado" id="estado" class="form-control">
                            <option selected  value="">ambos</option>
                            <option value="activo">activo</option> 
                            <option value="inactivo">inactivo</option> 
                            </select>
                        </div>
                      <div class="col text-right">
                        <button class="btn btn-danger btn-sm" type="button" onclick="generarpdflistaprofesor()"><i class="fas fa-print"></i>Imprimir</button>
                        <a href="{{url('home')}}" class="btn btn-sm btn-success" >
                        <i class="fas fa-plus-circle"></i>
                        Regresar</a>
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
                    <label class="text-primary text-capitalize">promedio</label>
                      <div class="input-group">
                            <input type="numeber" name="promin" id="promin" class="form-control" placeholder="desde">   
                            <input type="numeber" name="promax" id="promax" class="form-control" placeholder="hasta">   
                      </div>
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
                        <option value="promedio_notas">promedio</option> 
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
                <th scope="col">fecha de ingreso</th>
                <th scope="col">ci</th>
                <th scope="col">nombre</th>
                <th scope="col">apellido paterno</th>
                <th scope="col">apellido materno</th>
                <th scope="col">materia</th>
                <th scope="col">promedio</th>
                {{-- <th scope="col">materia costo</th> --}}
                <th scope="col">periodo</th>
                <th scope="col">aula</th>
                <th scope="col">estado</th>
                <th scope="col">imagen</th>
                <th scope="col">acciones</th>
              </tr>
            </thead>
            <tbody id="tabla_asigre">
            @if(isset($alumnos) && count($alumnos) > 0)
              @foreach ($alumnos as $alumno)
                        <tr>
                            {{-- <td scope="row">{{ $alumno->id }}</td>--}}
                            <td>{{ $alumno->fechadeingreso }}</td> 
                            <td>{{ $alumno->ci }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellidopaterno }}</td>
                            <td>{{ $alumno->apellidomaterno }}</td>
                            <td>{{ $alumno->materia }}</td>
                            @if (!$alumno->promedio_notas)
                              <th >0</th>
                              @else
                              <th >{{ $alumno->promedio_notas }}</th>
                            @endif
                            {{-- <td>{{ $alumno->costo }}</td> --}}
                            <td>{{ $alumno->periodo }}</td>
                            <td>{{ $alumno->aula }}</td>
                            <td>{{ $alumno->asignarpromas_estado }}</td>
                            <td>
                            <img src="{{ asset('storage').'/'.$alumno->imagen}}" alt=""  width="50px" height="50px"  class="img-thumbnail img-fluid">
                            </td>
                            <td>
<button onclick="cargaridnotas('{{ $alumno->alumnoid }}','{{ $alumno->materiaid }}','{{ $alumno->nombre }}','{{ $alumno->apellidopaterno }}','{{ $alumno->apellidomaterno }}','{{ $alumno->materia }}')" 
 data-toggle="modal" data-target="#myModal3"  id="bonota" class="btn btn-sm btn-info"><i class="far fa-file-alt"></i></button>
                            {{-- <a href="{{ url('/alumno/'.$alumno->id.'/') }}" method="post" class="btn btn-sm btn-danger">
                              <i class="far fa-eye"></i></a>     
                              <a href="{{ url('/alumno/'.$alumno->id.'/edit') }}" method="post" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i></a>          --}}
                            </td>
                        </tr>
                        @endforeach
            @else
            <tr>
            <td colspan="12">No hay alumnos disponibles.</td>
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
     var profeprosData = {!! json_encode($alumnos) !!};
    var profesorreporte =  {!! json_encode($alumnos) !!};
    function encontrarListaPorId(idLista) {
      return profeprosData.find(item => item.id === idLista);
    }
   function generarpdflistaprofesor() {
    // Reemplazar las URLs de las imágenes con las imágenes en base64 en la lista profesorreporte
    var totalImages = profesorreporte.length;
    var imagesProcessed = 0;
   
    profesorreporte.forEach(function (alumno) {
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
        alumno.ruta_imagen = dataURL;
   
        imagesProcessed++;
        if (imagesProcessed === totalImages) {
          // Una vez que todas las imágenes se hayan procesado, generar el PDF
          generarPDF();
        }
      };
   
      img.src = alumno.ruta_imagen;
    });
   }
   
   function generarPDF() {
 
    var currentDate = new Date();
   var formattedDate = currentDate.toISOString().slice(0, 10);
   var nombreprofesor = $('#nombreprofesor').val();
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
        { text: 'Lista de Promedios de los alumnos', 
          //style: 'header'
         },
         {
        text: "Fecha: " + formattedDate + "secre" + nombreprofesor , 
        alignment: "right",
        margin: [0, 0, 0, 10],
         },
        {
          table: {
   
            headers: ['Fecha de ingreso', 'ci', 'nombre', 'apellido paterno','apellido materno','materia','promedio','periodo','aula','estado','imagen'],
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
      "reporte_promedio_alumnos-"+ nombreprofesor + "-" + formattedDate + ".pdf"
    );
   }
   
   function obtenerDatosTabla() {
    // Obtener los datos de la tabla a partir de la lista profesorreporte (con las URLs de las imágenes convertidas a base64)
    var filas = [];
    var headers= [ 'Fecha de ingreso', 'ci', 'nombre', 'apellido paterno','apellid materno','materia','promedio','periodo','aula','estado','imagen'];
    filas.push(headers);
    profesorreporte.forEach(function (alumno) {
     var promedio=alumno.promedio_notas;
    // debugger;
     if(promedio==null)
       {
         promedio=0;
       }
      var fila = [
       // profesor.id,
       alumno.fechadeingreso,
       alumno.ci,
       alumno.nombre,
       alumno.apellidopaterno,
       alumno.apellidomaterno,
       alumno.materia,
       promedio,
       alumno.periodo,
       alumno.aula,
       alumno.asignarpromas_estado,
        { image: alumno.ruta_imagen, width: 50, height: 50 }, // Mostrar la imagen en base64 en la tabla
      ];
      filas.push(fila);
    });
    return filas;
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
            var profesorid = $('#profesor_id').val();
            var materiaid = $('#materia_id').val();
            var periodoid = $('#periodo_id').val();
            var aulaid = $('#aula_id').val();  
            var alumno_nombre = $('#alumno_nombre').val();
            var alumno_apepa = $('#alumno_apepa').val();
            var alumno_apema = $('#alumno_apema').val();
            var promin = $('#promin').val();
            var promax = $('#promax').val();
            var estado = $('#estado').val();  
            var ordenar = $('#ordenar').val();
            var mayorymenor = $('#mayorymenor').val();
            //alert(promin)
            generartabla(fecha_ini,fecha_fin,profesorid,materiaid,periodoid,aulaid,alumno_nombre,alumno_apepa,alumno_apema,promin,promax,estado,ordenar,mayorymenor); 
           
        });
        function generartabla(fecha_ini,fecha_fin,profesorid,materiaid,periodoid,aulaid,alumno_nombre,alumno_apepa,alumno_apema,promin,promax,estado,ordenar,mayorymenor) {
              $.ajax({
                    url: '{{ url("obtener-fechainicionotaprofe") }}', // Ruta a tu controlador Laravel
                    type: 'POST',
                    data: {
                        fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                        fechafinal: fecha_fin,
                        profesorid: profesorid,// Enviar el ID del aula seleccionada
                        materiaid: materiaid,
                        periodoid: periodoid,
                        aulaid: aulaid,
                        alumno_nombre:alumno_nombre,
                        alumno_apepa:alumno_apepa,
                        alumno_apema:alumno_apema,
                        promin:promin,
                        promax:promax,
                        estado: estado,
                        ordenarasig:ordenar,
                        mayorymenorasig:mayorymenor,
                      // profesor_id: profesorId,
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                      
                    },
                    success: function(response) {
                        // Limpiar el campo de selección de periodos
                        $('#tabla_asigre').empty();
                       profesorreporte=[];
                        $.each(response, function(key, value) {
                            // alert(value.id)
                            var imagen='{{asset('storage').'/'}}';
                            var promedio=0;
                            if(value.promedio_notas){
                              promedio=value.promedio_notas;
                            }
                            $('#tabla_asigre').append(
                                '<tr>'+
                                // ' <td>'+value.id+'</td>'+
                                    '<td>'+value.fechadeingreso+'</td>'+
                                    '<td>'+value.ci+'</td>'+
                                    ' <td>'+value.nombre+'</td>'+
                                    '<td>'+value.apellidopaterno+'</td>'+
                                    '<td>'+value.apellidomaterno+'</td>'+
                                    ' <td>'+value.materia_nombre+'</td>'+
                                    ' <td>'+promedio+'</td>'+
                                    ' <td>'+value.periodo_nombre+'</td>'+
                                    ' <td>'+value.aula_nombre+'</td>'+
                                    ' <td>'+value.nombre_estado+'</td>'+
                                    ' <td><img src="'+imagen+value.imagen+'" alt=""  width="50px"  height="50px" class="img-thumbnail img-fluid"></td>'+
                                   // ' <td>'+value.role+'</td>'+
                                    ' <td>'+
 '<button onclick="cargaridnotas('+ value.alumnoid +','+ value.materiaid +',\''+ value.nombre +'\',\''+ value.apellidopaterno +'\',\''+ value.apellidomaterno +'\',\''+ value.materia_nombre +'\',\''+ value.profesor_nombre +'\',\''+ value.profesors_paterno +'\',\''+ value.profesor_materno +'\') " data-toggle="modal" data-target="#myModal3"  id="bonota" class="btn btn-sm btn-info"><i class="far fa-file-alt"></i></button>'+                                    
 ' </td>'+

//                                       // '<a href="/proyecto/public/asignacion/' + value.id + '/show" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+
                                    ' </td>'+
                                ' </tr>'
                            );
                            //alert(value.id);
                           profesorreporte.push(encontrarListaPorId(value.id)); //añadiendo elemtos a la nueva variable
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
        $('#alumno_nombre').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#alumno_apepa').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#alumno_apema').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#promin').on('input', function() {
           $('#fechainicio').trigger('change');
        });
        $('#promax').on('input', function() {
           $('#fechainicio').trigger('change');
        });
        $('#estado').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#ordenar').on('change', function() {
           $('#fechainicio').trigger('change');
        });
        $('#mayorymenor').on('change', function() {
           $('#fechainicio').trigger('change');
        });

    });
function redondearAUnDecimal(numero) {
            return Math.round(numero * 10) / 10;
            }
    function cargaridnotas(alumnoid,materiaid,nombre,apellidopaterno,apellidomaterno,nombre_materia,profesor_nombre,profesor_apellidopaterno,profesor_apellidomaterno) {
            $('#alumno1').val(nombre+' '+apellidopaterno+' '+apellidomaterno);
            $('#profesor1').val('{{ $usuario[0]->nombre.'-'.$usuario[0]->apellidopaterno.'-'.$usuario[0]->apellidomaterno }} ');
            $('#materia1').val(nombre_materia);
        // alert(alumnoid+'-'+materiaid)
    $.ajax({
                url: '{{ url("obtener-notasdelalumnoid") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                    alumnoid: alumnoid,
                    materiaid: materiaid,
                    
                    // profesor_id: profesorId,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                    
                  
                    // Limpiar el campo de selección de periodos
                    $('#tabla_nota').empty();
                    // profesorreporte=[];
                    var sumanota =0;var connota=0;
                    $.each(response, function(key, value) {
                        // alert(value.id)
                        $('#tabla_nota').append(
                            '<tr id="nota'+value.id+'">'+
                            // ' <td>'+value.id+'</td>'+
                                '<td>'+value.fechadenota+'</td>'+
                                '<td>'+value.nombre_actividad+'</td>'+
                                ' <td >'+value.nota+'</td>'+ 
                             
                            ' </tr>'
                        );
                        //alert(value.id);
                        // profesorreporte.push(encontrarListaPorId(value.id)); //añadiendo elemtos a la nueva variable
                        // $('#miadelanto').find('td').css('border', '1px solid black');
                        sumanota=sumanota+value.nota; connota++;
                    });
                    $('#sumanota').val(sumanota);
                    $('#cannota').val(connota);
                    $('#promedio').val(redondearAUnDecimal(sumanota/connota));

                    $('.cambionota').on('input', function() {
                       // Obtener el contenido actual
                        var contenido = $(this).text();
                        
                        // Eliminar caracteres no numéricos
                        var numeros = contenido.replace(/[^0-9.]/g, '');
                        
                        // Actualizar el contenido editable con solo números
                        $(this).text(numeros);
                        var siguienteFila = $(this).closest('td').next();
                        var botonDeshabilitado = siguienteFila.find('button[disabled]');
                        botonDeshabilitado.prop('disabled', false);
                    });
                },

                // error: function (xhr, status, error) {
                // console.error('Error en la solicitud:', error);
                // }
     });
        
        
}
  </script>
@endsection
<!--empeiza el modal-->
<div class="modal fade " id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content p-3 mb-2 bg-info">
           <div class="modal-body ">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                      <span aria-hidden="true">&times;</span>
                  </button>
                <div class="card shadow p-3 mb-2 ">
                {{-- <div class="card shadow p-3 mb-2 bg-info"> ESE BG-INFO PONE COLOR TRANS--}}
                           <div class="card-header border-0">
                                  <div class="row align-items-center">
                                      <div class="col">
                                        <h3 class="mb-0">LISTA DE NOTAS</h3>
                                        <div class="row">
                                              <div class="col">
                                              <input type="text" name="sumanota" id="sumanota" class="form-control" placeholder="suma notas" disabled>
                                              <snap class="text-sm">SUMA DE NOTAS</snap>
                                              </div>
                                              <div class="col">
                                              <input type="text" name="cannota" id="cannota" class="form-control" placeholder="can-notas" disabled>
                                              <snap class="text-sm">CANTIDAD DE NOTAS</snap>
                                              </div>
                                              <div class="col">
                                                  <input type="text" name="promedio" id="promedio" class="form-control" placeholder="promedio" disabled>
                                                  <snap class="text-sm">promedio</snap>
                                              </div>   
                                              <div class="col">
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col">
                                                  <input type="text" name="alumno1" id="alumno1" class="form-control" placeholder="suma notas"  disabled>
                                                  <snap class="text-sm">alumno</snap>
                                                  </div>
                                                  <div class="col">
                                                  <input type="text" name="profesor1" id="profesor1" class="form-control" 
                                                  value=" {{ $usuario[0]->nombre.'-'.$usuario[0]->apellidopaterno.'-'.$usuario[0]->apellidomaterno }}" disabled>
                                                  <snap class="text-sm">profesor</snap>
                                                  </div>
                                                  <div class="col">
                                                      <input type="text" name="materia1" id="materia1" class="form-control" placeholder="promedio" disabled>
                                                      <snap class="text-sm">materia</snap>
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
                                          <th>nota</th>
                                          {{-- <th>estado</th> --}}
                                      </tr>
                                  </thead>
                                  <tbody id="tabla_nota">
                                      {{-- @foreach ($notas as $nota)
                                      <tr>
                                          <td>{{ $nota->fechadenota}}</td>
                                          <td>{{ $nota->actividad_nombre}}</td>
                                          <td>{{ $nota->nota}}</td>
                                          <td>{{ $nota->estado}}</td>
                                         
                                      </tr>
                                      @endforeach --}}
                                  </tbody>
                              </table>
                          </div> 
                              <div class="col-12 col-sm-12 col-md-6">
                                  <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                      <div class="col-12 col-md-12 " >
                                      </div>
                                  </div>
                              </div>
               </div>
          </div>
      </div>
  </div>
</div>
    <!--filaliza el modal-->
