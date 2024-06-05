<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
             </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
             {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('home.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rut" class="form-label">RUT</label>
                        <input type="number" class="form-control" name="rut" id="rut" aria-describedby="helpId" placeholder="" />
                    </div>

                    <div class="mb-3">
                        <label for="dv_rut" class="form-label">DV RUT</label>
                        <input type="number" class="form-control" name="dv_rut" maxlength="1" required id="dv_rut" aria-describedby="helpId" placeholder="" />
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="" />
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">APELLIDO</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="" />
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">DIRECCIÓN</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="" />
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">TELEFONO</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="" />
                    </div>

                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label">CORREO</label>
                        <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" aria-describedby="helpId" placeholder="" />
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
