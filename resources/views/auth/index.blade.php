@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="card shadow">
                        <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                            <h3 class="mb-0">LISTA DE usuarios
                                <i class="far fa-calendar-alt  text-blue"></i> 
                            </h3>
                            </div>
                            <div class="col text-right">
                            <a href="{{ url('register') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> registrar nuevo usuario</a>
                            </div>
                        </div>
                        </div>
                    <div  class="table-responsive">
                        <table class="table table-light table-border table-bordered table-striped ">
                            <thead class="thead-light table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>password</th>
                                    <th>rol</th>
                                    <th>acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>{{ $user->rol }}</td>
                                    <td>
                                    <a href="{{ url('/user/'.$user->id.'/edit') }}" method="post">editar</a>//
                                    <a href="{{ url('/user/'.$user->id.'/') }}" method="post">ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
         </div>
</div>
@endsection