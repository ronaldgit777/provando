@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">LISTA DE ALUMNOS DEL PROFESOR <label>  {{ $usuario[0]->nombre.'-'.$usuario[0]->apellidopaterno.'-'.$usuario[0]->apellidomaterno }} </label>
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
                        <label class="text-primary text-capitalize">materia</label>
                        <select type="text" name="materia_id2" id="materia_id2" class="form-control" >
                          <option selected value="">seleccione la materia</option>
                          @foreach ($materias as $materia)
                          <option value="{{ $materia->materia }}">{{ $materia->materia}}</option>
                          @endforeach
                        </select>
                      {{-- <input type="text" name="materia_id" id="materia_id" class="form-control" > --}}
                      </div>
                      <div class="col">
                        <label class="text-primary text-capitalize">periodo</label>
                        <select type="text" name="periodo_id2" id="periodo_id2" class="form-control" >
                          <option selected value="">seleccione el periodo</option>
                          @foreach ($periodos as $periodo)
                          <option value="{{ $periodo->periodo }}">{{ $periodo->periodo}}</option>
                          @endforeach
                        </select>
                      {{-- <input type="text" name="materia_id" id="materia_id" class="form-control" > --}}
                      </div>
                      <div class="col">
                        <label class="text-primary text-capitalize">aula</label>
                        <select type="text" name="aula_id2" id="aula_id2" class="form-control" >
                          <option selected value="">seleccione la aula</option>
                          @foreach ($aulas as $aula)
                          <option value="{{ $aula->aula }}">{{ $aula->aula}}</option>
                          @endforeach
                        </select>
                      {{-- <input type="text" name="materia_id" id="materia_id" class="form-control" > --}}
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
                      <div class="col text-right">
                        {{-- <a href="{{url('home')}}" class="btn btn-sm btn-success" >
                        <i class="fas fa-plus-circle"></i>
                        regresar</a> --}}
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
                <th scope="col">materia</th>
                <th scope="col">periodo</th>
                <th scope="col">aula</th>
                <th scope="col">fechadeingreso</th>
                <th scope="col">ci</th>
                <th scope="col">nombre</th>
                <th scope="col">apellidopaterno</th>
                <th scope="col">apellidomaterno</th>
                <th scope="col">celular</th>
                <th scope="col">direccion</th>
                <th scope="col">correo</th>
                <th scope="col">estado</th>
                <th scope="col">imagen</th>
                <th scope="col">acciones</th>
              </tr>
            </thead>
            <tbody id="tabla_alu">
            @if(isset($alumnos) && count($alumnos) > 0)
              @foreach ($alumnos as $alumno)
                        <tr>
                            <td scope="row">{{ $alumno->nombre_materia }}</td>
                            <td scope="row">{{ $alumno->nombre_periodo }}</td>
                            <td scope="row">{{ $alumno->nombre_aula }}</td>
                            <td>{{ $alumno->fechadeingreso }}</td>
                            <td>{{ $alumno->ci }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellidopaterno }}</td>
                            <td>{{ $alumno->apellidomaterno }}</td>
                            <td>{{ $alumno->celular }}</td>
                            <td>{{ $alumno->direccion }}</td>
                            <td>{{ $alumno->correo }}</td>
                            <td>{{ $alumno->estado }}</td>
                            <td>
                            <img src="{{ asset('storage').'/'.$alumno->imagen}}" alt=""  width="50px" height="50px"  class="img-thumbnail img-fluid">
                            </td>
                            <td>
                            <button onclick="cargarid('{{ $alumno->id }}','{{ $alumno->materiaid }}')" data-toggle="modal" data-target="#myModal2"  id="bo" class="btn btn-sm btn-success"> 
                            <i class="far fa-file-alt"></i></button>
                            <button onclick="cargaridnotas('{{ $alumno->id }}','{{ $alumno->materiaid }}','{{ $alumno->nombre }}','{{ $alumno->apellidopaterno }}','{{ $alumno->apellidomaterno }}','{{ $alumno->nombre_materia }}')" 
                                data-toggle="modal" data-target="#myModal3"  id="bonota" class="btn btn-sm btn-info"> 
                                <i class="far fa-file-alt"></i></button>
                                <a href="{{ route('show2alu', ['id' => $alumno->id]) }}" class="btn btn-sm btn-danger">
                              <i class="far fa-eye"></i></a>     
                              {{-- <a href="{{ url('/alumno/'.$alumno->id.'/edit') }}" method="post" class="btn btn-sm btn-primary">
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


@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
   <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/pdfmake.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/vfs_fonts.js"></script>
   <script>
      //  var busquependiente=false; var buscarpendiente=false;
      $(document).ready(function() {
            $('#fechainicio').on('change', function() {
           //     console.log(buscarpendiente);
           // if(busquependiente==false){
                //busquependiente=true;
                var fecha_ini = $(this).val(); 
                //var user_id = $('#user_id').val();
                var fecha_fin = $('#fechafinal').val();
                var buscar = $('#buscar').val();  
                var materiaid = $('#materia_id2').val();  //alert(materiaid)  
                var aulaid = $('#aula_id2').val();
                var periodoid = $('#periodo_id2').val();
                generartabla(fecha_ini,fecha_fin,buscar,materiaid,aulaid,periodoid);  
            //}else{
                //buscarpendiente=true;
            
                //$('#fechainicio').trigger('change');
           // }
        
            
            });
            function generartabla(fecha_ini,fecha_fin,buscar,materiaid,aulaid,periodoid) {
                $.ajax({
                    url: '{{ url("obtener-fechainicioalumnosprofe") }}', // Ruta a tu controlador Laravel
                    type: 'POST',
                    data: {
                        fechainicio: fecha_ini, //lo de blanco es la llave q tienes para q se capture la variable
                        fechafinal: fecha_fin,
                        //user_id:user_id,
                        buscaralu: buscar,// Enviar el ID del aula seleccionada
                        materiaid: materiaid,
                        aulaid: aulaid,
                        periodoid:periodoid,
                        // profesor_id: profesorId,
                        _token: '{{ csrf_token() }}' // Agregar el token CSRF
                    },
                    success: function(response) {
                     
                      
                        // Limpiar el campo de selección de periodos
                        $('#tabla_alu').empty();
                        // profesorreporte=[];
                        $.each(response, function(key, value) {
                            // alert(value.id)
                            $('#tabla_alu').append(
                                '<tr>'+
                                // ' <td>'+value.id+'</td>'+
                                    '<td>'+value.nombre_materia+'</td>'+
                                    '<td>'+value.nombre_periodo+'</td>'+
                                    '<td>'+value.nombre_aula+'</td>'+
                                    '<td>'+value.fechadeingreso+'</td>'+
                                    ' <td>'+value.ci+'</td>'+
                                    ' <td>'+value.nombre+'</td>'+
                                    ' <td>'+value.apellidopaterno+'</td>'+
                                    ' <td>'+value.apellidomaterno+'</td>'+
                                    ' <td>'+value.celular+'</td>'+
                                    ' <td>'+value.direccion+'</td>'+
                                    ' <td>'+value.correo+'</td>'+
                                    ' <td>'+value.estado+'</td>'+
                                    ' <td><img src="'+value.ruta_imagen+'" alt=""  width="50px"  height="50px" class="img-thumbnail img-fluid"></td>'+
                                    // ' <td>'+value.role+'</td>'+
                                    ' <td>'+
'<button onclick="cargarid('+ value.alumnoid +','+ value.materiaid +')" data-toggle="modal" data-target="#myModal2" id="bo" class="btn btn-sm btn-success"> <i class="far fa-file-alt"></i></button>' +

'<button onclick="cargaridnotas('+ value.alumnoid +','+ value.materiaid +',\''+ value.nombre +'\',\''+ value.apellidopaterno +'\',\''+ value.apellidomaterno +'\',\''+ value.nombre_materia +'\',\''+ value.profesor_nombre +'\',\''+ value.profesors_paterno +'\',\''+ value.profesor_materno +'\') " data-toggle="modal" data-target="#myModal3"  id="bonota" class="btn btn-sm btn-info"><i class="far fa-file-alt"></i></button>'+                                    
'<a href="/proyecto/public/alumno/show2/' + value.alumnoid + '" method="post" class="btn btn-sm btn-danger"> <i class="far fa-eye"></i></a>'+ 


    
' </td>'+
                                        // '<a href="/proyecto/public/alumno/' + value.id + '/edit" method="post" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>' +
                                   
                                   
                                ' </tr>'
                            );
                          //  alert(value.materiaid);
                            // profesorreporte.push(encontrarListaPorId(value.id)); //añadiendo elemtos a la nueva variable
                            // $('#miadelanto').find('td').css('border', '1px solid black');
                        });
                        // if(buscarpendiente==true){
                        //     buscarpendiente=false;
                        //     $('#fechainicio').trigger('change');
                        // }
                    },

                    // error: function (xhr, status, error) {
                    // console.error('Error en la solicitud:', error);
                    // }
                });
            }
            $('#fechafinal').on('change', function() {
            $('#fechainicio').trigger('change');
            });
            $('#buscar').on('input', function() {
            $('#fechainicio').trigger('change');
            });
            $('#materia_id2').on('change', function() {
            $('#fechainicio').trigger('change');
            });
            $('#aula_id2').on('change', function() {
            $('#fechainicio').trigger('change');
            });
            $('#periodo_id2').on('change', function() {
            $('#fechainicio').trigger('change');
            });
       
    });

       function confirmareliminarnota(notaid,nota) {
      //  debugger;
               //alert(notaid);

               $('#eliminar_notaid').val(notaid); //obtener id del profesor
                $('#confirmarModal2').modal('show');
                
                $('#vernotaeliminada').text(nota); 
            }
            function eliminarnota() {
      //  debugger;
                var notaid =$('#eliminar_notaid').val(); //obtener id del profesor
               //alert(notaid);

               $.ajax({
                url: '{{ url("obtener-eliminarnotaid") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                    notaid: notaid,
                    
                    // profesor_id: profesorId,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                  //  alert('se edito correctamente');
                   $('#confirmarModal2').modal('hide');
                   $('#nota'+notaid).remove();
                   //$(".botoneditarnota").prop("disabled", true); 
                },

                // error: function (xhr, status, error) {
                // console.error('Error en la solicitud:', error);
                // }
                });
            }

    function confirmareditarnota(notaid,botoneditar) {
      //  debugger;
      
                var anteriorcolumna = $(botoneditar).closest('td').prev();
                var input=anteriorcolumna.find('input');
                var nota = input.val();
               //alert(notaid);
               $('#nota_id').val(notaid); //obtener id del profesor
                $('#nota').val(nota); //obtener id del profesor
                $('#confirmarModal').modal('show');
                $('#vernotaeditada').text(nota); 
            }


      function editarnota() {
      //  debugger;
                var notaid =$('#nota_id').val(); //obtener id del profesor
                var nota =$('#nota').val(); //o
               //alert(notaid);

               $.ajax({
                url: '{{ url("obtener-editarnota") }}', // Ruta a tu controlador Laravel
                type: 'POST',
                data: {
                    notaid: notaid,
                    nota: nota,
                    
                    // profesor_id: profesorId,
                    _token: '{{ csrf_token() }}' // Agregar el token CSRF
                },
                success: function(response) {
                  //  alert('se edito correctamente');
                   $('#confirmarModal').modal('hide');

                   $(".botoneditarnota").prop("disabled", true); 
                },

                // error: function (xhr, status, error) {
                // console.error('Error en la solicitud:', error);
                // }
                });
            }
           



     function cargarid(alumnoid,materiaid) {    

            var selectElement = document.getElementById('alumno_id'); // Obtener el elemento select
            var selectElementmateriaid = document.getElementById('materia_id'); 
            $('#materia2').val(materiaid); 
            $('#alumno2').val(alumnoid); 
            var options = selectElement.options; // Obtener todas las opciones del select
            var optionsmateriaid = selectElementmateriaid.options; 
           // debugger;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value == alumnoid) {
                options[i].selected = true; // Seleccionar la opción si coincide con el valor
                }
            }
            for (var i = 0; i < optionsmateriaid.length; i++) {
                if (optionsmateriaid[i].value == materiaid) {
                    optionsmateriaid[i].selected = true; // Seleccionar la opción si coincide con el valor
                }
            }
            
         }
         
         function redondearAUnDecimal(numero) {
            return Math.round(numero * 10) / 10;
            }
         function cargaridnotas(alumnoid,materiaid,nombre,apellidopaterno,apellidomaterno,nombre_materia) {
            $('#alumno1').val(nombre+' '+apellidopaterno+' '+apellidomaterno);
            $('#materia1').val(nombre_materia);
         
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
                                ' <td > <input type="number" class="cambionota" value="'+value.nota+'" >     </input></td>'+ 
                                '<td>'+
                     '<button onclick="confirmareditarnota('+value.id+',this)"  id="botonnota" class="btn btn-sm btn-primary botoneditarnota" disabled> <i class="far fa-file-alt"></i></button>' +
                     '<button onclick="confirmareliminarnota('+value.id +','+value.nota+')"  id="botoneli" class="btn btn-sm btn-danger"> <i class="far fa-trash-alt"></i></button>' +
                                 '</td>'+
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
  <!--empeiza el modal-->
  <div class="modal fade " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg " role="document">
          <div class="modal-content p-3 mb-2 bg-info">
               <div class="modal-body">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    <div class="card shadow p-3 mb-2 bg-info text-blue">
                              <div class="card-header border-0">
                                  <div class="row align-items-center">
                                      <div class="col">
                                          <h3 class="mb-0">REGISTRAR NOTA</h3>
                                      </div>
                                        <?php $fcha = date("Y-m-d"); ?>
                                        <form method="post" action="{{ url('/notamodal')}}" enctype="multipart/form-data">
                                        @csrf   
                                        <input type="text"  id="materia2"  name="materia_id" class="d-none"  value=""  readonly> 
                                        <input type="text"  id="alumno2"  name="alumno_id" class="d-none"  value=""  readonly> 
                                        {{-- <input type="text"  id="asignarproma_id"  name="asignarproma_id" class="d-none"  value=""  readonly>  --}}
                                            <div class="row p-3 mb-2  text-blue">
                                                <div class="col-12"> 
                                                    <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                                                        <div class="form-group m-form__group row">
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">fecha de nota</label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <input class="form-control" placeholder="fechadenota" type="date" name="fechadenota"   id="fechadenota" value="<?php echo $fcha; ?>" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">actividad </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                          
                                                                            <select type="text"  id="actividad_id"  name="actividad_id" class="form-control" required>
                                                                                <option selected disabled value="">seleccione la actividad</option>
                                                                                @foreach ($actividads as $actividad)
                                                                                <option value="{{ $actividad->id }}">{{$actividad->actividad}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">materia </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <select type="text"  id="materia_id" name="materia_id"  class="form-control" required disabled>
                                                                                <option selected disabled value="">seleccione la materia</option>
                                                                                @foreach ($materias as $materia)
                                                                                <option value="{{ $materia->id }}">{{ $materia->materia}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">nota </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">    
                                                                            <input class="form-control" placeholder="nota" id="nota" type="text" name="nota" 
                                                                            value="{{ old('nota') }}" required autocomplete="nota" autofocus oninput="validateInputnota()">
                                                                            <span id="nota-error" style="color: red; font-size: 14px;"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">alumno</label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <select type="text" name="alumno_id" id="alumno_id" class="form-control" required disabled>
                                                                                <option selected disabled value="">seleccione el alumno</option>
                                                                                @foreach ($alumnos as $alumno)
                                                                                <option value="{{ $alumno->id }}">{{ $alumno->nombre."-".$alumno->apellidopaterno."-".$alumno->apellidomaterno }}</option>
                                                                                @endforeach
                                                                            </select> 
                                                                        </div>
                                                                    </div>
                                                                </div>                  
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">estado </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            {{-- <select type="text" name="estado" id="estado" class="form-control" required>
                                                                                <option value="activo">activo</option> 
                                                                                <option value="inactivo">inactivo</option> 
                                                                                </select><br> --}}
                                                                                <input type="text" name="estado" id="estado" class="form-control" required value="activo" readonly> <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize"></label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <center><input type="submit" value="guardar datos" class="btn btn-primary"></center>
                                                                              
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </form>
                                  </div>
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
<script>
function validateInputnota() {
    var inputElement = document.getElementById('nota');
    var errorElement = document.getElementById('nota-error');
    var regex = /[^0-9]/g;
    
    if (regex.test(inputElement.value)) {
        errorElement.textContent = "Solo se deben ingresar números en este campo.";
        inputElement.value = inputElement.value.replace(regex, '');
    }  else if (inputElement.value.length > 5) {
        errorElement.textContent = "Máximo 5 dígitos permitidos.";
        inputElement.value = inputElement.value.slice(0, 5);
    } else {
        errorElement.textContent = ""; // Limpiar el mensaje de error si es válido
    }
}
</script>
<!--filaliza el modal-->
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
                                                    <snap class="text-sm">PROMEDIO</snap>
                                                </div>   
                                                <div class="col">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" name="alumno1" id="alumno1" class="form-control" placeholder="suma notas"  disabled>
                                                    <snap class="text-sm">ALUMNO</snap>
                                                    </div>
                                                    <div class="col">
                                                    <input type="text" name="profesor1" id="profesor1" class="form-control" 
                                                    value=" {{ $usuario[0]->nombre.'-'.$usuario[0]->apellidopaterno.'-'.$usuario[0]->apellidomaterno }}" disabled>
                                                    <snap class="text-sm">PROFESOR</snap>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="materia1" id="materia1" class="form-control" placeholder="promedio" disabled>
                                                        <snap class="text-sm">MATERIA</snap>
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
                                            <th>acciones</th>
                                            {{-- <th>estado</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_nota">
                                        @foreach ($notas as $nota)
                                        <tr>
                                            <td>{{ $nota->fechadenota}}</td>
                                            <td>{{ $nota->actividad_nombre}}</td>
                                            <td>{{ $nota->nota}}</td>
                                            <td>{{ $nota->estado}}</td>
                                           
                                        </tr>
                                        @endforeach
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
  <!--empeiza el modal-->
  <div class="modal fade " id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg " role="document">
          <div class="modal-content p-3 mb-2 bg-info">
               <div class="modal-body">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    <div class="card shadow p-3 mb-2 bg-info text-blue">
                              <div class="card-header border-0">
                                  <div class="row align-items-center">
                                      <div class="col">
                                          <h3 class="mb-0">EDITAR NOTA</h3>
                                      </div>
                                        <?php $fcha = date("Y-m-d"); ?>
                                        <form method="post" action="{{ url('/notamodal')}}" enctype="multipart/form-data">
                                        @csrf   
                                        <input type="text"  id="materia7"  name="materia_id7" class="d-none"  value=""  readonly> 
                                        <input type="text"  id="alumno7"  name="alumno_id7" class="d-none"  value=""  readonly> 
                                        {{-- <input type="text"  id="asignarproma_id"  name="asignarproma_id" class="d-none"  value=""  readonly>  --}}
                                            <div class="row p-3 mb-2  text-blue">
                                                <div class="col-12"> 
                                                    <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                                                        <div class="form-group m-form__group row">
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">fecha de nota</label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <input class="form-control" placeholder="fechadenota" type="date" name="fechadenota"   id="fechadenota" value="<?php echo $fcha; ?>" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">actividad </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                          
                                                                            <select type="text"  id="actividad_id7"  name="actividad_id7" class="form-control" required>
                                                                                <option selected disabled value="">seleccione la actividad</option>
                                                                                @foreach ($actividads as $actividad)
                                                                                <option value="{{ $actividad->id }}">{{$actividad->actividad}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">materia </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <select type="text"  id="materia_id7" name="materia_id7"  class="form-control" required disabled>
                                                                                <option selected disabled value="">seleccione la materia</option>
                                                                                @foreach ($materias as $materia)
                                                                                <option value="{{ $materia->id }}">{{ $materia->materia}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">nota </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">    
                                                                            <input class="form-control" placeholder="ingrese la nota" type="text" name="nota7"  id="nota7"  required >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">alumno</label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <select type="text" name="alumno_id7" id="alumno_id7" class="form-control" required disabled>
                                                                                <option selected disabled value="">seleccione el alumno</option>
                                                                                @foreach ($alumnos as $alumno)
                                                                                <option value="{{ $alumno->id }}">{{ $alumno->nombre."-".$alumno->apellidopaterno."-".$alumno->apellidomaterno }}</option>
                                                                                @endforeach
                                                                            </select> 
                                                                        </div>
                                                                    </div>
                                                                </div>                  
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize">estado </label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            {{-- <select type="text" name="estado" id="estado" class="form-control" required>
                                                                                <option value="activo">activo</option> 
                                                                                <option value="inactivo">inactivo</option> 
                                                                                </select><br> --}}
                                                                                <input type="text" name="estado" id="estado" class="form-control" required value="activo" readonly> <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6">
                                                                    <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                                                        <div class="col-4 col-md-3">
                                                                            <label class="text text-capitalize"></label>
                                                                        </div>
                                                                        <div class="col-8 col-md-9">
                                                                            <center><input type="submit" value="guardar datos editados" class="btn btn-primary"></center>
                                                                              
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </form>
                                  </div>
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

<div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarModalLabel">Confirmar Actualización de Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas actualizar la nota  <span id="vernotaeditada"></span> ?
                <input type="text" class="d-none" id="nota_id"></input><input type="text" class="d-none" id="nota"></input>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmarBtn" onclick="editarnota()">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmarModal2" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarModalLabel">Confirmar eliminacionyy de Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar la nota <span id="vernotaeliminada"></span> ? 
                <input type="text" class="d-none" id="eliminar_notaid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmarBtn" onclick="eliminarnota()">eliminar</button>
            </div>
        </div>
    </div>
</div>

