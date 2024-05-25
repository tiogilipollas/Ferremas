<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
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
                <td>{{ $producto->tipoProducto->descripcion }}</td> <!-- Aquí se muestra la descripción en lugar del ID -->
                <td>
                    <a href="{{ route('productos.edit', $producto->ID_producto) }}" class="btn btn-primary btn-sm">Editar</a>
                    <!-- Si deseas agregar un botón de eliminar, puedes hacerlo aquí -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
