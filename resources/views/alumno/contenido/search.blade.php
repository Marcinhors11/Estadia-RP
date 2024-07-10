@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados de la búsqueda</h1>

        @include('errors.alerts')

        <p class="text-primary">Resultados para "{{ $query }}"</p>

        @if ($results->isNotEmpty())
            <div class="row">
                @foreach ($results as $material)
                <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: justify;">{{ $material->titulo }}</h5>
                                <hr class="my-2">
                                <p class="card-text">
                                    <strong>Autor:</strong>
                                    {{ $material->autor->nombre_autor ?? ' ' }}
                                    {{ $material->autor->apellido_paterno ?? ' ' }}
                                    {{ $material->autor->apellido_materno ?? ' ' }}
                                </p>
                                <p class="card-text">
                                    <strong>Docente:</strong>
                                    {{ $material->docente->nombre_docente ?? ' ' }}
                                    {{ $material->docente->apellido_paterno ?? ' ' }}
                                    {{ $material->docente->apellido_materno ?? ' ' }}
                                </p>
                                <p class="card-text">
                                    <strong>Academia:</strong>
                                    {{ $material->academia->nombre_academia ?? ' ' }}
                                </p>
                                <p class="card-text">
                                    <strong>Asignatura:</strong>
                                    {{ $material->asignatura->nombre_asignatura ?? ' ' }}
                                </p>
                                <p class="card-text">
                                    <strong>Tipo de Contenido:</strong>
                                    {{ $material->tipoContenido->nombre_tipo_contenido ?? ' ' }}
                                </p>
                                <p class="card-text">
                                    <strong>Fecha de Publicación:</strong>
                                    {{ $material->fecha_publicacion }}
                                </p>

                                <p class="card-text">
                                    <strong>Etiquetas:</strong>
                                </p>
                                <ul>
                                    @foreach ($material->tags as $tag)
                                        <li class="d-inline p-1 mb-2 bg-primary text-white rounded-2">
                                            {{ $tag->nombre_tag }}</li>
                                    @endforeach
                                </ul>

                                <div class="d-grid gap-2 col-5 mt-4 mx-auto">
                                    <a href="{{ route('alumno.contenido.show', $material->id) }}" class="btn btn-outline-secondary">Ver
                                    Material</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No se encontraron resultados.</p>
        @endif
    </div>
@endsection
