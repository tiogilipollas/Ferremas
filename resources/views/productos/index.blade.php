@extends('layouts.gestionarproductos')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Productos</h1>

    <form action="{{ route('productos.listar') }}" method="GET" class="form-inline mb-4">
        <div class="form-group mr-2">
            <label for="categoria" class="mr-2">Seleccione una categoría:</label>
            <select class="form-control" id="categoria" name="categoria">
                <option value="">Todas</option>
                <option value="herramientas">Herramientas</option>
                <option value="materiales">Materiales</option>
                <option value="equipos">Equipos</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <div id="productos-container" class="row">
        <!-- Aquí se incluirá la lista de productos -->
        @include('productos.lista', ['productos' => $productos])
    </div>
</div>
@endsection
