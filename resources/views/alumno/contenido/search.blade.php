@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados de la búsqueda</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <p class="text-primary">Resultados para "{{ $query }}"</p>

        @if ($results->isNotEmpty())
            <div class="row">
                @foreach ($results as $material)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $material->titulo }}</h5>
                                <p class="card-text">
                                    Autor: {{ $material->autor->nombre_autor ?? 'N/A' }}<br>
                                    Docente: {{ $material->docente->nombre_docente ?? 'N/A' }}<br>
                                    Academia: {{ $material->academia->nombre_academia ?? 'N/A' }}<br>
                                    Asignatura: {{ $material->asignatura->nombre_asignatura ?? 'N/A' }}<br>
                                    Tipo de Contenido: {{ $material->tipoContenido->nombre_tipo_contenido ?? 'N/A' }}<br>
                                    Fecha de Publicación: {{ $material->fecha_publicacion }}
                                </p>
                                <a href="{{ route('alumno.contenido.show', $material->id) }}" class="btn btn-primary">Ver
                                    Material</a>
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
