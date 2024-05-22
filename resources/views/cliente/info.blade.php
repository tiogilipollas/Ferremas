

<!-- Modal -->
<div class="modal fade" id="edit {{$cliente->id_cliente}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('home.update', ['id_cliente' => $cliente->id_cliente]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nombre"
                            id="nombre"
                            aria-describedby="helpId"
                            placeholder=""
                            value="{{$cliente->nombre}}"
                        />
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">TELEFONO</label>
                        <input
                            type="text"
                            class="form-control"
                            name="telefono"
                            id="telefono"
                            aria-describedby="helpId"
                            placeholder=""
                            value="{{$cliente->telefono}}"
                        />
                    </div>

                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label">CORREO</label>
                        <input
                            type="email"
                            class="form-control"
                            name="correo_electronico"
                            id="correo_electronico"
                            aria-describedby="helpId"
                            placeholder=""
                            value="{{$cliente->correo_electronico}}"
                        />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>








<!-- Modal -->
<div class="modal fade" id="delete {{$cliente->id_cliente}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ELIMINAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('home.destroy',$cliente->id_cliente)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                Estás seguro de eliminar a <strong> {{$cliente->nombre}} ?</strong>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
