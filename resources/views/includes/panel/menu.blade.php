  <h1 class="navbar-heading text-muted" ><span  style="color: #ECECEC;">
    @if(auth()->user()->role == 'director')
        bienvenido Director
      @elseif(auth()->user()->role == 'secretaria')
          bienvenido Secretaria
      @else 
      bienvenido Profesor
     @endif</p></h1>
    @if(auth()->user()->role == 'director')
        <ul class="navbar-nav  ">
          
                <li class="nav-item">
                  <a class="nav-link nav-link-icon" href="{{url('registroEmpleado')}}">
                    <i class="fas fa-users text-info"></i>
                    <span class="nav-link-inner--text " style="color: #ECECEC;">Registrar Empleado-Usuario</span>
                  </a>
                </li>
                  <li class="nav-item">
                  <b> <a class="nav-link active" href="#navbar-examples1" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples1">
                          <i class="far fa-id-badge text-info" style="color: #f4645f;"></i>
                          <span class="nav-link-text" style="color: #ECECEC;">{{ __('SECRETARIA') }}</span>
                      </a></b>

                      <div class="collapse show" id="navbar-examples1">
                          <ul class="nav nav-sm flex-column">
                              <li class="nav-item">
                                <a class="nav-link " href="{{ url('/secretaria') }}" style="color: #ECECEC;">
                                  <i class="fas fa-university text-info"></i>Secretarias
                                </a>
                              </li> 
                              <li class="nav-item">
                                <a class="nav-link " href="{{ url('/adelantosecre') }}" style="color: #ECECEC;">
                                  <i class="fas fa-hand-holding-usd text-info"></i> Adelanto
                                </a>
                            </li>
                              <li class="nav-item">
                                  <a class="nav-link " href="{{ url('/sueldosecre') }}" style="color: #ECECEC;">
                                    <i class="fas fa-donate text-info"></i>Pagar Sueldo
                                  </a>
                              </li>
                            
                          </ul>
                      </div>
                </li>
            <li class="nav-item">
              <b><a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                  <i class="fas fa-chalkboard  text-info" style="color: #09bb4d;"></i>
                  <span class="nav-link-text"style="color: #ECECEC;">{{ __('PROFESOR') }}</span>
              </a></b>

              <div class="collapse show" id="navbar-examples">
                  <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                          <a class="nav-link " href="{{ url('/profesor') }}" style="color: #ECECEC;">
                            <i class="fas fa-chalkboard-teacher text-info"></i> Profesores
                          </a>      
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="{{ url('/adelantopro') }}" style="color: #ECECEC;">
                          <i class="fas fa-hand-holding-usd text-info"></i> Adelanto
                        </a>
                    </li>
                      <li class="nav-item">
                          <a class="nav-link " href="{{ url('/sueldopro') }}" style="color: #ECECEC;">
                            <i class="fas fa-donate text-info"></i>Pagar Sueldo
                          </a>
                      </li>
                    
                  </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('/aula') }}" style="color: #ECECEC;" >
                <i class="fas fa-university text-info"></i>Aula
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('/materia') }}" style="color: #ECECEC;">
                <i class="fas fa-book text-info"></i>Materia
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('/periodo') }}" style="color: #ECECEC;">
                <i class="	far fa-clock text-info"></i>Periodo
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('/asignarproma') }}" style="color: #ECECEC;">
                <i class="fas fa-chalkboard-teacher text-info"></i>Asignar Materia
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('/alumno') }}" style="color: #ECECEC;">
                <i class="fas fa-user-graduate text-info"></i>Alumnos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('/inscripcion') }}" style="color: #ECECEC;">
                <i class="far fa-map text-info"></i>Inscripción
              </a>
            </li>
          
            {{-- <li class="nav-item">
              <a class="nav-link " href="{{ url('/nota') }}" style="color: #ECECEC;">
                <i class="fas fa-calculator text-success"></i>Notas
              </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{route('logout')}}"
                onclick="event.preventDefault(); document.getElementById('formlogout').submit();" style="color: #ECECEC;">
                <i class="fas fa-sign-in-alt text-danger"></i> Cerrar Sesión
              </a>
              <form action="{{route('logout')}}" method="POST" style="display: none" id="formlogout" >
                @csrf
                </form>
            </li>
        </ul>
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted" style="color: #ECECEC;">Reportes</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
              <li class="nav-item">
                <a class="nav-link active" href="#navbar-examples2" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples2">
                    <i class="	far fa-sticky-note text-info" style="color: #ECECEC;"></i>
                    <span class="nav-link-text" style="color: #ECECEC;">{{ __('REPORTES') }}</span>
                </a>

                <div class="collapse show" id="navbar-examples2">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <a class="nav-link " href="{{ url('/opciones-reportesecre') }}" style="color: #ECECEC;">
                            <i class="fas fa-university text-info"></i>Secretarias
                          </a>
                        </li> 
                        <li class="nav-item">
                          <a class="nav-link " href="{{ url('/reporopciones') }}" style="color: #ECECEC;">
                            <i class="fas fa-chalkboard-teacher text-info"></i> Profesores
                          </a>
                      </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ url('/opciones-reportealumno') }}" style="color: #ECECEC;">
                              <i class="fas fa-user-graduate text-info"></i>Alumnos
                            </a>
                        </li>
                      
                    </ul>
                </div>
          </li>
        </ul>
   <!-- secretaria -->
 @elseif(auth()->user()->role == 'secretaria')
 <ul class="navbar-nav  ">

<li class="nav-item">
  <a class="nav-link " href="{{ url('/indexsecre') }}" style="color: #ECECEC;">
    <i class="fas fa-chalkboard-teacher text-info"></i> Profesores
  </a>      
</li>
<li class="nav-item">
<a class="nav-link " href="{{ url('/asignarproma') }}" style="color: #ECECEC;">
  <i class="fas fa-chalkboard-teacher text-info"></i>Asignar Materia
</a>
</li>
<li class="nav-item">
<a class="nav-link " href="{{ url('/alumno') }}" style="color: #ECECEC;">
  <i class="fas fa-user-graduate text-info"></i>Alumnos
</a>
</li>
<li class="nav-item">
<a class="nav-link " href="{{ url('/inscripcion') }}" style="color: #ECECEC;">
  <i class="far fa-map text-info"></i>Inscripción
</a>
</li>

{{-- <li class="nav-item">
<a class="nav-link " href="{{ url('/nota') }}" style="color: #ECECEC;">
  <i class="fas fa-calculator text-info"></i>Notas
</a>
</li> --}}
<li class="nav-item">
<a class="nav-link" href="{{route('logout')}}"
  onclick="event.preventDefault(); document.getElementById('formlogout').submit();" style="color: #ECECEC;">
  <i class="fas fa-sign-in-alt text-danger"></i> Cerrar Sesión
</a>
<form action="{{route('logout')}}" method="POST" style="display: none" id="formlogout" >
  @csrf
  </form>
</li>
</ul>
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted" style="color: #ECECEC;">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
<li class="nav-item">
  <a class="nav-link active" href="#navbar-examples2" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples2">
      <i class="	far fa-sticky-note text-info" style="color: #ECECEC;"></i>
      <span class="nav-link-text text-info" >{{ __('REPORTES') }}</span>
  </a>

  <div class="collapse show" id="navbar-examples2">
      <ul class="nav nav-sm flex-column">
        {{-- <li class="nav-item">
          <a class="nav-link " href="{{ url('/repor-pro') }}" style="color: #ECECEC;">
            <i class="fas fa-university text-info"></i>lista de los profesores
          </a>
        </li>  --}}
          <li class="nav-item">
            <a class="nav-link " href="{{ url('/reporasigsecre') }}" style="color: #ECECEC;">
              <i class="fas fa-university text-info"></i>Asignaciones de los Profesores
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link " href="{{ url('/reporprofealumnosecre') }}" style="color: #ECECEC;">
              <i class="fas fa-chalkboard-teacher text-info"></i> Inscripciones de los Alumnos
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/repor-alusecre') }}" style="color: #ECECEC;">
            <i class="fas fa-user-graduate text-info"></i>Lista de los Alumnos
          </a>
      </li>
          <li class="nav-item">
              <a class="nav-link " href="{{ url('/notasreportesecre') }}"style="color: #ECECEC;" >
                <i class="fas fa-user-graduate text-info"></i>Promedio de los alumnos
              </a>
          </li>
        
      </ul>
  </div>
</li>
</ul>
    <!-- profesor -->
      @else
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/actividad') }}" style="color: #ECECEC;">
            <i class="fas fa-table text-info"></i>Actividad
          </a>
        </li>
           <li class="nav-item">
            <a class="nav-link " href="{{ url('/asigpro') }}" style="color: #ECECEC;">
            <i class="fas fa-bed text-info"></i>
            <span class="nav-link-inner">Ver Materias Asignadas</span>
            </a>
          </li>
             
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/alumpro') }}" style="color: #ECECEC;">
            <i class="fas fa-university text-info"></i>Alumnos
          </a>
        </li>
         
        <li class="nav-item">
          <a class="nav-link" href="{{route('logout')}}"
            onclick="event.preventDefault(); document.getElementById('formlogout').submit();" style="color: #ECECEC;">
            <i class="fas fa-sign-in-alt text-danger "></i> Cerrar Sesión
          </a>
          <form action="{{route('logout')}}" method="POST" style="display: none" id="formlogout" >
            @csrf
            </form>
        </li>
     </ul>
     <hr class="my-3">
     <!-- Heading -->
     <h6 class="navbar-heading text-muted" >Reportes</h6>
     <!-- Navigation -->
     <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
             <a class="nav-link active" href="#navbar-examples2" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples2" >
                 <i class="	far fa-sticky-note text-info" style="color: #ECECEC;"></i>
                 <span class="nav-link-text" >{{ __('REPORTES') }}</span>
             </a>

             <div class="collapse show" id="navbar-examples2">
                 <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{url('/reporte-asigproreporte')}}" style="color: #ECECEC;">
                      <i class="ni ni-circle-08 text-info" ></i>
                      <span class="nav-link-inner--text">Reporte de Asignaciones</span>
                    </a>
                   </li> 
                     <li class="nav-item">
                       <a class="nav-link " href="{{ url('/notasproreporte') }}" style="color: #ECECEC;">
                         <i class="fas fa-chalkboard-teacher text-info"></i> Reporte de los Promedio de los alumnos
                       </a>
                   </li>
                 </ul>
             </div>
       </li>
     </ul>
@endif 
  <!-- Divider -->

   