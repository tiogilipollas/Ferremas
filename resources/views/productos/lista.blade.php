<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Descripción</th> <!-- Agregado aquí -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>
                    <div>
                        <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" style="max-width: 100px;"><br>
                        <strong>Nombre:</strong> {{ $producto->nombre }}<br>
                        <strong>Precio:</strong> ${{ $producto->precio }}<br>
                        <strong>Stock:</strong> {{ $producto->stock }}
                    </div>
                </td>
                <td>{{ $producto->tipoProducto->descripcion }}</td>
                <td>{{ $producto->descripcion }}</td> <!-- Agregado aquí -->
                <td>
                    <a href="{{ route('productos.edit', $producto->ID_producto) }}" class="btn btn-primary btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>