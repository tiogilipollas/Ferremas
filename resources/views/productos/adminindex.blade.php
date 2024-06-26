
@extends('layouts.gestionarproductos')


@section('content')
<div class="container">
    <h1 class="my-4">Administración de Productos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('administracionproductos.listaadmin') }}" method="GET" class="form-inline mb-4">
    <br>
        <div class="form-group mr-2">
            <label for="categoria" class="mr-2">Seleccione una categoría:</label>
            <select class="form-control" id="categoria" name="categoria">
                <option value="">Todas</option>
                <option value="herramientas" {{ request('categoria') == 'herramientas' ? 'selected' : '' }}>Herramientas</option>
                <option value="materiales" {{ request('categoria') == 'materiales' ? 'selected' : '' }}>Materiales</option>
                <option value="equipos" {{ request('categoria') == 'equipos' ? 'selected' : '' }}>Equipos</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Acciones</th>
                            <th scope="col">Estado del Producto!</th> 
                        </tr>
                    </thead>
                    <tbody>
    @foreach($productos as $producto)
    <tr>
        <td scope="row">{{ $producto->ID_producto }}</td>
        <td>
            <div>
                <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" style="max-width: 100px;"><br>
                <strong>Nombre:</strong> {{ $producto->nombre }}<br>
                <strong>Precio:</strong> ${{ $producto->precio }}<br>
                <strong>Stock:</strong> {{ $producto->stock }}
            </div>
        </td>
        <td>{{ $producto->tipoProducto->descripcion }}</td>
        <td>
            {{ $producto->descripcion }}
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('administracionproductos.editadmin', $producto->ID_producto) }}" class="btn btn-success">Editar</a>
            </div>
        </td>
        <td> 
            <form id="estadoForm{{ $producto->ID_producto }}" action="{{ route('administracionproductos.updateEstado', $producto->ID_producto) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="estado" class="form-control" onchange="submitForm({{ $producto->ID_producto }})">
                    <option value="activo" {{ $producto->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $producto->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    <option value="descontinuado" {{ $producto->estado == 'descontinuado' ? 'selected' : '' }}>Descontinuado</option>
                </select>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

            </div>
        </div>
    </div>
</div>

<script>
function submitForm(id) {
    document.getElementById('estadoForm' + id).submit();
}
</script>
@endsection

@section('agregarproductos')
<li class="nav-item">
    <a class="nav-link" href="{{ route('agregarproductos.create') }}">Agregar Productos</a>
</li>
@endsection
