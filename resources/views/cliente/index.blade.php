
@extends('home')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-start">
    <div class="container">
        <div class="text-center">
            <a href="{{ url('/inicio') }}">
                <img src="{{ asset('img/logo_ferremas_transparente.png') }}" style="width: 80px;" alt="logo">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('administracionproductos.listaadmin') }}">Administrar Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/home') }}">Administrar Clientes</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ url('/agregarproductos') }}">Agregar Productos</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @else
                    <li class="nav-item">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <img src="{{ asset('img/user_login.png') }}" style="width: 40px;" alt="logo">
                            <a class="nav-link ml-2" href="{{ route('login') }}">{{ Auth::user()->name }}</a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center mb-4">Lista de clientes</h3>
            <div class="d-flex justify-content-between mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Nuevo</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">DIRECCIÓN</th>
                            <th scope="col">TELEFONO</th>
                            <th>CORREO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente as $cliente)
                        <tr>
                            <td scope="row"> {{$cliente->id_cliente}}</td>
                            <td> {{ $cliente->nombre }}</td>
                            <td> {{ $cliente->apellido }}</td>
                            <td> {{ $cliente->direccion }}</td>
                            <td> {{ $cliente->telefono }}</td>
                            <td> {{ $cliente->correo_electronico }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit {{$cliente->id_cliente}}">Editar</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete {{$cliente->id_cliente}}">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        @include('cliente.info')
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('cliente.create')
        </div>
    </div>
</div>
@endsection
