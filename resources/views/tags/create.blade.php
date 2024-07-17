<div class="modal fade" id="modalCreateEtiqueta" tabindex="-1" aria-labelledby="modalCreateEtiquetaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateEtiquetaLabel">Nueva Etiqueta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCreateEtiqueta" action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_tag">Nombre de la Etiqueta</label>
                        <input type="text" name="nombre_tag" id="nombre_tag" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('formCreateEtiqueta').submit()">Guardar</button>
            </div>
        </div>
    </div>
</div>
