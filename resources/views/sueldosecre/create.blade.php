@extends('layouts.panel')

@section('content')

<div class="container" >
    <div class="card shadow shadow p-3 mb-2 bg-info text-white">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">PAGO DE SUELDO DE LA SECRETARIA</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('sueldosecre/')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-undo"></i>
                        Regresar</a>
                </div>
                </div>
            </div>
        <?php $fcha = date("Y-m-d"); ?>
    <form method="post" action="{{ url('/sueldosecre')}}" enctype="multipart/form-data">
     @csrf   
        <div class="row p-3 mb-2 text-white">
            <div class="col-12"> 
                <div class="m-portlet__body m-portlet--primary" data-portlet="true" m-portlet="true">
                    <div class="form-group m-form__group row">

                             <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                        <div class="col-4 col-md-3">
                                            <label class=" text-capitalize">profesor </label>
                                        </div>
                                    <div class="col-8 col-md-9">
                                        <select type="text" name="secretaria_id" id="secretaria_id" class="form-control" required>
                                            <option selected disabled value="">Seleccione a la Secretaria</option>
                                            @foreach ($secretarias as $secretaria)
                                            <option value="{{ $secretaria->id }}" class=" text-capitalize">{{ $secretaria->nombre." ".$secretaria->apellidopaterno." ".$secretaria->apellidomaterno}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                         <label class="text text-capitalize">fecha de pago</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="date" name="fechadesueldo" id="fechadesueldo" class="form-control" value="<?php echo $fcha; ?>" readonly> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize" >mes de pago</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                         <select type="text" name="mesdepago" id="mesdepago" class="form-control text text-capitalize">
                                            <option value="enero">enero</option>
                                            <option value="febrero">febrero</option>
                                            <option value="marzo">marzo</option>
                                            <option value="abril">abril</option>
                                            <option value="mayo">mayo</option>
                                            <option value="junio">junio</option>
                                            <option value="julio">julio</option>
                                            <option value="agosto">agosto</option>
                                            <option value="septiembre">septiembre</option>
                                            <option value="octubre">octubre</option>
                                            <option value="noviembre">noviembre</option>
                                            <option value="diciembre">diciembre</option>
                                        </select><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">sueldo</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text"  id="sueldo" class="form-control" placeholder="Sueldo" value=""  readonly> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">total descuento</label>
                                    </div>
                                    <div class="col-8 col-md-6">
                                        <input type="text" name="totaldescuento" id="totaldescuento" class="form-control" placeholder="Total Descuento" readonly> <br>
                                    </div>
                                            <div class="col-8 col-md-3">
                                                <a href="" class="btn btn-success disabled" data-toggle="modal" data-target="#myModal2" onclick="veradelantos()" id="bosecre" > 
                                            <i class="fas fa-plus-circle"></i>descuentos</a>
                                                   <script>
                                                              function veradelantos() {
                                                                   var secretariaId = $('#secretaria_id').val();
                                                                   $.ajax({
                                                                           url: '{{ url("obtener-adelantosecre") }}',
                                                                           type: 'POST',
                                                                           data: {
                                                                            secretaria_id: secretariaId,
                                                                               _token: '{{ csrf_token() }}'
                                                                           },
                                                                           success: function(response) {
                                                                               $('#miadelantodesecre').empty();
                                                                              
                                                                               $.each(response, function(key, value) {
                                                                                  // alert(value.id)
                                                                                   $('#miadelantodesecre').append(
                                                                                       '<tr>'+
                                                                                       ' <td>'+value.id+'</td>'+
                                                                                           '<td>'+value.fechaadelantosecre+'</td>'+
                                                                                           ' <td>'+value.monto+'</td>'+
                                                                                           ' <td>'+value.estadoade+'</td>'+
                                                                                           ' <td>'+value.observacion+'</td>'+
                                                                                           '<td>'+value.secretaria_id+"-"+value.nombre_secretaria+'</td>'+
                                                                                       ' </tr>'
                                                                                   );
                                                                                   // Agregar el estilo de borde usando jQuery
                                                                                   $('#miadelantodesecre').find('td').css('border', '1px solid black');
           
                                                                               });
                                                                           }
                                                                           ,     error: function(xhr, status, error) {
                                                                                       // Manejar el error aquí
                                                                                       console.error(error);
                                                                                   }
                                                                                   });
                                                              } 
                                                   </script>
                                                  
                                               </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">total pago</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="totalpago" id="totalpago" class="form-control" readonly placeholder="Total Pago"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-4 col-md-3">
                                        <label class="text text-capitalize">observación</label>
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="observacion" id="observacion" class="form-control" required placeholder="ingrese una observación"> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group m-form__group row" style="display: flex; margin-left: 2px">
                                    <div class="col-12 col-md-12 " >
                                        <center><input type="submit" value="Guardar Datos" class="btn btn-primary" onclick="generarpdfadelanto()"  id="botonguardar" disabled></center>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
 <!--empeiza el modal-->
 <div class="modal fade " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg " role="document">
          <div class="modal-content p-3 mb-2 bg-info">
               <div class="modal-body">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    <div class="card shadow p-3 mb-2 bg-info text-white">
                          <div class="card-header border-0">
                              <div class="row align-items-center">
                                  <div class="col">
                                      <h3 class="mb-0">LISTA DE ADELANTOS</h3>
                                  </div>
                                  <div class="col text-right">
                                  </div>
                              </div>
                          </div>
                                  <div  class="table-responsive">
                                      <table class="table align-items-center table-flush">
                                          <thead class="thead-light">
                                              <tr>
                                                  <th>#</th>
                                                  <th>fechadesupre</th>
                                                  <th>monto</th>
                                                  <th>estado</th>
                                                  <th>observacion</th>
                                                  <th>profesor_id</th>
                                              </tr>
                                          </thead>
                                          <tbody id="miadelantodesecre" class="table align-items-center table-flush">
                                              @foreach ($adelantosecres as $adelantosecre)
                                              <tr>
                                                  <td>{{ $adelantosecre->id }}</td>
                                                  <td>{{ $adelantosecre->fechaadelantosecre }}</td>
                                                  <td>{{ $adelantosecre->monto }}</td>
                                                  <td>{{ $adelantosecre->estadoade }}</td>
                                                  <td>{{ $adelantosecre->observacion }}</td>
                                                  <td>{{ $adelantosecre->secretaria_id ."-".$adelantosecre->secretaria->nombre}}</td>
                                                  </td>
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
           </form>
              </div>
          </div>
    </div>
</div>
<!--filaliza el modal-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/pdfmake.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/vfs_fonts.js"></script>
<script>
    function generarpdfadelanto() {
      
      var currentDate = new Date();
      var formattedDate = currentDate.toISOString().slice(0, 10);
    
      var fechadesueldo= $('#fechadesueldo').val();
      var mesdepago = $('#mesdepago').val();
      var sueldo = $('#sueldo').val();
      var totaldescuento = $('#totaldescuento').val();
      var totalpago = $('#totalpago').val();
      var observacion = $('#observacion').val();
      var secretaria_id = $('#secretaria_id option:selected').text();
      //var monto_con_sufijo = monto + " bs";
      //alert(observacion)
      if (observacion.trim() === "") {
    //alert("El campo de observación no puede estar vacío");
    return; // No genera el PDF si el campo está vacío
  }
      const docDefinition = {
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
          {
            text: "Reporte de Pago",
            style: "header",
          },
          {
            text: "Fecha: " + formattedDate,
            alignment: "right",
            margin: [0, 0, 0, 10],
          },
          {
            table: {
              widths: ["auto", "auto", "auto", "*", "auto", "auto", "auto"],
              body: [
                ["Fecha de pago", "mes de pago", "sueldo", "total descuento", "total pago", "Observación", "secretaria"],
                [fechadesueldo, mesdepago, sueldo, totaldescuento, totalpago, observacion , secretaria_id],
              ],
            },
          },
        ],
        styles: {
          header: {
            fontSize: 18,
            bold: true,
            alignment: "center",
            margin: [0, 0, 0, 10],
          },
        },
        defaultStyle: {
          fontSize: 12,
          margin: [0, 5],
        },
        pageMargins: [40, 80, 40, 60],
      };
    
      pdfMake.createPdf(docDefinition).download(
        "reportepago_" + secretaria_id + "_" + formattedDate + ".pdf"
      );
    }
  </script>
<script>
    $(document).ready(function() {
        //verificar q esten el sueldo y descuento 
        var bansueldo = false;
        var bandescuento =false;
        $('#secretaria_id').on('change', function() {
        var secretariaId = $(this).val();
         bansueldo = false;
         bandescuento =false;
        //$('#bo').class=disabled
    
      //  $('#bo').addClass('clase-nueva');
        
        // Realizar la consulta AJAX para obtener sueldoprofesor
        obtenersueldosecretaria(secretariaId);
        
        // Realizar la consulta AJAX para obtener los meses de deuda
        //obtenerlosmesesdeuda(profesorId);
        
        // Realizar la consulta AJAX para obtener la sumatoria de adelantos
        obtenerSumatoriaAdelantossecre(secretariaId);
        //resultado de el suedo menos los adaelnto
        /*setTimeout(function() {
                console.log('Ejecutando función cada 2 segundos.');
                var totalpago = $('#sueldo').val()-$('#totaldescuento').val();
                    $('#totalpago').val(totalpago); 
                    //alert($('#sueldo').val());
                // Agrega aquí el código que deseas ejecutar cada 2 segundos
            }, 1000); // 2000 milisegundos = 2 segundos */
        //generar meses
        obtenerMesessecre(secretariaId);
        });


        function obtenersueldosecretaria(secretariaId) {
            
            // Realizar la solicitud AJAX para obtener sueldoprofesor
            $.ajax({
                url: '{{ url("obtener-sueldosecretaria") }}',
                type: 'POST',
                data: {
                    secretaria_id: secretariaId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    //alert(response);
                    $('#sueldo').val(response);
                    if(bandescuento) {
                        var totalpago = $('#sueldo').val()-$('#totaldescuento').val();
                         $('#totalpago').val(totalpago);
                    } else{
                        bansueldo = true;
                    }
                }
            });
        }
        function obtenerSumatoriaAdelantossecre(secretariaId) {
            // Realizar la solicitud AJAX para obtener sueldoprofesor
            $.ajax({
                url: '{{ url("obtener-SumatoriaAdelantossecre") }}',
                type: 'POST',
                data: {
                    secretaria_id: secretariaId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    //alert(response);
                    $('#totaldescuento').val(response);
                    if(bansueldo) {
                        var totalpago = $('#sueldo').val()-$('#totaldescuento').val();
                         $('#totalpago').val(totalpago);
                    } else{
                        bandescuento = true;
                    }
                }
            });
        }

        function obtenerMesessecre(secretariaId) {
            $("#botonguardar").prop("disabled", true); 
            $('#bosecre').addClass('disabled');
            // Realizar la solicitud AJAX para obtener sueldoprofesor
            $.ajax({
                url: '{{ url("obtener-mesessaldosecre") }}',
                type: 'POST',
                data: {
                    secretaria_id: secretariaId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(meses) {
                   var cont=0;
                   // alert("todo ok");
                     // Limpiar el campo de selección de periodos
                     $('#mesdepago').empty();
                   // for (var i = 0; i < meses.length; i++) {
                    if(meses.length>0){
                        for (var i = 0; i < 1; i++) {
                                var mes = meses[i];
                                //alert(mes);
                                $('#mesdepago').append(
                                    //obteniendo todos los meses
                                    '<option value="' + mes + '">' + mes + '</option>'
                                );
                                cont++;
                            }
                        if(cont >0){
                           // $('#botonguardar').removeClass('disabled');
                            $("#botonguardar").prop("disabled", false); 
                            $('#bosecre').removeClass('disabled');
                        }
                    }
                      
                  
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                      // Limpiar el campo de selección de periodos
                       
                }
            });
        }
            // Simular el evento change al cargar la página
        $('#aula_id').trigger('change');
    });
</script>
