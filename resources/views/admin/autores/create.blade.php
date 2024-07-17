<div class="modal fade" id="nuevoAutorModal" tabindex="-1" aaria-labelledby="nuevoAutorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="nuevoAutorModalLabel">Nuevo Autor</h5> <!-- Titulo -->
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formNuevoAutor" action="{{ route('admin.autores.store') }}" method="POST"> <!-- Formulario para crear un nuevo autor -->
                    @csrf
                    <div class="form-group">
                        <label for="nombre_autor">Nombre</label> <!-- Input Nombre -->
                        <input type="text" name="nombre_autor" id="nombre_autor" class="form-control"
                            value="{{ old('nombre_autor') }}">
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno</label> <!-- Input Apellido Paterno -->
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                            value="{{ old('apellido_paterno') }}">
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno</label> <!-- Input Apellido Materno -->
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                            value="{{ old('apellido_materno') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('formNuevoAutor').submit()">Guardar</button>
            </div>
        </div>
    </div>
</div>
