
@foreach ($clientes as $cliente)
<div class="modal fade" id="edit{{ $cliente->rut }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('home.update', ['rut' => $cliente->rut]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $cliente->nombre }}" />
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">APELLIDO</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" value="{{ $cliente->apellido }}" />
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">DIRECCIÓN</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $cliente->direccion }}" />
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">TELÉFONO</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $cliente->telefono }}" />
                    </div>
                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label">CORREO</label>
                        <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" value="{{ $cliente->correo_electronico }}" />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="Activo" {{ $cliente->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $cliente->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para eliminar -->
<div class="modal fade" id="delete{{ $cliente->rut }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ELIMINAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('home.destroy', $cliente->rut) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar al cliente <strong>{{ $cliente->nombre }} {{ $cliente->apellido }}</strong>?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
