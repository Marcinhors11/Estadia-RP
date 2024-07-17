<div class="modal fade" id="modalCreateAsignatura" tabindex="-1" aria-labelledby="modalCreateAsignaturaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateAsignaturaLabel">Nueva Asignatura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCreateAsignatura" action="{{ route('asignaturas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_asignatura">Nombre de la Asignatura</label>
                        <input type="text" class="form-control" id="nombre_asignatura" name="nombre_asignatura"
                            required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('formCreateAsignatura').submit()">Guardar</button>
            </div>
        </div>
    </div>
</div>
