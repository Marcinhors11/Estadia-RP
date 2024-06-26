<div class="row">
    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Autores -->
            <h4>Autores</h4>
            @foreach ($autores as $autor)
                <a href="{{ route('docentes.contenido.autor', $autor->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $autor->nombre_autor }} {{ $autor->apellido_paterno }} {{ $autor->apellido_materno }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Docentes -->
            <h4>Docentes</h4>
            @foreach ($docentes as $docente)
                <a href="{{ route('docentes.contenido.docente', $docente->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $docente->nombre_docente }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Academias -->
            <h4>Academias</h4>
            @foreach ($academias as $academia)
                <a href="{{ route('docentes.contenido.academia', $academia->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $academia->nombre_academia }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Asignaturas -->
            <h4>Asignaturas</h4>
            @foreach ($asignaturas as $asignatura)
                <a href="{{ route('docentes.contenido.asignatura', $asignatura->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $asignatura->nombre_asignatura }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Tipos de Contenido -->
            <h4>Tipos de Contenido</h4>
            @foreach ($tiposContenido as $tipoContenido)
                <a href="{{ route('docentes.contenido.tipo', $tipoContenido->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $tipoContenido->nombre_contenido }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Fecha de publicación -->
            <h4>Fechas de Publicación</h4>
            @foreach ($fechasPublicacion as $fecha)
                <a href="{{ route('docentes.contenido.fecha', $fecha) }}"
                    class="list-group-item list-group-item-action">
                    {{ $fecha }}
                </a>
            @endforeach
        </div>
    </div>
</div>
