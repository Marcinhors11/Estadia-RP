<div class="modal fade" id="modalCreateAcademia" tabindex="-1" aria-labelledby="modalCreateAcademiaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateAcademiaLabel">Nueva Academia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCreateAcademia" action="{{ route('academias.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_academia">Nombre de la Academia</label>
                        <input type="text" class="form-control" id="nombre_academia" name="nombre_academia" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('formCreateAcademia').submit()">Guardar</button>
            </div>
        </div>
    </div>
</div>
