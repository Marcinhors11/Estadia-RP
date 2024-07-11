@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados de la búsqueda</h1>

        @include('errors.alerts')

        <p class="text-primary">Resultados para "{{ $query }}"</p>

        <!-- Mostrar los resultados de una busqueda verificando que la busqueda no este vacia -->
        @if ($results->isNotEmpty())
            <div class="row">
                <!-- Listar los materiales buscados de acuerdo a los resultados de la busqueda -->
                @foreach ($results as $material)
                <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: justify;">{{ $material->titulo }}</h5>  <!-- Titulo del Material -->
                                <hr class="my-2">
                                <p class="card-text">  <!-- Nombre del autor -->
                                    <strong>Autor:</strong>
                                    {{ $material->autor->nombre_autor ?? ' ' }}
                                    {{ $material->autor->apellido_paterno ?? ' ' }}
                                    {{ $material->autor->apellido_materno ?? ' ' }}
                                </p>
                                <p class="card-text">  <!-- Nombre del docente -->
                                    <strong>Docente:</strong>
                                    {{ $material->docente->nombre_docente ?? ' ' }}
                                    {{ $material->docente->apellido_paterno ?? ' ' }}
                                    {{ $material->docente->apellido_materno ?? ' ' }}
                                </p>
                                <p class="card-text"> <!-- Nombre de la academia -->
                                    <strong>Academia:</strong>
                                    {{ $material->academia->nombre_academia ?? ' ' }}
                                </p>
                                <p class="card-text">  <!-- Nombre de la asignatura -->
                                    <strong>Asignatura:</strong>
                                    {{ $material->asignatura->nombre_asignatura ?? ' ' }}
                                </p>
                                <p class="card-text">  <!-- Nombre del tipo de contenido del material -->
                                    <strong>Tipo de Contenido:</strong>
                                    {{ $material->tipoContenido->nombre_tipo_contenido ?? ' ' }}
                                </p>
                                <p class="card-text">  <!-- Fecha de publicación del material -->
                                    <strong>Fecha de Publicación:</strong>
                                    {{ $material->fecha_publicacion }}
                                </p>

                                <p class="card-text">  <!-- Etiquetas del material -->
                                    <strong>Etiquetas:</strong>
                                </p>
                                <ul>  <!-- Listar las etiquetas del material -->
                                    @foreach ($material->tags as $tag)
                                        <li class="d-inline p-1 mb-2 bg-primary text-white rounded-2">
                                            {{ $tag->nombre_tag }}</li>
                                    @endforeach
                                </ul>

                                <div class="d-grid gap-2 col-5 mt-4 mx-auto">
                                    <a href="{{ route('admin.contenido.show', $material->id) }}" class="btn btn-outline-secondary">Ver
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
