@extends('home')

@section('content')

<div
    class="row"
>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <br><br>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>

        <h3> Lista de clientes</h3>
        <div class="position-absolute" style="top: 120px; right: 350px;">
            <a href="{{ route('inicio') }}" class="btn btn-outline-danger">Volver</a>
        </div>
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
            Nuevo
        </button>
        
        <div class="table-responsive">
            <nr>
            <table class="table">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">DIRECCIÓN</th>
                        <th scope="col">TELEFONO</th>
                        <th>CORREO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cliente as $cliente)


                    <tr class="">
                        <td scope="row"> {{$cliente->id_cliente}}</td>
                        <td> {{ $cliente->nombre }}</td>
                        <td> {{ $cliente->apellido }}</td>
                        <td> {{ $cliente->direccion }}</td>
                        <td> {{ $cliente->telefono }}</td>
                        <td> {{ $cliente->correo_electronico }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit {{$cliente->id_cliente}}">
                                Editar
                            </button>

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete {{$cliente->id_cliente}}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @include('cliente.info')
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('cliente.create')

    </div>
    <div class="col-md-2"></div>
</div>









@endsection
