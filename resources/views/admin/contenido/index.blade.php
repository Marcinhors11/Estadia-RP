<div class="row">
    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Listar autores en existencia -->
            <h4>Autores</h4>
            @foreach ($autores as $autor)
                <a href="{{ route('admin.contenido.autor', $autor->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $autor->nombre_autor }} {{ $autor->apellido_paterno }} {{ $autor->apellido_materno }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Listar docentes en existencia -->
            <h4>Docentes</h4>
            @foreach ($docentes as $docente)
                <a href="{{ route('admin.contenido.docente', $docente->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $docente->nombre_docente }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Listar academias en existencia -->
            <h4>Academias</h4>
            @foreach ($academias as $academia)
                <a href="{{ route('admin.contenido.academia', $academia->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $academia->nombre_academia }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Listar asignaturas en existencia -->
            <h4>Asignaturas</h4>
            @foreach ($asignaturas as $asignatura)
                <a href="{{ route('admin.contenido.asignatura', $asignatura->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $asignatura->nombre_asignatura }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Listar los tipos de contenido en existencia -->
            <h4>Tipos de Contenido</h4>
            @foreach ($tiposContenido as $tipoContenido)
                <a href="{{ route('admin.contenido.tipo', $tipoContenido->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $tipoContenido->nombre_contenido }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="list-group">
            <!-- Listar las fechas en existencia -->
            <h4>Fechas de Publicación</h4>
            @foreach ($fechasPublicacion as $fecha)
                <a href="{{ route('admin.contenido.fecha', $fecha) }}"
                    class="list-group-item list-group-item-action">
                    {{ $fecha }}
                </a>
            @endforeach
        </div>
    </div>
</div>
