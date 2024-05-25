@extends('layouts.gestionarproductos')

@section('content')
<div class="container">
    <h1 class="my-4">Administración de Productos</h1>

    <form action="{{ route('administracionproductos.listaadmin') }}" method="GET" class="form-inline mb-4">
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

    <div id="productos-container" class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->ID_producto }}</td> 
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
                        <a href="{{ route('administracionproductos.editadmin', $producto->ID_producto) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('administracionproductos.destroy', $producto->ID_producto) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('agregarproductos')
<li class="nav-item">
    <a class="nav-link" href="{{ route('agregarproductos.create') }}">Agregar Productos</a>
</li>
@endsection
