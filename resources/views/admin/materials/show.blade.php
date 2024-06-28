@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="position-relative">
            <a href="{{ route('admin.materials.index') }}"
                class="btn btn-primary mt-1 mb-4 position-absolute top-0 end-0">Regresar</a>
        </div>
        <h1>Detalle del Recurso</h1>
        <h3>{{ $material->titulo }}</h3>
        <p><strong>Descripción:</strong> {{ $material->descripcion }}</p>
        <p><strong>Autor:</strong> {{ $material->autor->nombre_autor }} {{ $material->autor->apellido_paterno }}
            {{ $material->autor->apellido_materno }}</p>
        <p><strong>Tipo de contenido:</strong> {{ $material->tipoContenido->nombre_contenido }}</p>
        <p><strong>Asignatura:</strong> {{ $material->asignatura->nombre_asignatura }}</p>
        <p><strong>Fecha de publicación:</strong> {{ $material->fecha_publicacion }}</p>
        <p><strong>Etiquetas:</strong></p>
        <ul>
            @foreach ($material->tags as $tag)
                <li class="d-inline p-1 mb-2 bg-primary text-white rounded-2">{{ $tag->nombre_tag }}</li>
            @endforeach
        </ul>

        <!--Mostrar Enlaces/Descargar-->
        @if ($material->tipoContenido->nombre_contenido === 'Enlace')
            <div class="form-group mt-2">
                <label for="enlace"><i class="fas fa-link"></i> Enlace</label>
                <p><a href="{{ $material->enlace }}" target="_blank">{{ $material->enlace }}</a></p>
            </div>
        @elseif (
            $material->tipoContenido->nombre_contenido === 'PDF' ||
                $material->tipoContenido->nombre_contenido === 'Presentación')
            <div class="form-group mt-2">
                <label for="archivo"><i class="fas fa-file-lines"></i> Archivo</label>
                <p><a href="{{ Storage::url($material->archivo) }}"
                        target="_blank">{{ Storage::url($material->archivo) }}</a></p>
            </div>
        @endif

        <!--Mostrar Vista previa del contenido-->
        @if ($material->tipoContenido->nombre_contenido == 'PDF')
            <!--Mostrar Contenido PDF, PRESENTACIÓN-->
            <iframe src="{{ asset('storage/' . $material->archivo) }}" width="100%" height="600px"></iframe>
        @elseif($material->tipoContenido->nombre_contenido == 'Presentación')
            <iframe src="https://docs.google.com/gview?url={{ asset('storage/' . $material->archivo) }}&embedded=true"
                width="100%" height="600px" class="embed-responsive-item"></iframe>
        @elseif($material->tipoContenido->nombre_contenido == 'Enlace')
            <!--Mostrar Contenido Enlace-->
            @php
                // Extract YouTube video ID
                $url = $material->archivo;
                parse_str(parse_url($url, PHP_URL_QUERY), $urlParams);
                $youtubeID = $urlParams['v'] ?? null;
            @endphp

            @if ($youtubeID)
                <iframe width="960" height="560" src="https://www.youtube.com/embed/{{ $youtubeID }}"
                    frameborder="0" allowfullscreen></iframe>
            @else
                <p><a href="{{ $material->archivo }}" target="_blank">{{ $material->archivo }}</a></p>
            @endif
        @endif
    </div>
@endsection
