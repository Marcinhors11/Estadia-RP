@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="position-relative">
            <a href="{{ route('admin.system.home') }}" class="btn btn-primary mt-1 mb-4 position-absolute top-0 end-0">Regresar</a>
        </div>
        <h1>Detalle del Recurso</h1>
        <h3>{{ $materiales->titulo }}</h3>
        <p><strong>Descripción:</strong> {{ $materiales->descripcion }}</p>
        <p><strong>Autor:</strong> {{ $materiales->autor->nombre_autor }} {{ $materiales->autor->apellido_paterno }}
            {{ $materiales->autor->apellido_materno }}</p>
        <p><strong>Tipo de contenido:</strong> {{ $materiales->tipoContenido->nombre_contenido }}</p>
        <p><strong>Asignatura:</strong> {{ $materiales->asignatura->nombre_asignatura }}</p>
        <p><strong>Fecha de publicación:</strong> {{ $materiales->fecha_publicacion }}</p>

        <!--Mostrar Enlaces/Descargar-->
        @if ($materiales->tipoContenido->nombre_contenido === 'Enlace')
            <div class="form-group mt-2">
                <label for="enlace">Enlace</label>
                <p><a href="{{ $materiales->enlace }}" target="_blank"><i class="fas fa-link"></i></a></p>
            </div>
        @elseif (
            $materiales->tipoContenido->nombre_contenido === 'PDF' ||
                $materiales->tipoContenido->nombre_contenido === 'Presentación')
            <div class="form-group mt-2">
                <label for="archivo">Archivo</label>
                <p><a href="{{ Storage::url($materiales->archivo) }}" target="_blank"><i class="fas fa-file-lines"></i></a></p>
            </div>
        @endif

        <!--Mostrar Vista previa del contenido-->
        @if ($materiales->tipoContenido->nombre_contenido == 'PDF')
            <!--Mostrar Contenido PDF, PRESENTACIÓN-->
            <iframe src="{{ asset('storage/' . $materiales->archivo) }}" width="100%" height="600px"></iframe>
        @elseif($materiales->tipoContenido->nombre_contenido == 'Presentación')
            <iframe src="https://docs.google.com/gview?url={{ asset('storage/' . $materiales->archivo) }}&embedded=true"
                width="100%" height="600px" class="embed-responsive-item"></iframe>
        @elseif($materiales->tipoContenido->nombre_contenido == 'Enlace')
            <!--Mostrar Contenido Enlace-->
            @php
                // Extract YouTube video ID
                $url = $materiales->archivo;
                parse_str(parse_url($url, PHP_URL_QUERY), $urlParams);
                $youtubeID = $urlParams['v'] ?? null;
            @endphp

            @if ($youtubeID)
                <iframe width="960" height="560" src="https://www.youtube.com/embed/{{ $youtubeID }}"
                    frameborder="0" allowfullscreen></iframe>
            @else
                <p><a href="{{ $materiales->archivo }}" target="_blank">{{ $materiales->archivo }}</a></p>
            @endif
        @endif
    </div>
@endsection
