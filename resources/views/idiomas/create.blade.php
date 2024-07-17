<div class="modal fade" id="modalCreateIdioma" tabindex="-1" aria-labelledby="modalCreateIdiomaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateIdiomaLabel">Nuevo Idioma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCreateIdioma" action="{{ route('idiomas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_idioma">Nombre del Idioma</label>
                        <input type="text" class="form-control" id="nombre_idioma" name="nombre_idioma" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('formCreateIdioma').submit()">Guardar</button>
            </div>
        </div>
    </div>
</div>
