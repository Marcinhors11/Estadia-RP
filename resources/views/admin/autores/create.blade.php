<div class="modal fade" id="nuevoAutorModal" tabindex="-1" aaria-labelledby="nuevoAutorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="nuevoAutorModalLabel">Nuevo Autor</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formNuevoAutor" action="{{ route('admin.autores.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_autor">Nombre</label>
                        <input type="text" name="nombre_autor" id="nombre_autor" class="form-control"
                            value="{{ old('nombre_autor') }}">
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                            value="{{ old('apellido_paterno') }}">
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                            value="{{ old('apellido_materno') }}">
                    </div>
                    <button type="submit" class="btn btn-primary my-4">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
