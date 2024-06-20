@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Índice de Contenido</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="accordion" id="accordionAutores">
                <h3>Autores</h3>
                @foreach($autores as $autor)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAutor{{ $autor->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAutor{{ $autor->id }}" aria-expanded="false" aria-controls="collapseAutor{{ $autor->id }}">
                            {{ $autor->nombre_autor }} {{ $autor->apellido_paterno }} {{ $autor->apellido_materno }}
                        </button>
                    </h2>
                    <div id="collapseAutor{{ $autor->id }}" class="accordion-collapse collapse" aria-labelledby="headingAutor{{ $autor->id }}" data-bs-parent="#accordionAutores">
                        <div class="accordion-body">
                            <a href="{{ route('alumno.contenido.autor', $autor->id) }}" class="btn btn-secondary btn-sm">Ver Materiales</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="accordion" id="accordionAcademias">
                <h3>Academias</h3>
                @foreach($academias as $academia)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAcademia{{ $academia->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia{{ $academia->id }}" aria-expanded="false" aria-controls="collapseAcademia{{ $academia->id }}">
                            {{ $academia->nombre_academia }}
                        </button>
                    </h2>
                    <div id="collapseAcademia{{ $academia->id }}" class="accordion-collapse collapse" aria-labelledby="headingAcademia{{ $academia->id }}" data-bs-parent="#accordionAcademias">
                        <div class="accordion-body">
                            <a href="{{ route('alumno.contenido.academia', $academia->id) }}" class="btn btn-secondary btn-sm">Ver Materiales</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="accordion" id="accordionAsignaturas">
                <h3>Asignaturas</h3>
                @foreach($asignaturas as $asignatura)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAsignatura{{ $asignatura->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAsignatura{{ $asignatura->id }}" aria-expanded="false" aria-controls="collapseAsignatura{{ $asignatura->id }}">
                            {{ $asignatura->nombre_asignatura }}
                        </button>
                    </h2>
                    <div id="collapseAsignatura{{ $asignatura->id }}" class="accordion-collapse collapse" aria-labelledby="headingAsignatura{{ $asignatura->id }}" data-bs-parent="#accordionAsignaturas">
                        <div class="accordion-body">
                            <a href="{{ route('alumno.contenido.asignatura', $asignatura->id) }}" class="btn btn-secondary btn-sm">Ver Materiales</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="accordion" id="accordionTiposContenido">
                <h3>Tipos de Contenido</h3>
                @foreach($tiposContenido as $tipoContenido)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTipoContenido{{ $tipoContenido->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTipoContenido{{ $tipoContenido->id }}" aria-expanded="false" aria-controls="collapseTipoContenido{{ $tipoContenido->id }}">
                            {{ $tipoContenido->nombre_contenido }}
                        </button>
                    </h2>
                    <div id="collapseTipoContenido{{ $tipoContenido->id }}" class="accordion-collapse collapse" aria-labelledby="headingTipoContenido{{ $tipoContenido->id }}" data-bs-parent="#accordionTiposContenido">
                        <div class="accordion-body">
                            <a href="{{ route('alumno.contenido.tipo', $tipoContenido->id) }}" class="btn btn-secondary btn-sm">Ver Materiales</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="accordion" id="accordionDocentes">
                <h3>Docentes</h3>
                @foreach($docentes as $docente)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingDocente{{ $docente->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocente{{ $docente->id }}" aria-expanded="false" aria-controls="collapseDocente{{ $docente->id }}">
                            {{ $docente->nombre_docente }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
                        </button>
                    </h2>
                    <div id="collapseDocente{{ $docente->id }}" class="accordion-collapse collapse" aria-labelledby="headingDocente{{ $docente->id }}" data-bs-parent="#accordionDocentes">
                        <div class="accordion-body">
                            <a href="{{ route('alumno.contenido.docente', $docente->id) }}" class="btn btn-secondary btn-sm">Ver Materiales</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="accordion" id="accordionFechas">
                <h3>Fechas de Publicación</h3>
                @foreach($fechas as $fecha)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFecha{{ $fecha }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFecha{{ $fecha }}" aria-expanded="false" aria-controls="collapseFecha{{ $fecha }}">
                            {{ \Carbon\Carbon::parse($fecha)->format('d M Y') }}
                        </button>
                    </h2>
                    <div id="collapseFecha{{ $fecha }}" class="accordion-collapse collapse" aria-labelledby="headingFecha{{ $fecha }}" data-bs-parent="#accordionFechas">
                        <div class="accordion-body">
                            <a href="{{ route('alumno.contenido.fecha', $fecha) }}" class="btn btn-secondary btn-sm">Ver Materiales</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
