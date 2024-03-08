@extends('layouts.panel')
@section('content')

<style>
    .box {
      width: 200px;
      height: 200px;
      margin: 10px;
      border: 2px solid rgb(231, 145, 7);
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-size: 20px;
      font-weight: bold;
    }
    .top-row,
    .bottom-row {
      display: flex;
      justify-content: center;
      flex-basis: 100%;
    }
    .box img {
      width: 80%;
      height: 60%;
      margin-bottom: 10px;
    }
    .box a {
      padding: 8px 16px;
      font-size: 16px;
      background-color: #e58c0f;
      color: white;
      text-decoration: none;
    }
  </style>

  <div class="card shadow">
          <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">DIFERENTES TIPOS DE REPORTE DE LOS ALUMNOS</h3>
                        </div>
                           
                    </div>
                    <div class="top-row">
                        <div class="box">
                          <img src="imag/listaprofesores.jpg" alt="Imagen 1">
                          <a href="{{ url('/repor-alu') }}">Lista de los Alumnos</a>
                        </div>
                        {{-- <div class="box">
                          <img src="imag/adelantopro.jpg" alt="Imagen 2">
                          <a href="{{ url('/reporadesecre') }}">materias y pagos</a>
                        </div> --}}
                        <div class="box">
                          <img src="imag/pagoprofesor.png" alt="Imagen 3">
                          <a  href="{{ url('/notasreporte') }}">Promedio de los alumnos</a>
                        </div>
                      </div>
                      {{-- <div class="bottom-row">
                        <div class="box">
                          <img src="imag/pagoprofesor.png" alt="Imagen 4">
                          <a href="/"></a>
                        </div>
                        <div class="box">
                          <img src="imag/alumnosprofe.jpg" alt="Imagen 5">
                          <a href="#"></a>
                        </div>
                        <div class="box">
                          <img src="imagen6.jpg" alt="nose">
                          <a href="#"></a>
                        </div>
                       </div> --}}
           </div>
  </div>    
@endsection

