@extends('layouts.gestionarproductos')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Producto</h1>
    <form action="{{ route('administracionproductos.updateadmin', $producto->ID_producto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $producto->stock }}" required>
        </div>
        <div class="form-group">
            <label for="ID_tipo">Categoría</label>
            <select class="form-control" id="ID_tipo" name="ID_tipo" required>
                <option disabled selected>Selecciona una categoría</option>
                <optgroup label="Herramientas" style="font-weight: bold; color: black;">
                    <option value="1" {{ $producto->ID_tipo == 1 ? 'selected' : '' }}>Herramientas Manuales</option>
                    <option value="2" {{ $producto->ID_tipo == 2 ? 'selected' : '' }}>Herramientas Eléctricas</option>
                </optgroup>
                <optgroup label="Materiales" style="font-weight: bold; color: black;">
                    <option value="3" {{ $producto->ID_tipo == 3 ? 'selected' : '' }}>Materiales Básicos</option>
                    <option value="4" {{ $producto->ID_tipo == 4 ? 'selected' : '' }}>Acabados</option>
                </optgroup>
                <optgroup label="Equipos" style="font-weight: bold; color: black;">
                    <option value="5" {{ $producto->ID_tipo == 5 ? 'selected' : '' }}>Equipos de Seguridad</option>
                    <option value="6" {{ $producto->ID_tipo == 6 ? 'selected' : '' }}>Accesorios Varios</option>
                </optgroup>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
