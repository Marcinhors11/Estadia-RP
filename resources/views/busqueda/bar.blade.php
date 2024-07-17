<div>
    <!-- Navbar content -->
    <form class="d-flex"
        action="@if (Auth::guard('administrador')->check()) {{ route('admin.contenido.search') }}
        @elseif(Auth::guard('docente')->check())
            {{ route('docentes.contenido.search') }}
        @elseif(Auth::guard('alumno')->check())
        {{ route('alumno.contenido.search') }} @endif"
        method="GET">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" name="query">
        <select class="form-select me-2" name="filter">
            <option value="">Buscar en todo</option>
            <option value="titulo">Título</option>
            <option value="autor">Autor</option>
            <option value="docente">Docente</option>
            <option value="academia">Academia</option>
            <option value="asignatura">Asignatura</option>
            <option value="tags">Etiquetas</option>
        </select>
        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
</div>
