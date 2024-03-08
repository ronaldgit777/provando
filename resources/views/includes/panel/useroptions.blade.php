
<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
      <h6 class="text-overflow m-0">bienvenidos</h6>
      
    </div>
    <a 
    href="{{url('/perfiluser?id=' . auth()->user()->id)}}"
    class="dropdown-item">
      <i class="ni ni-single-02"></i>
      <span>Mi Perfil</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href=""{{route('logout')}}"
    onclick="event.preventDefault(); document.getElementById('formlogout').submit();"" class="dropdown-item">
      <i class="ni ni-user-run"></i>
      <span>Cerrar Sessión</span>
      <form action="{{route('logout')}}" method="POST" style="display: none" id="formlogout" >
        @csrf
        </form>
    </a>
  </div>